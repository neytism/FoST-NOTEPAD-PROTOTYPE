<?php

include 'config.php';

if (isset($_SESSION['user_id'])) {
    header('location: index.php');
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <title>Sign up</title>

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
        }
        
        .note-card::-webkit-scrollbar {
        display: none;
        }
        
        .form-group.d-flex {
  justify-content: center;
}
    </style>
</head>


<body>


    <div class="gradient-background"></div>

   
    <div class="hide-scroll d-flex justify-content-center" style="height: 100%;">
        
        <div class="col-lg-4 col-md-12 mb-0 mb-lg-0" id="note-card-holder-1" >
                
            <div class="w-100 shadow-1-strong rounded-card note-card" >
                
                <form method="post" action="signupAction.php">
                    
                    <div class="form-group d-flex  mt-4 mb-4" style="height: 200px; max-height: 200px; text-align: center;" >
                        <label for="InputProfilePicture" style="display: block; cursor: pointer; ">
                            <input type="file" accept="image/*" name="image" id="InputProfilePicture" style="display: none;">
                            
                            <img id="displayImage" src="assets/images/add-image.png"  style="cursor: pointer; border-radius: 50%; backdrop-filter: blur(50px); background-color: rgba(0, 0, 0, 0); object-fit: contain; width: 100%; max-width: 200px ;vertical-align: middle;" title="Optional Profile Picture. Limited to 1MB.">
                        </label>
                    </div>
                    
                    <div class="form-group">
                      <label for="InputUsername">Username</label>
                      <input type="text" class="form-control bg-transparent" name="uname" id="InputUsername" aria-describedby="emailHelp" placeholder="Enter username" required>
                      <label for="" class="text-danger mt-2">* Must be atleast 8 characters. <br>* Must not contain special characters.</label>
                      </div>
                    
                    <div class="form-group">
                        <label for="InputUsername">Name</label>
                        <input type="text" class="form-control bg-transparent" name="name" id="InputName" aria-describedby="emailHelp" placeholder="Enter Name" required>
                    </div>

                    <div class="form-group">
                        <label for="InputUsername">Bio</label>
                        <textarea class="form-control bg-transparent" aria-label="With textarea" name="bio" id="InputBio" placeholder="Enter Bio" ></textarea>
                    </div>

                    <div class="form-group">
                        <label for="InputPassword">Password</label>
                        <input type="password" class="form-control bg-transparent" id="InputPassword" name="pword" placeholder="Enter Password" required>
                        <label for="" class="text-danger mt-2">* Must be atleast 8 characters. <br>* Must not contain special characters.</label>
                    </div>
                    
                    
                    <div class="form-group">
                        <label for="InputPassword">Repeat Password</label>
                        <input type="password" class="form-control bg-transparent" id="InputRepeatPassword" name="rpword" placeholder="Repeat Password" required>
                    </div>
                
                    <button type="button" class="btn btn-secondary col-12 mb-3" onclick="window.location.href='login.php'">Already have an account.</button>

                    <button type="button" class="btn btn-primary col-12" onclick="checkSignup(event)">Sign up</button>

                    <label class="mt-3 d-flex justify-content-center text-danger" id="warningText" style="display: none !important;"></label>
                  </form>
            </div>
        
        
        </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="js/signup.js" id="rendered-js"></script>

</body>

</html>