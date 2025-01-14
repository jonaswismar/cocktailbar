<?php
$sql_cocktail = "SELECT 
    cocktails.ID, 
    cocktails.cocktailname, 
    cocktails.description, 
    cocktails.glass, 
    cocktails.instruction, 
    cocktails.image, 
    cocktails.strength 
FROM 
    cocktails 
WHERE 
    cocktails.ID = ?;
";
$sql_update_cocktail = "UPDATE 
    cocktails
SET
    cocktailname = ?,
    description = ?,
    instruction = ?,
    image = ?
WHERE
    ID = ?;
";

$sql_create_cocktail = "INSERT INTO
    cocktails (cocktailname, description, instruction, image)
VALUES
    (?, ?, ?, ?);
";

$sql_delete_cocktail = "DELETE FROM
    cocktails
WHERE
    ID = ?;
";

$sql_my_cocktails = "WITH ingredient_counts AS (
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
    cocktails c
LEFT JOIN 
    ingredient_counts ic 
ON 
    c.ID = ic.cocktail_id
ORDER BY 
    available DESC, 
    shoppable DESC, 
    c.cocktailname ASC;";

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
    cocktails c
INNER JOIN 
    cocktailfavorites f ON c.ID = f.cocktail
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
    cocktails c
ORDER BY 
    c.cocktailname ASC;
";

$sql_cocktail = "SELECT 
    cocktails.ID, 
    cocktails.cocktailname, 
    cocktails.description, 
    cocktails.glass, 
    cocktails.instruction, 
    cocktails.image, 
    cocktails.strength 
FROM 
    cocktails 
WHERE 
    cocktails.ID = ?;
";
?>
