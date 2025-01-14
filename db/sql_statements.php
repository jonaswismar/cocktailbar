<?php
require_once "sql_categorys.php";
require_once "sql_cocktailcategorylist.php";
require_once "sql_cocktailfavorites.php";
require_once "sql_cocktails.php";
require_once "sql_cocktailtastelist.php";
require_once "sql_ingredients.php";
require_once "sql_ingredienttypes.php";
require_once "sql_orders.php";
require_once "sql_ratings.php";
require_once "sql_specials.php";
require_once "sql_tastes.php";
require_once "sql_units.php";
require_once "sql_users.php";

$sql_glassware_single = "SELECT 
    glassware.id, 
    glassware.glasname, 
    glassware.image 
FROM 
    glassware 
WHERE 
    glassware.id = ?;
";
?>