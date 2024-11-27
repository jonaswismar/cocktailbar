<?php
$sql_roles_single = "SELECT 
    id, 
    rolename, 
    image
FROM 
    role 
WHERE 
    id = ?;
";
$sql_roles_image = "SELECT 
    image
FROM 
    role 
WHERE 
    id = ?;
";
?>