<?php
$sql_tastes = "SELECT 
    t.ID, 
    t.taste, 
    t.description, 
    t.image, 
    t.ingredient_count, 
    t.cocktail_count 
FROM 
    taste t
GROUP BY 
    t.ID, t.taste, t.description, t.image
ORDER BY 
    t.taste ASC;
";
$sql_taste = "SELECT 
    t.ID, 
    t.taste, 
    t.description, 
    t.ingredient_count, 
    t.cocktail_count, 
    t.image
FROM 
    taste t
WHERE
    t.ID = ?
";

$sql_update_taste = "UPDATE 
    taste
SET
    taste = ?,
    description = ?,
    image = ?
WHERE
    ID = ?;
";

$sql_create_taste = "INSERT INTO
    taste (taste, description, image)
VALUES
    (?, ?, ?);
";

$sql_delete_taste = "DELETE FROM
    taste
WHERE
    ID = ?;
";
?>