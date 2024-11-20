<?php
$sql_ingredientcount_usedin = "SELECT 
    COUNT(DISTINCT cocktail) AS total 
FROM 
    cocktailingredient 
WHERE 
    ingredient = ?;
";

$sql_delete_ingredient = "DELETE FROM
    ingredient
WHERE
    ID = ?;
";

$sql_fav_ingredients = "SELECT 
    i.ID AS ingredient_ID, 
    i.ingredientname, 
    i.description, 
    i.image, 
    i.available, 
    i.shoppable, 
    i.type 
FROM 
    ingredient i 
INNER JOIN 
    ingredientfavorite f ON i.ID = f.ingredient
WHERE 
    f.user = ?
ORDER BY 
    i.ingredientname ASC;
";
$sql_shop_ingredients = "SELECT 
    i.ID AS ingredient_ID, 
    i.ingredientname, 
    i.description, 
    i.image, 
    i.available, 
    i.shoppable, 
    i.type 
FROM 
    ingredient i 
WHERE 
    i.shoppable > 0
ORDER BY 
    i.ingredientname ASC;
";
$sql_my_ingredients = "WITH ingredient_counts AS (
    SELECT 
        ID,
        COUNT(CASE WHEN available = 1 THEN 1 END) AS available_count,
        COUNT(CASE WHEN available = 1 OR shoppable = 1 THEN 1 END) AS shoppable_count,
        COUNT(*) AS total_count
    FROM 
        ingredient
    GROUP BY 
        ID
)
SELECT 
    i.ID AS ingredient_ID, 
    i.ingredientname, 
    i.description, 
    i.image, 
    i.available, 
    i.shoppable, 
    i.type,
    CASE 
        WHEN ic.available_count = ic.total_count AND ic.total_count > 0 THEN '1'
        ELSE '0'
    END AS available_sort,
    CASE 
        WHEN ic.shoppable_count = ic.total_count AND ic.total_count > 0 THEN '1'
        ELSE '0'
    END AS shoppable_sort
FROM 
    ingredient i
INNER JOIN 
    ingredient_counts ic ON i.ID = ic.ID
ORDER BY 
    available_sort DESC, 
    shoppable_sort DESC, 
    i.ingredientname ASC;
";

$sql_all_ingredients = "SELECT 
    ID AS ingredient_ID, 
    ingredientname, 
    description, 
    image, 
    available, 
    shoppable, 
    type 
FROM 
    ingredient 
ORDER BY 
    ingredientname ASC;
";

$sql_create_ingredient = "INSERT INTO
    ingredient (ingredientname, description, image, available, shoppable, type) 
VALUES
    (?, ?, ?, ?, ?, ?);
";

$sql_update_ingredient = "UPDATE ingredient 
SET 
    ingredientname = ?, 
    description = ?, 
    image = ?, 
    available = ?, 
    shoppable = ?, 
    type = ? 
WHERE 
    ID = ?;
";

$sql_ingredient = "SELECT 
    ID AS ingredient_ID, 
    ingredientname, 
    description, 
    image, 
    available, 
    shoppable, 
    type 
FROM 
    ingredient 
WHERE 
    ID = ?;
";

$sql_update_ingredient_available = "UPDATE ingredient 
SET 
    available = ?
WHERE 
    ID = ?;
";

$sql_update_ingredient_shoppable = "UPDATE ingredient 
SET 
    shoppable = ?
WHERE 
    ID = ?;
";

$sql_ingredient_usedin_old = "SELECT 
    c.ID, 
    c.cocktailname,
    cil.cocktail
FROM 
    cocktail c
INNER JOIN 
    cocktailingredient cil ON c.ID = cil.cocktail
WHERE 
    cil.ingredient = ?
GROUP BY 
    c.ID, c.cocktailname
ORDER BY 
    c.cocktailname ASC;
";

$sql_ingredient_usedin = "WITH ingredient_counts AS (
    SELECT 
        cocktailingredient.cocktail AS cocktail_id,
        COUNT(*) AS total_ingredients,
        SUM(CASE WHEN ingredients.available = 1 THEN 1 ELSE 0 END) AS available_ingredients,
        SUM(CASE WHEN ingredients.available = 1 OR ingredients.shoppable = 1 THEN 1 ELSE 0 END) AS shoppable_ingredients
    FROM 
        cocktailingredient
    INNER JOIN 
        ingredient 
    ON 
        cocktailingredient.ingredient = ingredients.ID
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
        SELECT DISTINCT cocktailingredientlist.cocktail
        FROM cocktailingredient
        WHERE cocktailingredient.ingredient = ?
    )
ORDER BY 
    available DESC, 
    shoppable DESC, 
    cocktail.cocktailname ASC;
";

$sql_ingredients_from_cocktail = "SELECT 
    cil.ID AS cocktailingredientlist_ID, 
    cil.cocktail, 
    cil.ingredient, 
    cil.garnish, 
    cil.optional, 
    cil.order, 
    cil.quantity, 
    cil.unit, 
    i.ingredientname, 
    i.available, 
    i.image, 
    i.shoppable, 
    i.ID AS ingredient_ID
FROM 
    cocktailingredient cil
INNER JOIN 
    ingredient i ON cil.ingredient = i.ID
WHERE 
    cil.cocktail = ?
ORDER BY 
    cil.order ASC, 
    cil.ID ASC;
";

$sql_delete_all_ingredient = "DELETE FROM
    ingredient
WHERE
    ID = ?;
";
?>