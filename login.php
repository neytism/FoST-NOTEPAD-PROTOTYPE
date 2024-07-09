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

    <title>Login</title>
</head>

<body>


    <div class="gradient-background"></div>

   
    
    <div class="hide-scroll d-flex justify-content-center align-items-center" style="padding: 20px; height: 100%;">

        <div class="col-lg-4 col-md-12 mb-0 mb-lg-0" id="note-card-holder-1">
                
            <div class="w-100 shadow-1-strong rounded-card mb-4 note-card" >
                
                <form>
                    <div class="form-group">
                      <label for="InputUsername">Username</label>
                      <input type="text" class="form-control bg-transparent" id="InputUsername" aria-describedby="emailHelp" placeholder="Enter username" required>
                    </div>
                    <div class="form-group">
                      <label for="InputPassword">Password</label>
                      <input type="password" class="form-control bg-transparent" id="InputPassword" placeholder="Enter Password" required>
                    </div>
                    <button type="button" class="btn btn-secondary col-12 mb-3" onclick="window.location.href='signup.php'">Don't have an account</button>
                    <button type="submit" class="btn btn-primary col-12" onclick="checkLogin(event)">Log in</button>
                    <label class="mt-3 d-flex justify-content-center text-danger" id="warningText" style="display: none !important;">-user not found</label>
                  </form>
            </div>
        
        
        </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="js/login.js" id="rendered-js"></script>

</body>

</html>