<?php
include 'config.php';

$errors = array(
    'username' => '',
    'name' => '',
    'bio' => '',
    'password' => '',
    'repeatPassword' => '',
    'image' => ''
);


$uname = $_POST['uname'];
$name = $_POST['name'];
$bio = $_POST['bio'];
$pword = $_POST['pword'];
$rpword = $_POST['rpword'];

if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
    $image = $_FILES['image'];
}


// check username
$uname = strtolower($uname);
if (empty($uname)) {
    $errors['username'] = '-Username is required.';
} else {
    $sql = "SELECT * FROM users WHERE username = '$uname'";

    $result = $conn->query($sql);

    if (strlen($uname) < 8) {
        $errors['username'] = '-Username must be atleast 8 characters.';
    } elseif (HasSpecialCharacters($uname)) {
        $errors['username'] = '-Invalid Username.';
    } elseif (strlen($uname) < 8 && HasSpecialCharacters($uname)) {
        $errors['username'] = '-Invalid and short Username.';
    } elseif ($result->num_rows > 0) {
        $errors['username'] = '-Username is Taken.';
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

if (empty($pword)) {
    $errors['password'] = '-Password is required.';
} else {
    if (strlen($uname) < 8) {
        $errors['password'] = '-Password must be atleast 8 characters.';
    }
}

if (!empty($pword) && $rpword != $pword) {
    $errors['repeatPassword'] = '-Password did not match';
}

$sql = "SELECT id FROM users ORDER BY id DESC LIMIT 1";
$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $last_id = $row['id'];
    $last_number = intval($last_id);
    $next_id = $last_number + 1 ;
} else {
    $next_id = 1;
}




if (!empty($image['name'])) {
    $base_dir = "assets/images/";
    $target_dir = "" . $base_dir;
    $target_file = $target_dir . basename($image["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $newFileName = $next_id . "_dp" . "." . $imageFileType;
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


if (array_filter($errors)) {
    echo implode("<br>", array_filter($errors));
} else {

    $uname = mysqli_real_escape_string($conn, $uname);
    $name = mysqli_real_escape_string($conn, $name);
    $bio = mysqli_real_escape_string($conn, $bio);
    $pword = mysqli_real_escape_string($conn, $pword);

    $sql = "INSERT INTO users(username, name, password, image_name, bio) VALUES('$uname','$name','$pword','$image','$bio')";

    mysqli_query($conn, $sql);

    $_SESSION['user_id'] = $next_id;

    echo "success";

}



$conn->close();



function HasSpecialCharacters($str)
{
    return preg_match('/[#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/', $str);
}

?>