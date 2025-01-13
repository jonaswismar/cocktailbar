<?php
$sql_units = "SELECT 
    ID, 
    unitname, 
    unitshort, 
    unitshortX, 
    description, 
    icon 
FROM 
    unit 
ORDER BY 
    unitname ASC;
";

$sql_unit = "SELECT 
    ID, 
    unitname, 
    unitshort, 
    unitshortX, 
    description, 
    icon 
FROM 
    unit 
WHERE 
    ID = ?;
";

$sql_update_unit = "UPDATE 
    unit
SET
    unitname = ?,
    unitshort = ?,
    unitshortX = ?,
    description = ?,
    icon = ?
WHERE
    ID = ?;
";

$sql_create_unit = "INSERT INTO
    unit (unitname, unitshort, unitshortX, description, icon)
VALUES
    (?, ?, ?, ?, ?);
";

$sql_delete_unit = "DELETE FROM
    unit
WHERE
    ID = ?;
";
?>