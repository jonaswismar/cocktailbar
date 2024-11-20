<?php
$sql_tastes = "SELECT 
    t.ID, 
    t.taste, 
    t.description, 
    t.image, 
    COUNT(ctl.cocktail) AS total_cocktails
FROM 
    taste t
LEFT JOIN 
    cocktailtaste ctl ON ctl.taste = t.ID
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