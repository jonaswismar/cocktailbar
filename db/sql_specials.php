<?php
$sql_random_cocktails = "SELECT 
    c.* 
FROM 
    cocktail c
INNER JOIN (
    SELECT 
        cil.cocktail,
        COUNT(*) AS total_ingredients,
        SUM(CASE WHEN i.available = 1 THEN 1 ELSE 0 END) AS available_ingredients
    FROM 
        cocktailingredientlist cil
    INNER JOIN 
        ingredients i ON cil.ingredient = i.ID
    GROUP BY 
        cil.cocktail
    HAVING 
        available_ingredients = total_ingredients
) AS ingredient_check ON c.ID = ingredient_check.cocktail
ORDER BY 
    RAND() 
LIMIT ?;";
?>