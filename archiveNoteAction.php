<?php
include 'config.php';

$id = $_POST['id'];

if(isset($_POST['isRecover'])){
    $sql = "UPDATE notes SET is_archived = 'false' WHERE id = '$id'";
    mysqli_query($conn, $sql);
    echo "false";
    $conn->close();
}

$isArchived = $_POST['isArchived'];

$id = mysqli_real_escape_string($conn, $id);
$isArchived = mysqli_real_escape_string($conn, $isArchived);


if ($id == '-1') {
   
} else {

    if($isArchived == 'false'){
        $sql = "UPDATE notes SET is_archived = 'true' WHERE id = '$id'";
    } else{
        $sql = "DELETE FROM notes WHERE id = '$id'";
    }
    
}

mysqli_query($conn, $sql);

echo $isArchived;

$conn->close();
