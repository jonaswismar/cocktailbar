<?php
$sql_ingredientcount_usedin = "SELECT 
    COUNT(DISTINCT cocktail) AS total 
FROM 
    cocktailingredientlist 
WHERE 
    ingredient = ?;
";

$sql_delete_ingredient = "DELETE FROM
    ingredients
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
    ingredients i 
INNER JOIN 
    ingredientfavorites f ON i.ID = f.ingredient
WHERE 
    f.user = ?
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
        ingredients
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
    ingredients i
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
    ingredients 
ORDER BY 
    ingredientname ASC;
";

$sql_create_ingredient = "INSERT INTO
    ingredients (ingredientname, description, image, available, shoppable, type) 
VALUES
    (?, ?, ?, ?, ?, ?);
";

$sql_update_ingredient = "UPDATE ingredients 
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
    ingredients 
WHERE 
    ID = ?;
";

$sql_update_ingredient_available = "UPDATE ingredients 
SET 
    available = ?
WHERE 
    ID = ?;
";

$sql_update_ingredient_shoppable = "UPDATE ingredients 
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
    cocktails c
INNER JOIN 
    cocktailingredientlist cil ON c.ID = cil.cocktail
WHERE 
    cil.ingredient = ?
GROUP BY 
    c.ID, c.cocktailname
ORDER BY 
    c.cocktailname ASC;
";

$sql_ingredient_usedin = "WITH ingredient_counts AS (
    SELECT 
        cocktailingredientlist.cocktail AS cocktail_id,
        COUNT(*) AS total_ingredients,
        SUM(CASE WHEN ingredients.available = 1 THEN 1 ELSE 0 END) AS available_ingredients,
        SUM(CASE WHEN ingredients.available = 1 OR ingredients.shoppable = 1 THEN 1 ELSE 0 END) AS shoppable_ingredients
    FROM 
        cocktailingredientlist
    INNER JOIN 
        ingredients 
    ON 
        cocktailingredientlist.ingredient = ingredients.ID
    GROUP BY 
        cocktailingredientlist.cocktail
)
SELECT 
    cocktails.*, 
    IF(ic.available_ingredients = ic.total_ingredients AND ic.total_ingredients > 0, '1', '0') AS available,
    IF(ic.shoppable_ingredients = ic.total_ingredients AND ic.total_ingredients > 0, '1', '0') AS shoppable
FROM 
    cocktails
LEFT JOIN 
    ingredient_counts ic 
ON 
    cocktails.ID = ic.cocktail_id
WHERE 
    cocktails.ID IN (
        SELECT DISTINCT cocktailingredientlist.cocktail
        FROM cocktailingredientlist
        WHERE cocktailingredientlist.ingredient = ?
    )
ORDER BY 
    available DESC, 
    shoppable DESC, 
    cocktails.cocktailname ASC;
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
    cocktailingredientlist cil
INNER JOIN 
    ingredients i ON cil.ingredient = i.ID
WHERE 
    cil.cocktail = ?
ORDER BY 
    cil.order ASC, 
    cil.ID ASC;
";

$sql_delete_all_ingredient = "DELETE FROM
    ingredients
WHERE
    ID = ?;
";
?>