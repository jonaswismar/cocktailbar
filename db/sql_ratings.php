<?php
$sql_ratings_all = "SELECT 
    cocktail, 
    AVG(rating) AS rating
FROM 
    ratings 
WHERE 
    cocktail = ?
AND
    rating > 0
GROUP BY 
    cocktail;
";
$sql_rating_my = "SELECT 
    cocktail, 
    AVG(rating) AS rating
FROM 
    ratings 
WHERE 
    cocktail = ? AND
    user = ?
GROUP BY 
    cocktail,
    user;
";

$sql_create_rating = "INSERT INTO
    ratings (cocktail, user, rating, active)
VALUES
    (?, ?, ?, 1)
ON DUPLICATE KEY UPDATE
  cocktail = ?,
  user = ?,
  rating = ?,
  active = 1;
";

$sql_delete_rating = "DELETE FROM
    ratings
WHERE
    cocktail = ? AND
    user = ?;
";
?>