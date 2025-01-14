<?php
$sql_ingredienttypes = "SELECT 
    ID, 
    typename, 
    color,
    description,
    image
FROM 
    ingredienttypes 
ORDER BY 
    typename ASC;
";

$sql_ingredienttype = "SELECT 
    ID, 
    typename, 
    color,
    description,
    image
FROM 
    ingredienttypes 
WHERE 
    ID = ?;
";

$sql_update_ingredienttype = "UPDATE 
    ingredienttypes
SET
    typename = ?,
    color = ?,
    description = ?,
    image = ?
WHERE
    ID = ?;
";

$sql_create_ingredienttype = "INSERT INTO
    ingredienttypes (typename, color, description, image)
VALUES
    (?, ?, ?, ?);
";

$sql_delete_ingredienttype = "DELETE FROM
    ingredienttypes
WHERE
    ID = ?;
";

$sql_ingredienttype_count = "SELECT 
    COUNT(*) AS total 
FROM 
    ingredients 
WHERE 
    type = ?;
";
?>