<?php
include 'config.php';

$uname = $_POST['uname'];
$pword = $_POST['pword'];

$_SESSION['success'] = "";

if(empty($uname)){ 
    echo "Username Required";
    return;
}

$sql = "SELECT * FROM users WHERE username = '$uname'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        if ($row["password"] == $pword)
        {
          $_SESSION['user_id'] = $row["id"];
            echo "success";
        }else {
            echo "Incorrect password or username.";
        }
  }
} else {
  echo "Incorrect password or username.";
}

$conn->close();