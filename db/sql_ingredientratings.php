<?php
$sql_ingredientratings_all = "SELECT 
    ingredient, 
    AVG(rating) AS rating
FROM 
    ingredientratings 
WHERE 
    ingredient = ?
AND
    rating > 0
GROUP BY 
    ingredient;
";
$sql_ingredientrating_my = "SELECT 
    ingredient, 
    AVG(rating) AS rating
FROM 
    ingredientratings 
WHERE 
    ingredient = ? AND
    user = ?
GROUP BY 
    ingredient,
    user;
";

$sql_create_ingredientrating = "INSERT INTO
    ingredientratings (ingredient, user, rating, active)
VALUES
    (?, ?, ?, 1)
ON DUPLICATE KEY UPDATE
  ingredient = ?,
  user = ?,
  rating = ?,
  active = 1;
";

$sql_delete_ingredientrating = "DELETE FROM
    ingredientratings
WHERE
    ingredient = ? AND
    user = ?;
";

$sql_count_all_ingredientrating = "SELECT rating FROM
    ingredientratings
WHERE
    ingredient = ?;
";

$sql_delete_all_ingredientrating = "DELETE FROM
    ingredientratings
WHERE
    ingredient = ?;
";
?>