<?php
$sql_users_single = "SELECT 
    id, 
    username, 
    password,
    role,
    image
FROM 
    users 
WHERE 
    username = ?;
";
$sql_users_singleid = "SELECT 
    id 
FROM 
    users 
WHERE 
    username = ?;
";

$sql_users_create = "INSERT INTO users (username, password) VALUES (?, ?);
";

$sql_users_changepassword = "UPDATE users 
SET password = ? 
WHERE id = ?;
";
?>