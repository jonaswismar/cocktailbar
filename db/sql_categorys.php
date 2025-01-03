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

$sql_category_usedin = "WITH ingredient_counts AS (
    SELECT 
        cocktailingredient.cocktail AS cocktail_id,
        COUNT(*) AS total_ingredients,
        SUM(CASE WHEN ingredientbar.available = 1 THEN 1 ELSE 0 END) AS available_ingredients,
        SUM(CASE WHEN ingredientbar.available = 1 OR ingredientbar.shoppable = 1 THEN 1 ELSE 0 END) AS shoppable_ingredients
    FROM 
        cocktailingredient
    INNER JOIN 
        ingredientbar
    ON 
        cocktailingredient.ingredient = ingredientbar.ingredient
    GROUP BY 
        cocktailingredient.cocktail
)
SELECT 
    cocktail.*, 
    IF(ic.available_ingredients = ic.total_ingredients AND ic.total_ingredients > 0, '1', '0') AS available,
    IF(ic.shoppable_ingredients = ic.total_ingredients AND ic.total_ingredients > 0, '1', '0') AS shoppable
FROM 
    cocktail
LEFT JOIN 
    ingredient_counts ic 
ON 
    cocktail.ID = ic.cocktail_id
WHERE 
    cocktail.ID IN (
        SELECT DISTINCT cocktailcategory.cocktail
        FROM cocktailcategory
        WHERE cocktailcategory.category = ?
    )
ORDER BY 
    available DESC, 
    shoppable DESC, 
    cocktail.cocktailname ASC;
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
    cocktail_count, 
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