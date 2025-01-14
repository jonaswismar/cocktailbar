<?php
$sql_cocktailtastelists = "SELECT 
    ID, 
    cocktail, 
    taste
FROM 
    cocktailtasteslist 
ORDER BY 
    cocktail ASC,
    taste ASC;
";

$sql_cocktailtastelist = "SELECT 
    ID, 
    cocktail, 
    taste
FROM 
    cocktailtasteslist
WHERE
	cocktail = ?
AND
	taste = ?;
";

$sql_delete_cocktailtastelist = "DELETE FROM
    cocktailtasteslist
WHERE
    cocktail = ?
";

$sql_create_cocktailtastelist = "INSERT INTO
    cocktailtasteslist (cocktail, taste)
VALUES
    (?, ?);
";
?>