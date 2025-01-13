<?php
$sql_cocktail = "SELECT 
    cocktail.ID, 
    cocktail.cocktailname, 
    cocktail.description, 
    cocktail.glass, 
    cocktail.instruction, 
    cocktail.image, 
    cocktail.strength 
FROM 
    cocktail 
WHERE 
    cocktail.ID = ?;
";
$sql_update_cocktail = "UPDATE 
    cocktail
SET
    cocktailname = ?,
    description = ?,
    instruction = ?,
    image = ?
WHERE
    ID = ?;
";

$sql_create_cocktail = "INSERT INTO
    cocktail (cocktailname, description, instruction, image)
VALUES
    (?, ?, ?, ?);
";

$sql_delete_cocktail = "DELETE FROM
    cocktail
WHERE
    ID = ?;
";

$sql_my_cocktails = "WITH ingredient_counts AS (
    SELECT 
        cocktailingredient.cocktail AS cocktail_id,
        COUNT(*) AS total_ingredients,
        SUM(CASE WHEN cocktailingredient.garnish = 1 THEN 1 ELSE 0 END) AS garnish_ingredients,
        SUM(CASE WHEN cocktailingredient.optional = 1 THEN 1 ELSE 0 END) AS optional_ingredients,
        SUM(CASE WHEN ingredientbar.available = 1 OR cocktailingredient.garnish = 1 OR cocktailingredient.optional THEN 1 ELSE 0 END) AS available_ingredients,
        SUM(CASE WHEN ingredientbar.available = 1 OR cocktailingredient.garnish = 1 OR cocktailingredient.optional OR ingredientbar.shoppable = 1 THEN 1 ELSE 0 END) AS shoppable_ingredients
    FROM 
        cocktailingredient
    INNER JOIN 
        ingredientbar 
    ON 
        cocktailingredient.ingredient = ingredientbar.ingredient
    WHERE
        ingredientbar.bar = ?
    GROUP BY 
        cocktailingredient.cocktail
)
SELECT 
    c.ID, 
    c.cocktailname, 
    c.description, 
    c.glass, 
    c.instruction, 
    c.image, 
    c.strength, 
    IF(ic.available_ingredients = ic.total_ingredients AND ic.total_ingredients > 0, '1', '0') AS available,
    IF(ic.shoppable_ingredients = ic.total_ingredients AND ic.total_ingredients > 0, '1', '0') AS shoppable
FROM 
    cocktail c
LEFT JOIN 
    ingredient_counts ic 
ON 
    c.ID = ic.cocktail_id
ORDER BY 
    available DESC, 
    shoppable DESC, 
    c.cocktailname ASC;";

$sql_my_cocktails_random = "WITH ingredient_counts AS (
    SELECT 
        cocktailingredient.cocktail AS cocktail_id,
        COUNT(*) AS total_ingredients,
        SUM(CASE WHEN cocktailingredient.garnish = 1 THEN 1 ELSE 0 END) AS garnish_ingredients,
        SUM(CASE WHEN cocktailingredient.optional = 1 THEN 1 ELSE 0 END) AS optional_ingredients,
        SUM(CASE WHEN ingredientbar.available = 1 THEN 1 ELSE 0 END) AS available_ingredients
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
    c.ID, 
    c.cocktailname, 
    c.description, 
    c.glass, 
    c.instruction, 
    c.image, 
    c.strength, 
    IF(ic.available_ingredients = ic.total_ingredients AND ic.total_ingredients > 0, '1', '0') AS available
FROM 
    cocktail c
LEFT JOIN 
    ingredient_counts ic 
ON 
    c.ID = ic.cocktail_id
ORDER BY 
    available DESC, 
    RAND()
LIMIT 1;";

$sql_my_cocktails_day = "WITH ingredient_counts AS (
    SELECT 
        cocktailingredient.cocktail AS cocktail_id,
        COUNT(*) AS total_ingredients,
        SUM(CASE WHEN cocktailingredient.garnish = 1 THEN 1 ELSE 0 END) AS garnish_ingredients,
        SUM(CASE WHEN cocktailingredient.optional = 1 THEN 1 ELSE 0 END) AS optional_ingredients,
        SUM(CASE WHEN ingredientbar.available = 1 THEN 1 ELSE 0 END) AS available_ingredients
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
    c.ID, 
    c.cocktailname, 
    c.description, 
    c.glass, 
    c.instruction, 
    c.image, 
    c.strength, 
    IF(ic.available_ingredients = ic.total_ingredients AND ic.total_ingredients > 0, '1', '0') AS available
FROM 
    cocktail c
LEFT JOIN 
    ingredient_counts ic 
ON 
    c.ID = ic.cocktail_id
ORDER BY 
    available DESC, 
    RAND(CURDATE())
LIMIT 1;";

$sql_fav_cocktails = "SELECT 
    c.ID, 
    c.cocktailname, 
    c.description, 
    c.glass, 
    c.instruction, 
    c.image, 
    c.strength, 
    f.user, 
    f.cocktail 
FROM 
    cocktail c
INNER JOIN 
    cocktailfavorite f ON c.ID = f.cocktail
WHERE 
    f.user = ?
ORDER BY 
    c.cocktailname ASC;
";

$sql_all_cocktails = "SELECT 
    c.ID, 
    c.cocktailname, 
    c.description, 
    c.glass, 
    c.instruction, 
    c.image, 
    c.strength
FROM 
    cocktail c
ORDER BY 
    c.cocktailname ASC;
";

$sql_cocktail = "SELECT 
    cocktail.ID, 
    cocktail.cocktailname, 
    cocktail.description, 
    cocktail.glass, 
    cocktail.instruction, 
    cocktail.image, 
    cocktail.strength 
FROM 
    cocktail 
WHERE 
    cocktail.ID = ?;
";

$sql_delete_cocktail = "DELETE FROM
    cocktail
WHERE
    ID = ?
";
?>
