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

$sql_fav_ingredients = "WITH ingredient_counts AS (
    SELECT 
        ingredient,
        COUNT(CASE WHEN available = 1 THEN 1 END) AS available_count,
        COUNT(CASE WHEN available = 1 OR shoppable = 1 THEN 1 END) AS shoppable_count,
        COUNT(*) AS total_count
    FROM 
        ingredientbar
    WHERE
        bar = ?
    GROUP BY 
        ingredient
),
my_favorites AS (
    SELECT 
        ingredient
    FROM 
        ingredientfavorite
    WHERE
       user = ?
)
SELECT 
    i.ID AS ingredient_ID, 
    i.ingredientname, 
    i.description, 
    i.image, 
    i.type,
    CASE 
        WHEN ic.available_count = ic.total_count AND ic.total_count > 0 THEN '1'
        ELSE '0'
    END AS available,
    CASE 
        WHEN ic.shoppable_count = ic.total_count AND ic.total_count > 0 THEN '1'
        ELSE '0'
    END AS shoppable
FROM 
    ingredient i
INNER JOIN 
    ingredient_counts ic ON i.ID = ic.ingredient
INNER JOIN
    my_favorites mf ON i.ID = mf.ingredient
ORDER BY 
    i.ingredientname ASC;
";
$sql_shop_ingredients = "WITH ingredient_counts AS (
    SELECT 
        ingredient,
        COUNT(CASE WHEN available = 1 THEN 1 END) AS available_count,
        COUNT(CASE WHEN available = 1 OR shoppable = 1 THEN 1 END) AS shoppable_count,
        COUNT(*) AS total_count
    FROM 
        ingredientbar
    WHERE
        bar = ? AND
        shoppable > 0
    GROUP BY 
        ingredient
)
SELECT 
    i.ID AS ingredient_ID, 
    i.ingredientname, 
    i.description, 
    i.image, 
    i.type,
    CASE 
        WHEN ic.available_count = ic.total_count AND ic.total_count > 0 THEN '1'
        ELSE '0'
    END AS available,
    CASE 
        WHEN ic.shoppable_count = ic.total_count AND ic.total_count > 0 THEN '1'
        ELSE '0'
    END AS shoppable
FROM 
    ingredient i
INNER JOIN 
    ingredient_counts ic ON i.ID = ic.ingredient
ORDER BY 
    i.ingredientname ASC;
";
$sql_my_ingredients = "WITH ingredient_counts AS (
    SELECT 
        ingredient,
        COUNT(CASE WHEN available = 1 THEN 1 END) AS available_count,
        COUNT(CASE WHEN available = 1 OR shoppable = 1 THEN 1 END) AS shoppable_count,
        COUNT(*) AS total_count
    FROM 
        ingredientbar
    WHERE
        bar = ?
    GROUP BY 
        ingredient
)
SELECT 
    i.ID AS ingredient_ID, 
    i.ingredientname, 
    i.description, 
    i.image, 
    i.type,
    CASE 
        WHEN ic.available_count = ic.total_count AND ic.total_count > 0 THEN '1'
        ELSE '0'
    END AS available,
    CASE 
        WHEN ic.shoppable_count = ic.total_count AND ic.total_count > 0 THEN '1'
        ELSE '0'
    END AS shoppable
FROM 
    ingredient i
INNER JOIN 
    ingredient_counts ic ON i.ID = ic.ingredient
ORDER BY 
    available DESC, 
    shoppable DESC, 
    i.ingredientname ASC;
";

$sql_all_ingredients = "WITH ingredient_counts AS (
    SELECT 
        ingredient,
        COUNT(CASE WHEN available = 1 THEN 1 END) AS available_count,
        COUNT(CASE WHEN available = 1 OR shoppable = 1 THEN 1 END) AS shoppable_count,
        COUNT(*) AS total_count
    FROM 
        ingredientbar
    WHERE
        bar = ?
    GROUP BY 
        ingredient
)
SELECT 
    i.ID AS ingredient_ID, 
    i.ingredientname, 
    i.description, 
    i.image, 
    i.type,
    CASE 
        WHEN ic.available_count = ic.total_count AND ic.total_count > 0 THEN '1'
        ELSE '0'
    END AS available,
    CASE 
        WHEN ic.shoppable_count = ic.total_count AND ic.total_count > 0 THEN '1'
        ELSE '0'
    END AS shoppable
FROM 
    ingredient i
