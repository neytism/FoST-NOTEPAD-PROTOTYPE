<?php
include 'config.php';

$id = $_POST['id'];
$user_id = $_SESSION['user_id'];
$title = $_POST['title'];
$content = $_POST['content'];

$id = mysqli_real_escape_string($conn, $id);
$user_id = mysqli_real_escape_string($conn, $user_id);
$title = mysqli_real_escape_string($conn, $title);
$content = mysqli_real_escape_string($conn, $content);


if ($id == '-1') {
    $sql = "SELECT id FROM notes ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $last_id = $row['id'];
        $last_number = intval($last_id);
        $next_id = $last_number + 1;
    } else {
        $next_id = 1;
    }

    $id =  $next_id;

    
    $sql = "INSERT INTO notes(id, user_id, title, content) VALUES('$id','$user_id','$title','$content')";
} else {
    $sql = "UPDATE notes SET title='$title', content= '$content', timestamp = current_timestamp WHERE id = '$id'";

}

mysqli_query($conn, $sql);

echo $id;

$conn->close();
