<?php
$sql_bars = "SELECT
    b.ID,
    b.barname,
    b.icon,
    b.active
FROM
    bar b
WHERE
    b.active = '1';
";

$sql_currentbar_data = "SELECT
    b.ID,
    b.barname,
    b.icon,
    b.active
FROM
    bar b
WHERE
    b.active = '1'
AND
    b.ID = ?
LIMIT 1;
";

$sql_update_bar = "UPDATE 
    bar
SET
    barname = ?,
    icon = ?
WHERE
    ID = ?;
";

$sql_create_bar = "INSERT INTO
    bar (barname, icon)
VALUES
    (?, ?);
";

$sql_delete_bar = "DELETE FROM
    bar
WHERE
    ID = ?;
";

?>