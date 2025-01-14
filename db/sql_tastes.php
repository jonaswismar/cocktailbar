<?php
$sql_tastes = "SELECT 
    t.ID, 
    t.taste, 
    t.description, 
    t.image, 
    COUNT(ctl.cocktail) AS total_cocktails
FROM 
    tastes t
LEFT JOIN 
    cocktailtasteslist ctl ON ctl.taste = t.ID
GROUP BY 
    t.ID, t.taste, t.description, t.image
ORDER BY 
    t.taste ASC;
";
$sql_taste = "SELECT 
    t.ID, 
    t.taste, 
    t.description, 
    t.image
FROM 
    tastes t
WHERE
    t.ID = ?
";

$sql_update_taste = "UPDATE 
    tastes
SET
    taste = ?,
    description = ?,
    image = ?
WHERE
    ID = ?;
";

$sql_create_taste = "INSERT INTO
    tastes (taste, description, image)
VALUES
    (?, ?, ?);
";

$sql_delete_taste = "DELETE FROM
    tastes
WHERE
    ID = ?;
";
?>