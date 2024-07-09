<?php
include 'config.php';

$sql = "SELECT id, title, content, is_archived, timestamp 
        FROM notes 
        WHERE user_id = '$_SESSION[user_id]'
        ORDER BY timestamp ASC";


$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0){
    $notes = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $notes[] = [
            'id' => htmlspecialchars($row['id']),
            'title' => htmlspecialchars($row['title']),
            'content' => htmlspecialchars($row['content']),
            'isArchived' => htmlspecialchars($row['is_archived'])
        ];
    }
    header('Content-Type: application/json');
    echo json_encode($notes);
} else{
    http_response_code(404);
    echo json_encode(['error' => 'No notes found']);
}


