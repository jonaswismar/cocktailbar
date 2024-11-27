<?php
require_once "sql_bar.php";
require_once "sql_categorys.php";
require_once "sql_cocktailcategorylist.php";
require_once "sql_cocktailfavorites.php";
require_once "sql_cocktailingredientlist.php";
require_once "sql_cocktailratings.php";
require_once "sql_cocktails.php";
require_once "sql_cocktailtastelist.php";
require_once "sql_ingredientfavorites.php";
require_once "sql_ingredientratings.php";
require_once "sql_ingredients.php";
require_once "sql_ingredienttastelist.php";
require_once "sql_ingredienttypes.php";
require_once "sql_orders.php";
require_once "sql_preferences.php";
require_once "sql_roles.php";
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