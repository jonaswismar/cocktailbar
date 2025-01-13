<?php
$sql_barkeeper_bar = "WITH userdata AS (
    SELECT 
        ID as User_ID,
        username,
        icon,
        role
    FROM 
        user
    GROUP BY 
        ID
)
SELECT
    bk.id, bk.bar, bk.user, ud.username, ud.icon, ud.role
FROM
    barkeeper bk
INNER JOIN
    userdata ud ON ud.User_ID = bk.user
WHERE
    bk.bar = ?;
";

$sql_barkeeper_create = "INSERT INTO
    barkeeper (bar, user)
VALUES
    (?, ?);
";

$sql_barkeeper_update = "UPDATE
    barkeeper
SET bar = ?,
    user = ?
WHERE
    ID =?;
";

$sql_barkeeper_delete = "DELETE FROM
    barkeeper
WHERE
    ID =?;
";
?>