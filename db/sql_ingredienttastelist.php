<?php
$sql_ingredienttastelists = "SELECT 
    ID, 
    ingredient, 
    taste
FROM 
    ingredienttasteslist 
ORDER BY 
    ingredient ASC,
    taste ASC;
";

$sql_ingredienttastelist = "SELECT 
    ID, 
    ingredient, 
    taste
FROM 
    ingredienttasteslist
WHERE
	ingredient = ?
AND
	taste = ?;
";

$sql_delete_ingredienttastelist = "DELETE FROM
    ingredienttasteslist
WHERE
    ingredient = ?
";

$sql_create_ingredienttastelist = "INSERT INTO
    ingredienttasteslist (ingredient, taste)
VALUES
    (?, ?);
";
?>