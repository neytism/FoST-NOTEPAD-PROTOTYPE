<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'config.php';

    $errors = array(
        'uname' => '',
        'name' => '',
        'bio' => '',
        'image' => ''
    );
    
    $uname = $_POST['uname'];
    $name = $_POST['name'];
    $bio = $_POST['bio'];
    $imageChanged = false;

    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $image = $_FILES['image'];
        $imageChanged = true;
    }


    $uname = strtolower($uname);
    if (empty($uname)) {
        $errors['username'] = '-Username is required.';
    } else {
        $sql = "SELECT * FROM users WHERE username = '$uname' AND NOT id = '$_SESSION[user_id]'";
  
        $result = $conn->query($sql);
        
        if($result->num_rows > 0){
            $errors['username'] = '-Username is Taken.';
        } elseif (strlen($uname) < 8) {
            $errors['username'] = '-Username must be atleast 8 characters.';
        } elseif (HasSpecialCharacters($uname)) {
            $errors['username'] = '-Invalid Username.';
        } elseif (strlen($uname) < 8 && HasSpecialCharacters($uname)) {
            $errors['username'] = '-Invalid and short Username.';
        }
    }
    

    $name = ucfirst($name);
    if (empty($name)) {
        $errors['name'] = '-Name is required';
    } else {
        if (strlen($name) > 200) {
            $errors['name'] = '-Invalid, too long.';
        }
    }

    if (!empty($bio)) {
        if (strlen($bio) > 500) {
            $errors['bio'] = '-Invalid, too long.';
        }
    }


    if($imageChanged){

        if (!empty($image['name'])) {
            $base_dir = "assets/images/";
            $target_dir = "" . $base_dir;
            $target_file = $target_dir . basename($image["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $newFileName = $_SESSION['user_id'] . "_dp" . "." . $imageFileType;
            $newFilePath = $target_dir . $newFileName;
            $relativeFilePath = $base_dir . $newFileName;
    
    
            if ($image["size"] > 5000000) {
                $errors['image'] = '-File is too large';
            }
    
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                $errors['image'] = '-Only JPG, JPEG, PNG & GIF files are allowed';
            }
    
            if (!array_filter($errors)) {
                if (move_uploaded_file($image["tmp_name"], $newFilePath)) {
                    $image = $newFileName;
                } else {
                    $errors['image'] = '-There was an error uploading your file';
                }
            }
        } else {
            $image = "add-image.png";
        }

    }
    


    if (array_filter($errors)) {
        echo implode("<br>", array_filter($errors));
    } else {
        
        $name = mysqli_real_escape_string($conn, $name);
        $bio = mysqli_real_escape_string($conn, $bio);
        
        $sql = "UPDATE users SET username = '$uname', name='$name', bio = '$bio' WHERE id='$_SESSION[user_id]'";
        
        mysqli_query($conn, $sql);

        if($imageChanged){
            $sql = "UPDATE users SET image_name='$image' WHERE id='$_SESSION[user_id]'";
            mysqli_query($conn, $sql);
        }

        echo "Profile Saved.";

    }
    
   

}

function HasSpecialCharacters($str)
{
    return preg_match('/[#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/', $str);
}