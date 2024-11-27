<?php
$sql_cocktailtastelists = "SELECT 
    ID, 
    cocktail, 
    taste
FROM 
    cocktailtaste 
ORDER BY 
    cocktail ASC,
    taste ASC;
";

$sql_cocktailtastelist = "SELECT 
    ID, 
    cocktail, 
    taste
FROM 
    cocktailtaste
WHERE
	cocktail = ?
AND
	taste = ?;
";

$sql_delete_cocktailtastelist = "DELETE FROM
    cocktailtaste
WHERE
    cocktail = ?
";

$sql_create_cocktailtastelist = "INSERT INTO
    cocktailtaste (cocktail, taste)
VALUES
    (?, ?);
";
?>