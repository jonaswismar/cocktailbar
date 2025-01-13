<?php
$sql_roles = "SELECT 
    id, 
    rolename, 
    icon
FROM 
    role;
";


$sql_roles_single = "SELECT 
    id, 
    rolename, 
    icon
FROM 
    role 
WHERE 
    id = ?;
";

$sql_roles_icon = "SELECT 
    icon
FROM 
    role 
WHERE 
    id = ?;
";
?>