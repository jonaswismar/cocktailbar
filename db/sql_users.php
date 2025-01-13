<?php
$sql_users_barkeeper = "SELECT 
    id, 
    role, 
    bar, 
    icon, 
    username
FROM 
    user 
WHERE 
    role = 1 OR role = 2;
";

$sql_users_single = "SELECT 
    id, 
    role, 
    bar, 
    icon, 
    username, 
    ignoregarnish, 
    startpage, 
    language, 
    metricunits, 
    searchmode, 
    darkmode, 
    theme, 
    password
FROM 
    user 
WHERE 
    username = ?;
";

$sql_users_singlebyid = "SELECT 
    id, 
    role, 
    bar, 
    icon, 
    username, 
    ignoregarnish, 
    startpage, 
    language, 
    metricunits, 
    searchmode, 
    darkmode, 
    theme, 
    password
FROM 
    user 
WHERE 
    id = ?;
";
$sql_users = "SELECT 
    id, 
    role, 
    bar, 
    icon, 
    username, 
    ignoregarnish, 
    startpage, 
    language, 
    metricunits, 
    searchmode, 
    darkmode, 
    theme
FROM 
    user;
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

$sql_users_create2 = "INSERT INTO user (username, role, icon, password) VALUES (?, ?, ?, ?);
";


$sql_users_changepassword = "UPDATE user 
SET password = ? 
WHERE id = ?;
";

$sql_users_change2 = "UPDATE user 
SET username = ?,
role = ?,
icon = ? 
WHERE id = ?;
";

$sql_users_changesettings = "UPDATE user 
SET icon = ?, 
bar = ?, 
ignoregarnish = ?, 
startpage = ?, 
language = ?, 
metricunits = ?,
searchmode = ?,
darkmode = ?,
theme = ?
WHERE id = ?;
";

$sql_user_delete = "DELETE FROM 
    user 
WHERE 
    id = ?;
";

?>