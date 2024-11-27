<?php
$sql_ingredienttastelists = "SELECT 
    ID, 
    ingredient, 
    taste
FROM 
    ingredienttaste 
ORDER BY 
    ingredient ASC,
    taste ASC;
";

$sql_ingredienttastelist = "SELECT 
    ID, 
    ingredient, 
    taste
FROM 
    ingredienttaste
WHERE
	ingredient = ?
AND
	taste = ?;
";

$sql_delete_ingredienttastelist = "DELETE FROM
    ingredienttaste
WHERE
    ingredient = ?
";

$sql_create_ingredienttastelist = "INSERT INTO
    ingredienttaste (ingredient, taste)
VALUES
    (?, ?);
";
?>