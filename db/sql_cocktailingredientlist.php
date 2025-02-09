<?php
$sql_get_cocktail_from_ingredient = "SELECT cocktail, ingredient FROM
    cocktailingredient
WHERE
    ingredient = ?;
";

$sql_count_all_cocktailingredientlist = "SELECT ID FROM
    cocktailingredient
WHERE
    cocktail = ?;
";

$sql_delete_all_cocktailingredientlist = "DELETE FROM
    cocktailingredient
WHERE
    cocktail = ?;
";

$sql_delete_cocktailingredientlist = "DELETE FROM
    cocktailingredient
WHERE
    cocktail = ? AND ingredient = ?;
";

$sql_delete_cocktailingredientlistid = "DELETE FROM
    cocktailingredient
WHERE
    ID = ?;
";

$sql_create_cocktailingredientlist = "INSERT INTO
    cocktailingredient (cocktail, ingredient, quantity, unit, optional, garnish) 
VALUES
    (?, ?, ?, ?, ?, ?);
";

$sql_update_cocktailingredientlist = "UPDATE
    cocktailingredient 
SET
    cocktail = ?, 
    ingredient = ?, 
    quantity = ?, 
    unit = ?, 
    optional = ?, 
    garnish = ? 
WHERE
    ID = ?";
?>