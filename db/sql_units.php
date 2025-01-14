<?php
$sql_units = "SELECT 
    ID, 
    unitname, 
    unitshort, 
    unitshortX, 
    description, 
    image 
FROM 
    units 
ORDER BY 
    unitshort ASC;
";

$sql_unit = "SELECT 
    ID, 
    unitname, 
    unitshort, 
    unitshortX, 
    description, 
    image 
FROM 
    units 
WHERE 
    ID = ?;
";

$sql_update_unit = "UPDATE 
    units
SET
    unitname = ?,
    unitshort = ?,
    unitshortX = ?,
    description = ?,
    image = ?
WHERE
    ID = ?;
";

$sql_create_unit = "INSERT INTO
    units (unitname, unitshort, unitshortX, description, image)
VALUES
    (?, ?, ?, ?, ?);
";

$sql_delete_unit = "DELETE FROM
    units
WHERE
    ID = ?;
";
?>