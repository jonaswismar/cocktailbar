<?php
$sql_ingredienttypes = "SELECT 
    t.ID, 
    t.typename, 
    t.description,
    t.image, 
    COUNT(i.ingredientname) AS total_ingredients
FROM 
    ingredienttype t
LEFT JOIN 
    ingredient i ON i.type = t.ID
GROUP BY 
    t.ID, 
    t.typename, 
    t.description,
    t.image
ORDER BY 
    t.typename ASC;
";

$sql_ingredienttype = "SELECT 
    ID, 
    typename, 
    description,
    image,
    ingredient_count
FROM 
    ingredienttype 
WHERE 
    ID = ?;
";

$sql_update_ingredienttype = "UPDATE 
    ingredienttype
SET
    typename = ?,
    description = ?,
    image = ?
WHERE
    ID = ?;
";

$sql_create_ingredienttype = "INSERT INTO
    ingredienttype (typename, description, image)
VALUES
    (?, ?, ?);
";

$sql_delete_ingredienttype = "DELETE FROM
    ingredienttype
WHERE
    ID = ?;
";

$sql_ingredienttype_count = "SELECT 
    COUNT(*) AS total 
FROM 
    ingredient 
WHERE 
    type = ?;
";
?>