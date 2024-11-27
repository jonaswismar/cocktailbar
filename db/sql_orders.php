<?php
$sql_create_order = "INSERT INTO
    `order` (user, cocktail, bar)
VALUES
    (?, ?, ?);";

$sql_ordered_cocktail = "SELECT 
    `order`.id, 
    `order`.cocktail, 
    `order`.bar, 
    `order`.user 
FROM 
    `order` 
WHERE 
    `order`.user = ?
AND
    `order`.cocktail = ?
AND
    `order`.status = 0;
";

$sql_delete_cocktailorder = "DELETE FROM
    `order`
WHERE
    cocktail = ?
";
?>