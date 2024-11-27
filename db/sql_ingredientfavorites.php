<?php
$sql_ingredientfavorite = "SELECT 
    ingredientfavorite.id, 
    ingredientfavorite.cocktail 
FROM 
    ingredientfavorite 
WHERE 
    ingredientfavorite.user = ?;
";

$sql_favorite_ingredient = "SELECT 
    ingredientfavorite.id, 
    ingredientfavorite.ingredient, 
    ingredientfavorite.user 
FROM 
    ingredientfavorite 
WHERE 
    ingredientfavorite.user = ?
AND
    ingredientfavorite.ingredient = ?;
";

$sql_create_ingredientfavorite = "INSERT INTO
    ingredientfavorite (user, ingredient)
VALUES
    (?, ?);";

$sql_delete_ingredientfavorite = "DELETE FROM
    ingredientfavorite
WHERE
    user = ?
AND
    ingredient = ?
";

$sql_count_all_ingredientfavorite = "SELECT * FROM
    ingredientfavorite
WHERE
    ingredient = ?;
";

$sql_delete_all_ingredientfavorite = "DELETE FROM
    ingredientfavorite
WHERE
    ingredient = ?;
";
?>