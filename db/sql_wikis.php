<?php
$sql_wikis = "SELECT 
    w.ID, 
    w.wikiname, 
    w.content, 
    w.subsearch, 
    w.icon
FROM 
    wiki w
ORDER BY 
    w.wikiname ASC;
";

$sql_wiki = "SELECT 
    ID, 
    wikiname, 
    content, 
    subsearch, 
    icon 
FROM 
    wiki 
WHERE 
    ID = ?;
";

$sql_wiki_tools = "SELECT 
    t.ID, 
    t.toolname AS name, 
    t.description, 
    t.icon
FROM 
    tool t
ORDER BY 
    t.toolname ASC;
";
$sql_wiki_preperations = "SELECT 
    p.ID, 
    p.preperationname AS name, 
    p.description, 
    p.icon
FROM 
    preperation p
ORDER BY 
    p.preperationname ASC;
";

$sql_wiki_categorys = "SELECT 
    ca.ID, 
    ca.categoryname AS name, 
    ca.description, 
    ca.icon
FROM 
    category ca
ORDER BY 
    ca.categoryname ASC;
";


?>