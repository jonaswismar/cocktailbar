<?php
$sql_ingredientrating_all = "SELECT 
    ingredient, 
    AVG(rating) AS rating
FROM 
    ingredientrating 
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
    ingredientrating 
WHERE 
    ingredient = ? AND
    user = ?
GROUP BY 
    ingredient,
    user;
";

$sql_create_ingredientrating = "INSERT INTO
    ingredientrating (ingredient, user, rating, active)
VALUES
    (?, ?, ?, 1)
ON DUPLICATE KEY UPDATE
  ingredient = ?,
  user = ?,
  rating = ?,
  active = 1;
";

$sql_delete_ingredientrating = "DELETE FROM
    ingredientrating
WHERE
    ingredient = ? AND
    user = ?;
";

$sql_count_all_ingredientrating = "SELECT rating FROM
    ingredientrating
WHERE
    ingredient = ?;
";

$sql_delete_all_ingredientrating = "DELETE FROM
    ingredientrating
WHERE
    ingredient = ?;
";
?>