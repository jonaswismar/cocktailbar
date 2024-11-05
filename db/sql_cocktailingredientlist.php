<?php
$sql_get_cocktail_from_ingredient = "SELECT cocktail, ingredient FROM
    cocktailingredientlist
WHERE
    ingredient = ?;
";

$sql_count_all_cocktailingredientlist = "SELECT ID FROM
    cocktailingredientlist
WHERE
    cocktail = ?;
";

$sql_delete_all_cocktailingredientlist = "DELETE FROM
    cocktailingredientlist
WHERE
    cocktail = ?;
";
?>