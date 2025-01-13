<?php
$sql_tastes = "SELECT 
    t.ID, 
    t.taste, 
    t.description, 
    t.icon, 
    t.ingredient_count, 
    t.cocktail_count 
FROM 
    taste t
GROUP BY 
    t.ID, t.taste, t.description, t.icon
ORDER BY 
    t.taste ASC;
";
$sql_taste = "SELECT 
    t.ID, 
    t.taste, 
    t.description, 
    t.ingredient_count, 
    t.cocktail_count, 
    t.icon
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
    icon = ?
WHERE
    ID = ?;
";

$sql_create_taste = "INSERT INTO
    taste (taste, description, icon)
VALUES
    (?, ?, ?);
";

$sql_delete_taste = "DELETE FROM
    taste
WHERE
    ID = ?;
";
?>