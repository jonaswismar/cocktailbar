<?php
$sql_tools = "SELECT 
    t.ID, 
    t.toolname, 
    t.description, 
    t.icon, 
    t.cocktail_count AS total_cocktails
FROM 
    tool t
GROUP BY 
    t.ID, 
    t.toolname, 
    t.description, 
    t.icon
ORDER BY 
    t.toolname ASC;
";

$sql_tool = "SELECT 
    ID, 
    toolname, 
    description, 
    cocktail_count, 
    icon 
FROM 
    tool 
WHERE 
    ID = ?;
";

$sql_delete_tool = "DELETE FROM
    tool
WHERE
    ID = ?;
";

$sql_update_tool = "UPDATE 
    tool
SET
    toolname = ?,
    description = ?,
    icon = ?
WHERE
    ID = ?;
";

$sql_create_tool = "INSERT INTO
    tool (toolname, description, icon)
VALUES
    (?, ?, ?);
";
?>