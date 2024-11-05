<?php
$sql_cocktailfavorites = "SELECT 
    cocktailfavorites.id, 
    cocktailfavorites.cocktail 
FROM 
    cocktailfavorites 
WHERE 
    cocktailfavorites.user = ?;
";

$sql_favorite_cocktail = "SELECT 
    cocktailfavorites.id, 
    cocktailfavorites.cocktail, 
    cocktailfavorites.user 
FROM 
    cocktailfavorites 
WHERE 
    cocktailfavorites.user = ?
AND
    cocktailfavorites.cocktail = ?;
";

$sql_create_cocktailfavorite = "INSERT INTO
    cocktailfavorites (user, cocktail)
VALUES
    (?, ?);";

$sql_delete_cocktailfavorite = "DELETE FROM
    cocktailfavorites
WHERE
    user = ?
AND
    cocktail = ?
";

$sql_count_all_cocktailfavorite = "SELECT * FROM
    cocktailfavorites
WHERE
    cocktail = ?;
";

$sql_delete_all_cocktailfavorite = "DELETE FROM
    cocktailfavorites
WHERE
    cocktail = ?;
";
?>