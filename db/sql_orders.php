<?php
$sql_create_order = "INSERT INTO
    orders (user, cocktail)
VALUES
    (?, ?);";

$sql_ordered_cocktail = "SELECT 
    orders.id, 
    orders.cocktail, 
    orders.user 
FROM 
    orders 
WHERE 
    orders.user = ?
AND
    orders.cocktail = ?
AND
    orders.status = 0;
";
?>