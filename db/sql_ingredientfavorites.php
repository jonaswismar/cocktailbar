<?php
$sql_ingredientfavorites = "SELECT 
    ingredientfavorites.id, 
    ingredientfavorites.cocktail 
FROM 
    ingredientfavorites 
WHERE 
    ingredientfavorites.user = ?;
";

$sql_favorite_ingredient = "SELECT 
    ingredientfavorites.id, 
    ingredientfavorites.ingredient, 
    ingredientfavorites.user 
FROM 
    ingredientfavorites 
WHERE 
    ingredientfavorites.user = ?
AND
    ingredientfavorites.ingredient = ?;
";

$sql_create_ingredientfavorite = "INSERT INTO
    ingredientfavorites (user, ingredient)
VALUES
    (?, ?);";

$sql_delete_ingredientfavorite = "DELETE FROM
    ingredientfavorites
WHERE
    user = ?
AND
    ingredient = ?
";

$sql_count_all_ingredientfavorite = "SELECT * FROM
    ingredientfavorites
WHERE
    ingredient = ?;
";

$sql_delete_all_ingredientfavorite = "DELETE FROM
    ingredientfavorites
WHERE
    ingredient = ?;
";
?>