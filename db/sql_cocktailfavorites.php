<?php
$sql_cocktailfavorite = "SELECT 
    cocktailfavorite.id, 
    cocktailfavorite.cocktail 
FROM 
    cocktailfavorite 
WHERE 
    cocktailfavorite.user = ?;
";

$sql_favorite_cocktail = "SELECT 
    cocktailfavorite.id, 
    cocktailfavorite.cocktail, 
    cocktailfavorite.user 
FROM 
    cocktailfavorite 
WHERE 
    cocktailfavorite.user = ?
AND
    cocktailfavorite.cocktail = ?;
";

$sql_create_cocktailfavorite = "INSERT INTO
    cocktailfavorite (user, cocktail)
VALUES
    (?, ?);";

$sql_delete_cocktailfavorite = "DELETE FROM
    cocktailfavorite
WHERE
    user = ?
AND
    cocktail = ?
";

$sql_count_all_cocktailfavorite = "SELECT * FROM
    cocktailfavorite
WHERE
    cocktail = ?;
";

$sql_delete_all_cocktailfavorite = "DELETE FROM
    cocktailfavorite
WHERE
    cocktail = ?;
";
?>