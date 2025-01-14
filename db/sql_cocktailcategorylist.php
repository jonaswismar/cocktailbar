<?php
$sql_cocktailcategorylists = "SELECT 
    ID, 
    cocktail, 
    category
FROM 
    cocktailcategorylist 
ORDER BY 
    cocktail ASC,
    category ASC;
";

$sql_cocktailcategorylist = "SELECT 
    ID, 
    cocktail, 
    category
FROM 
    cocktailcategorylist
WHERE
	cocktail = ?
AND
category = ?;
";

$sql_delete_cocktailcategorylist = "DELETE FROM
    cocktailcategorylist
WHERE
    cocktail = ?
";

$sql_create_cocktailcategorylist = "INSERT INTO
    cocktailcategorylist (cocktail, category)
VALUES
    (?, ?);
";
?>