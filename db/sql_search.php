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

$sql_search_bool_category = "SELECT 
    c.ID, 
    c.categoryname, 
    c.icon, 
    c.description,
    c.cocktail_count,
    MATCH(categoryname, description) AGAINST(? IN BOOLEAN MODE) AS score
FROM 
    category c
HAVING score > 0 ORDER BY score DESC, c.categoryname ASC;
";

$sql_search_bool_ingredienttype = "SELECT 
    it.ID, 
    it.typename, 
    it.icon, 
    it.description,
    it.ingredient_count,
    MATCH(typename, description) AGAINST(? IN BOOLEAN MODE) AS score
FROM 
    ingredienttype it
HAVING score > 0 ORDER BY score DESC, it.typename ASC;
";

$sql_search_bool_taste = "SELECT 
    t.ID, 
    t.taste, 
    t.icon, 
    t.description,
    t.ingredient_count, 
    t.cocktail_count, 
    MATCH(taste, description) AGAINST(? IN BOOLEAN MODE) AS score
FROM 
    taste t
HAVING score > 0 ORDER BY score DESC, t.taste ASC;
";

$sql_search_bool_unit = "SELECT 
    u.ID, 
    u.unitshort, 
    u.unitshortX, 
    u.description, 
    u.icon, 
    u.unitname,
    MATCH(unitshort, unitshortX, description, unitname) AGAINST(? IN BOOLEAN MODE) AS score
FROM 
    unit u
HAVING score > 0 ORDER BY score DESC, u.unitname ASC;
";

$sql_search_bool_wiki = "SELECT DISTINCT * FROM (
	SELECT 
		w.ID, 
		w.wikiname, 
		w.content, 
		w.subcontent, 
		w.icon, 
		MATCH(wikiname) AGAINST(? IN BOOLEAN MODE) AS score
	FROM 
		wiki w
	HAVING score > 0
	UNION ALL
	SELECT 
		w.ID, 
		w.wikiname, 
		w.content, 
		w.subcontent, 
		w.icon, 
		MATCH(content) AGAINST(? IN BOOLEAN MODE) AS score
	FROM 
		wiki w
	HAVING score > 0
	UNION ALL
	SELECT 
		w.ID, 
		w.wikiname, 
		w.content, 
		w.subcontent, 
		w.icon, 
		MATCH(content) AGAINST(? IN BOOLEAN MODE) AS score
	FROM 
		wiki w
	HAVING score > 0
	) a
	ORDER BY score DESC, wikiname ASC;
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

$sql_search_nat_ingredient = "WITH ingredient_counts AS (
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
    MATCH(ingredientname) AGAINST(? IN NATURAL LANGUAGE MODE) AS score
FROM 
    ingredient i
INNER JOIN 
    ingredient_counts ic ON i.ID = ic.ingredient
HAVING score > 0
ORDER BY 
    score DESC,
    i.ingredientname ASC;
";

$sql_search_nat_category = "SELECT 
    c.ID, 
    c.categoryname, 
    c.image, 
    c.description,
    c.cocktail_count,
    MATCH(categoryname, description) AGAINST(? IN NATURAL LANGUAGE MODE) AS score
FROM 
    category c
HAVING score > 0 ORDER BY score DESC, c.categoryname ASC;
";

$sql_search_nat_ingredienttype = "SELECT 
    it.ID, 
    it.typename, 
    it.icon, 
    it.description,
    it.ingredient_count,
    MATCH(typename, description) AGAINST(? IN NATURAL LANGUAGE MODE) AS score
FROM 
    ingredienttype it
HAVING score > 0 ORDER BY score DESC, it.typename ASC;
";

$sql_search_nat_taste = "SELECT 
    t.ID, 
    t.taste, 
    t.icon, 
    t.description, 
    t.ingredient_count, 
    t.cocktail_count, 
    MATCH(taste, description) AGAINST(? IN NATURAL LANGUAGE MODE) AS score
FROM 
    taste t
HAVING score > 0 ORDER BY score DESC, t.taste ASC;
";

$sql_search_nat_unit = "SELECT 
    u.ID, 
    u.unitshort, 
    u.unitshortX, 
    u.description, 
    u.icon, 
    u.unitname,
    MATCH(unitshort, unitshortX, description, unitname) AGAINST(? IN NATURAL LANGUAGE MODE) AS score
FROM 
    unit u
HAVING score > 0 ORDER BY score DESC, u.unitname ASC;
";

$sql_search_nat_wiki = "SELECT DISTINCT * FROM (
	SELECT 
		w.ID, 
		w.wikiname, 
		w.content, 
		w.subcontent, 
		w.icon, 
		MATCH(wikiname) AGAINST(? IN NATURAL LANGUAGE MODE) AS score
	FROM 
		wiki w
	HAVING score > 0
	UNION ALL
	SELECT 
		w.ID, 
		w.wikiname, 
		w.content, 
		w.subcontent, 
		w.icon, 
		MATCH(content) AGAINST(? IN NATURAL LANGUAGE MODE) AS score
	FROM 
		wiki w
	HAVING score > 0
	UNION ALL
	SELECT 
		w.ID, 
		w.wikiname, 
		w.content, 
		w.subcontent, 
		w.icon, 
		MATCH(content) AGAINST(? IN NATURAL LANGUAGE MODE) AS score
	FROM 
		wiki w
	HAVING score > 0
	) a
	ORDER BY score DESC, wikiname ASC;
";
?>