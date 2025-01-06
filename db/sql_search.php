<?php
$sql_search_bool_cocktail = "SELECT 
    c.ID, 
    c.cocktailname, 
    c.description, 
    c.glass, 
    c.instruction, 
    c.image, 
    c.ingredients,
    c.strength,
    MATCH(cocktailname, ingredients) AGAINST(? IN BOOLEAN MODE) AS score
FROM 
    cocktail c
HAVING score > 0 ORDER BY score DESC, c.cocktailname ASC;
";

$sql_search_bool_ingredient = "WITH ingredient_counts AS (
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
    END AS shoppable,
    MATCH(ingredientname) AGAINST(? IN BOOLEAN MODE) AS score
FROM 
    ingredient i
INNER JOIN 
    ingredient_counts ic ON i.ID = ic.ingredient
HAVING score > 0
ORDER BY 
    score DESC,
    i.ingredientname ASC;
";


$sql_search_nat_cocktail = "SELECT 
    c.ID, 
    c.cocktailname, 
    c.description, 
    c.glass, 
    c.instruction, 
    c.image, 
    c.ingredients,
    c.strength,
    MATCH(cocktailname, ingredients) AGAINST(? IN NATURAL LANGUAGE MODE) AS score
FROM 
    cocktail c
HAVING score > 0 ORDER BY score DESC, c.cocktailname ASC;
";

$sql_search_nat_ingredient = "SELECT ID, ingredientname, MATCH(ingredientname) AGAINST(? IN NATURAL LANGUAGE MODE) AS score FROM ingredient HAVING score > 0 ORDER BY score DESC;
";

?>