INNER JOIN 
    ingredient_counts ic ON i.ID = ic.ingredient
ORDER BY 
    i.ingredientname ASC;
";




$sql_ingredients_from_type = "WITH ingredient_counts AS (
    SELECT 
        ingredient,
        COUNT(CASE WHEN available = 1 THEN 1 END) AS available_count,
        COUNT(CASE WHEN available = 1 OR shoppable = 1 THEN 1 END) AS shoppable_count,
        COUNT(*) AS total_count
    FROM 
        ingredientbar
    WHERE
        bar = ?
    GROUP BY 
        ingredient
)
SELECT 
    i.ID AS ingredient_ID, 
    i.ingredientname, 
    i.description, 
    i.image, 
    i.type,
    CASE 
        WHEN ic.available_count = ic.total_count AND ic.total_count > 0 THEN '1'
        ELSE '0'
    END AS available,
    CASE 
        WHEN ic.shoppable_count = ic.total_count AND ic.total_count > 0 THEN '1'
        ELSE '0'
    END AS shoppable
FROM 
    ingredient i
INNER JOIN 
    ingredient_counts ic ON i.ID = ic.ingredient
WHERE
    i.type = ?
ORDER BY 
    available DESC, 
    shoppable DESC, 
    i.ingredientname ASC;
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

$sql_ingredient = "WITH ingredient_counts AS (
    SELECT 
        ingredient,
        COUNT(CASE WHEN available = 1 THEN 1 END) AS available_count,
        COUNT(CASE WHEN shoppable = 1 THEN 1 END) AS shoppable_count,
        COUNT(*) AS total_count
    FROM 
        ingredientbar
    WHERE
        bar = ?
    GROUP BY 
        ingredient
)
SELECT 
    i.ID AS ingredient_ID, 
    i.ingredientname, 
    i.description, 
    i.image, 
    i.type,
    CASE 
        WHEN ic.available_count = ic.total_count AND ic.total_count > 0 THEN '1'
        ELSE '0'
    END AS available,
    CASE 
        WHEN ic.shoppable_count = ic.total_count AND ic.total_count > 0 THEN '1'
        ELSE '0'
    END AS shoppable
FROM 
    ingredient i
INNER JOIN 
    ingredient_counts ic ON i.ID = ic.ingredient
WHERE
	i.ID = ?
ORDER BY 
    available DESC, 
    shoppable DESC, 
    i.ingredientname ASC;
";

$sql_update_ingredient_available = "UPDATE ingredientbar 
SET 
    available = ?
WHERE
    bar = ? AND
    ingredient = ?;
";

$sql_update_ingredient_shoppable = "UPDATE ingredientbar 
SET 
    shoppable = ?
WHERE
    bar = ? AND
    ingredient = ?;
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

$sql_taste_usedin = "WITH ingredient_counts AS (
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
        SELECT DISTINCT cocktailtaste.cocktail
        FROM cocktailtaste
        WHERE cocktailtaste.taste = ?
    )
ORDER BY 
    available DESC, 
    shoppable DESC, 
    cocktail.cocktailname ASC;
";

$sql_ingredient_usedin = "WITH ingredient_counts AS (
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
        SELECT DISTINCT cocktailingredient.cocktail
        FROM cocktailingredient
        WHERE cocktailingredient.ingredient = ?
    )
ORDER BY 
    available DESC, 
    shoppable DESC, 
    cocktail.cocktailname ASC;
";

$sql_ingredients_from_cocktail = "WITH ingredient_counts AS (
    SELECT 
        ingredient,
        COUNT(CASE WHEN available = 1 THEN 1 END) AS available,
        COUNT(CASE WHEN shoppable = 1 THEN 1 END) AS shoppable,
        COUNT(*) AS total_count
    FROM 
        ingredientbar
    WHERE
        bar = ?
    GROUP BY 
        ingredient
)
SELECT 
    cil.ID AS cocktailingredientlist_ID, 
    cil.cocktail, 
    cil.ingredient, 
    cil.garnish, 
    cil.optional, 
    cil.order, 
    cil.quantity, 
    cil.unit,
    ic.available,
    ic.shoppable,
    i.ingredientname,
    i.image, 
    i.ID AS ingredient_ID
FROM 
    cocktailingredient cil
INNER JOIN 
    ingredient i ON cil.ingredient = i.ID
INNER JOIN 
    ingredient_counts ic ON cil.ingredient = ic.ingredient
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