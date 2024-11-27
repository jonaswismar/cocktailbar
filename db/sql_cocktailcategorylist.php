<?php
$sql_cocktailcategorylists = "SELECT 
    ID, 
    cocktail, 
    category
FROM 
    cocktailcategory 
ORDER BY 
    cocktail ASC,
    category ASC;
";

$sql_cocktailcategorylist = "SELECT 
    ID, 
    cocktail, 
    category
FROM 
    cocktailcategory
WHERE
	cocktail = ?
AND
category = ?;
";

$sql_delete_cocktailcategorylist = "DELETE FROM
    cocktailcategory
WHERE
    cocktail = ?
";

$sql_create_cocktailcategorylist = "INSERT INTO
    cocktailcategory (cocktail, category)
VALUES
    (?, ?);
";
?>