<?php
$sql_stats_count_cocktail= "SELECT
COUNT(*) AS SUM
FROM 
    cocktail;";

$sql_stats_count_ingredient= "SELECT
COUNT(*) AS SUM
FROM 
    ingredient;";

$sql_stats_count_order= "SELECT
COUNT(*) AS SUM
FROM 
    `order`;";

$sql_stats_count_ingredienttype= "SELECT
COUNT(*) AS SUM
FROM 
    ingredienttype;";

$sql_stats_count_taste= "SELECT
COUNT(*) AS SUM
FROM 
    taste;";

$sql_stats_count_user= "SELECT
COUNT(*) AS SUM
FROM 
    user;";

$sql_stats_count_category= "SELECT
COUNT(*) AS SUM
FROM 
    category;";
?>