<?php
$sql_users_single = "SELECT 
    id, 
    role, 
    bar, 
    image, 
    username, 
    ignoregarnish, 
    startpage, 
    language, 
    metricunits, 
    password
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

$sql_users_singlename = "SELECT 
    username 
FROM 
    user 
WHERE 
    id = ?;
";

$sql_users_create = "INSERT INTO user (username, password, bar, language) VALUES (?, ?, ?, ?);
";

$sql_users_changepassword = "UPDATE user 
SET password = ? 
WHERE id = ?;
";

$sql_users_changesettings = "UPDATE user 
SET image = ?, 
bar = ?, 
ignoregarnish = ?, 
startpage = ?, 
language = ?, 
metricunits = ?
WHERE id = ?;
";

?>