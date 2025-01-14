<?php
$sql_categories_from_cocktail = "SELECT 
    ccl.ID AS cocktailcategorylist_ID, 
    ccl.category, 
    cat.categoryname, 
    cat.color, 
    cat.ID AS category_ID 
FROM 
    cocktailcategorylist ccl
INNER JOIN 
    categorys cat ON cat.ID = ccl.category
WHERE 
    ccl.cocktail = ?
ORDER BY 
    cat.categoryname ASC;
";

$sql_categorys = "SELECT 
    ID, 
    categoryname, 
    description, 
    image 
FROM 
    categorys 
ORDER BY 
    categoryname ASC;
";

$sql_category = "SELECT 
    ID, 
    categoryname, 
    description, 
    image 
FROM 
    categorys 
WHERE 
    ID = ?;
";

$sql_update_category = "UPDATE 
    categorys
SET
    categoryname = ?,
    description = ?,
    image = ?
WHERE
    ID = ?;
";

$sql_create_category = "INSERT INTO
    categorys (categoryname, description, image)
VALUES
    (?, ?, ?);
";

$sql_delete_category = "DELETE FROM
    categorys
WHERE
    ID = ?;
";

$sql_category_count = "SELECT 
    COUNT(*) AS total 
FROM 
    cocktailcategorylist 
WHERE 
    category = ?;
";
?>