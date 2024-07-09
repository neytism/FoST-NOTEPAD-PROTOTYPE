<?php
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('location: login.php');
}

$sql = "SELECT * FROM users WHERE id = '$_SESSION[user_id]'";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {

    $username = $row["username"];
    $name = $row["name"];
    $bio = $row["bio"];
    $image_name = $row["image_name"];

}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'config.php';

    $errors = array(
        'name' => '',
        'bio' => '',
        'image' => ''
    );

    $name = $_POST['name'];
    $bio = $_POST['bio'];
    $imageChanged = false;

    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $image = $_FILES['image'];
        $imageChanged = true;
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
        //echo implode("<br>", array_filter($errors));
    } else {
        
        $name = mysqli_real_escape_string($conn, $name);
        $bio = mysqli_real_escape_string($conn, $bio);
        
        $sql = "UPDATE users SET name='$name', bio = '$bio' WHERE id='$_SESSION[user_id]'";
        
        mysqli_query($conn, $sql);

        if($imageChanged){
            $sql = "UPDATE users SET image_name='$image' WHERE id='$_SESSION[user_id]'";
            mysqli_query($conn, $sql);
        }

        echo "success";

    }

}

$conn->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <title>Profile</title>
</head>


<body>


    <div class="gradient-background"></div>

    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#">NOTES</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="archived.php">Archived</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="aboutus.php">About us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="index.php?logout=1">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="hide-scroll d-flex justify-content-center align-items-center" style="height: 100%; margin-top: -60px;">

        <div class="col-lg-4 col-md-12 mb-0 mb-lg-0" id="note-card-holder-1">
                
            <div class="w-100 shadow-1-strong rounded-card mb-4 note-card" >
                
                <form method="post">
                    <div class="form-group d-flex justify-content-center mt-4 mb-4" style="height: 200px;" >
                        <label for="InputProfilePicture" style="display: block; height: 100%; cursor: pointer; ">
                            <input type="file" accept="image/*" name="image" id="InputProfilePicture" style="display: none;">
                            
                            <img id="displayImage" src="assets/images/<?php echo htmlspecialchars($image_name) ?>"  style="cursor: pointer; border-radius: 50%; backdrop-filter: blur(50px); background-color: rgba(0, 0, 0, 0); object-fit: contain; height: 100%; width: 100%; vertical-align: middle;" title="Profile Picture">
                        </label>
                    </div>
                    <div class="form-group">
                      <label for="InputUsername">Username</label>
                      <input type="text" class="form-control bg-transparent" name="uname" id="InputUsername" aria-describedby="emailHelp" placeholder="Enter username" value="<?php echo htmlspecialchars($username) ?>" readonly required>
                    </div>

                    <div class="form-group">
                        <label for="InputUsername">Name</label>
                        <input type="text" class="form-control bg-transparent" name="name" id="InputName" aria-describedby="emailHelp" placeholder="Enter Name" value="<?php echo htmlspecialchars($name) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="InputUsername">Bio</label>
                        <textarea class="form-control bg-transparent" aria-label="With textarea" name="bio" id="InputBio" placeholder="Enter Bio" ><?php echo htmlspecialchars($bio) ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary col-12" onclick="checkUpdate(event)">Save Changes</button>
                    <label class="mt-3 d-flex justify-content-center text-danger" id="warningText" style="display: none !important;"></label>
                  </form>
            </div>
        
        
        </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="js/updateProfile.js" id="rendered-js"></script>

</body>

</html>