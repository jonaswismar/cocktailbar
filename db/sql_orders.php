<?php
$sql_create_order = "INSERT INTO
    `order` (user, cocktail, bar)
VALUES
    (?, ?, ?);";

$sql_ordered_cocktaildata = "SELECT 
    `order`.id, 
    `order`.cocktail, 
    `order`.bar, 
    `order`.status, 
    `order`.user 
FROM 
    `order` 
WHERE 
    `order`.id = ?;
";

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
    cocktail = ?;
";

$sql_orders = "WITH bardata AS (
    SELECT 
        ID,
        barname
    FROM 
        bar
),
cocktaildata AS (
    SELECT 
        ID,
        cocktailname,
        glass,
        image
    FROM 
        cocktail
)
SELECT 
    bd.barname,
    cd.ID AS cocktailid,
    cd.cocktailname,
    cd.glass,
    cd.image,
    `order`.ID, 
    `order`.user, 
    `order`.cocktail, 
    `order`.bar, 
    `order`.status, 
    `order`.orderdate 
FROM 
    `order`
INNER JOIN 
    bardata bd ON `order`.bar = bd.ID
INNER JOIN
    cocktaildata cd ON `order`.cocktail = cd.ID
WHERE 
    `order`.user = ? 
AND 
    orderdate >= now() - INTERVAL 1 DAY
AND 
    `order`.status = ? 
ORDER BY 
`order`.orderdate DESC, `order`.ID DESC;
";

$sql_orders_hist = "WITH bardata AS (
    SELECT 
        ID,
        barname
    FROM 
        bar
),
cocktaildata AS (
    SELECT 
        ID,
        cocktailname,
        glass,
        image
    FROM 
        cocktail
)
SELECT 
    bd.barname,
    cd.ID AS cocktailid,
    cd.cocktailname,
    cd.glass,
    cd.image,
    `order`.ID, 
    `order`.user, 
    `order`.cocktail, 
    `order`.bar, 
    `order`.status, 
    `order`.orderdate 
FROM 
    `order`
INNER JOIN 
    bardata bd ON `order`.bar = bd.ID
INNER JOIN
    cocktaildata cd ON `order`.cocktail = cd.ID
WHERE 
    `order`.user = ?
AND 
    `order`.status >= ? 
ORDER BY 
`order`.orderdate DESC, `order`.ID DESC;
";
?>