<?php
$sql_cocktailtoollists = "SELECT 
    ID, 
    cocktail, 
    tool
FROM 
    cocktailtool 
ORDER BY 
    cocktail ASC,
    tool ASC;
";

$sql_cocktailtoollist = "SELECT 
    ID, 
    cocktail, 
    tool
FROM 
    cocktailtool
WHERE
    cocktail = ?
AND
category = ?;
";

$sql_delete_cocktailtoollist = "DELETE FROM
    cocktailtool
WHERE
    cocktail = ?
";

$sql_create_cocktailtoollist = "INSERT INTO
    cocktailtool (cocktail, tool)
VALUES
    (?, ?);
";
?>