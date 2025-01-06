<?php
$sql_cocktailratings_all = "SELECT 
    cocktail, 
    AVG(rating) AS rating
FROM 
    cocktailrating 
WHERE 
    cocktail = ?
AND
    rating > 0
GROUP BY 
    cocktail;
";
$sql_cocktailrating_my = "SELECT 
    cocktail, 
    AVG(rating) AS rating
FROM 
    cocktailrating 
WHERE 
    cocktail = ? AND
    user = ?
GROUP BY 
    cocktail,
    user;
";

$sql_create_cocktailrating = "INSERT INTO
    cocktailrating (cocktail, user, rating)
VALUES
    (?, ?, ?)
ON DUPLICATE KEY UPDATE
  cocktail = ?,
  user = ?,
  rating = ?;
";

$sql_delete_cocktailrating = "DELETE FROM
    cocktailrating
WHERE
    cocktail = ? AND
    user = ?;
";

$sql_count_all_cocktailrating = "SELECT rating FROM
    cocktailrating
WHERE
    cocktail = ?;
";

$sql_delete_all_cocktailrating = "DELETE FROM
    cocktailrating
WHERE
    cocktail = ?;
";
?>