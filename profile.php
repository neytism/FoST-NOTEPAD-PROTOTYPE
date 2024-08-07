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

    <style>
        .d-flex.justify-content-center {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        }
        
        .note-card {
        max-height: 95vh;
        overflow-y: auto;
        margin-top: 0px; 
        }
        
        @media (max-height: 670px) {
            .note-card {
        margin-top: 150px;
        }
        }
        
        .note-card::-webkit-scrollbar {
        display: none;
        }
        
        .form-group.d-flex,  #warningText {
  justify-content: center;
}
    </style>
    
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
                
            <div class="w-100 shadow-1-strong rounded-card note-card" style="">
                
                <form method="post">

                     <div class="form-group d-flex  mt-4 mb-4" style="height: 200px; max-height: 200px; text-align: center;" >
                        <label for="InputProfilePicture" style="display: block; cursor: pointer; aspect-ratio: 1 / 1 ; ">
                            <input type="file" accept="image/*" name="image" id="InputProfilePicture" style="display: none; ">
                            
                            <img id="displayImage" src="assets/images/<?php echo htmlspecialchars($image_name) ?>"  style="cursor: pointer; border-radius: 50%; backdrop-filter: blur(50px); background-color: rgba(0, 0, 0, 0); object-fit: cover; width: 100%; max-width: 200px ; height: 100%; max-height: 200px;vertical-align: middle;" title="Profile Picture. Limited to 1MB.">
                        </label>
                    </div>
                
                    <div class="form-group">
                      <label for="">Username</label><br>
                      <!-- <label title="Can't edit" for="" style="margin-top:10px;">  &nbsp; &nbsp; <?php echo htmlspecialchars($username) ?></label> -->
                      <input type="text" class="form-control bg-transparent" name="uname" id="InputUsername" aria-describedby="emailHelp" placeholder="Enter username" value="<?php echo htmlspecialchars($username) ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="InputUsername">Name</label>
                        <input type="text" class="form-control bg-transparent" name="name" id="InputName" aria-describedby="emailHelp" placeholder="Enter Name" value="<?php echo htmlspecialchars($name) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="InputUsername">Bio</label>
                        <textarea class="form-control bg-transparent" aria-label="With textarea" name="bio" id="InputBio" placeholder="Enter Bio" ><?php echo htmlspecialchars($bio) ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary col-12" onclick="checkUpdate(event, this)">Save Changes</button>
                    <label class="mt-3 d-flex text-danger" id="warningText" style="display: none !important; text-align:center;"></label>
                  </form>
            </div>
        
        
        </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="js/updateProfile.js" id="rendered-js"></script>

</body>

</html>