<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <title>Archived</title>
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
                <li class="nav-item active">
                    <a class="nav-link" href="#">Archived</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profile.php">Profile</a>
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

    <div class="hide-scroll" style="padding: 20px;">

        

        <!-- Gallery -->
        <div class="row">
            <!-- <div class="col-lg-12 col-md-12 mb-1 mb-lg-0 d-flex justify-content-center">

                <div class="w-100 col-lg-6 shadow-1-strong rounded-card mb-4 new-note" >
                    <input type="text" class="form-control bg-transparent" style="border: none;" id="usr" placeholder="New Note">
                </div>

            </div> -->

            <div class=" col-lg-12 col-md-12 mb-1 mb-lg-0 d-flex justify-content-center">
                
                <div id="no-notes-found" class="w-100 col-lg-12 shadow-1-strong rounded-card mb-4 new-note inactive hide" style="text-align: center;" >
                    NO ARCHIVED NOTES FOUND
                </div>

            </div>
            
            <div class="col-lg-3 col-md-12 mb-0 mb-lg-0" id="note-card-holder-1">

                <!-- <div class="w-100 shadow-1-strong rounded-card mb-4 note-card" >
                    
                    <div class="delete-holder">
                        <button class="trash-button">
                            <i class="bi bi-trash3 button-i button-i"></i>
                        </button>
                    </div>
                    

                    <div><span class="note-title" contenteditable="true"></span></div>

                    <ul class="list-group bg-transparent">

                        <li class="list-group-item bg-transparent border-0">
                          <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                          <span class="text-after-checkbox" contenteditable="true">Cras justo odio</span>
                        </li>
                        <li class="list-group-item bg-transparent border-0">
                          <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                          <span class="text-after-checkbox" contenteditable="true">Dapibus ac facilisis in</span>
                        </li>
                        <li class="list-group-item bg-transparent border-0">
                          <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                          <span class="text-after-checkbox" contenteditable="true">Morbi leo risus</span>
                        </li>
                        <li class="list-group-item bg-transparent border-0">
                          <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                          <span class="text-after-checkbox" contenteditable="true">Porta ac consectetur ac</span>
                        </li>
                        <li class="list-group-item bg-transparent border-0">
                          <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                          <span class="text-after-checkbox" contenteditable="true">Vestibulum at eros</span>
                        </li>
                        <li class="list-group-item bg-transparent border-0 inactive">
                            <button class="btn btn-dark bg-transparent border-0 p-0 new-list" >&nbsp; Add new item to list. &nbsp;</button>
                        </li>
                      </ul>
                </div> -->


            </div>

            <div class="col-lg-3 mb-0 mb-lg-0" id="note-card-holder-2">

            </div>

            <div class="col-lg-3 mb-0 mb-lg-0" id="note-card-holder-3">

            </div>

            <div class="col-lg-3 mb-0 mb-lg-0" id="note-card-holder-4">

            </div>


        </div>
        <!-- Gallery -->

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="js/script.js" id="rendered-js"></script>
    <script>fetchNotes("archived")</script>

</body>

</html>