<?php
$sql_cocktailratings_all = "SELECT 
    cocktail, 
    AVG(rating) AS rating
FROM 
    cocktailratings 
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
    cocktailratings 
WHERE 
    cocktail = ? AND
    user = ?
GROUP BY 
    cocktail,
    user;
";

$sql_create_cocktailrating = "INSERT INTO
    cocktailratings (cocktail, user, rating, active)
VALUES
    (?, ?, ?, 1)
ON DUPLICATE KEY UPDATE
  cocktail = ?,
  user = ?,
  rating = ?,
  active = 1;
";

$sql_delete_cocktailrating = "DELETE FROM
    cocktailratings
WHERE
    cocktail = ? AND
    user = ?;
";

$sql_count_all_cocktailrating = "SELECT rating FROM
    cocktailratings
WHERE
    cocktail = ?;
";

$sql_delete_all_cocktailrating = "DELETE FROM
    cocktailratings
WHERE
    cocktail = ?;
";
?>