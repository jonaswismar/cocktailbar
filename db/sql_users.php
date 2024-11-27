<?php
$sql_users_single = "SELECT 
    id, 
    username, 
    password,
    role,
    bar,
    image
FROM 
    user 
WHERE 
    username = ?;
";
$sql_users_singleid = "SELECT 
    id 
FROM 
    user 
WHERE 
    username = ?;
";

$sql_users_create = "INSERT INTO user (username, password, bar) VALUES (?, ?, ?);
";

$sql_users_changepassword = "UPDATE user 
SET password = ? 
WHERE id = ?;
";
?>