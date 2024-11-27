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
?>