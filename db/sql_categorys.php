<?php
$sql_categories_from_cocktail = "SELECT 
    ccl.ID AS cocktailcategorylist_ID, 
    ccl.category, 
    cat.categoryname, 
    cat.color, 
    cat.ID AS category_ID 
FROM 
    cocktailcategory ccl
INNER JOIN 
    categorys cat ON cat.ID = ccl.category
WHERE 
    ccl.cocktail = ?
ORDER BY 
    cat.categoryname ASC;
";

$sql_categorys = "SELECT 
    ca.ID, 
    ca.categoryname, 
    ca.description, 
    ca.image, 
    COUNT(ccl.ID) AS total_cocktails
FROM 
    category ca
LEFT JOIN 
    cocktailcategory ccl ON ccl.category = ca.ID
GROUP BY 
    ca.ID, 
    ca.categoryname, 
    ca.description, 
    ca.image
ORDER BY 
    ca.categoryname ASC;
";

$sql_category = "SELECT 
    ID, 
    categoryname, 
    description, 
    image 
FROM 
    category 
WHERE 
    ID = ?;
";

$sql_update_category = "UPDATE 
    category
SET
    categoryname = ?,
    description = ?,
    image = ?
WHERE
    ID = ?;
";

$sql_create_category = "INSERT INTO
    category (categoryname, description, image)
VALUES
    (?, ?, ?);
";

$sql_delete_category = "DELETE FROM
    category
WHERE
    ID = ?;
";

$sql_category_count = "SELECT 
    COUNT(*) AS total 
FROM 
    cocktailcategory 
WHERE 
    category = ?;
";
?>