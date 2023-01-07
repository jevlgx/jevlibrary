<h1>
<?php
if(array_key_exists("nom", $_GET))
{
    echo("dedans");
}
else{
    echo "pas dedans";
}
$baliseMeta = "test.php?";
$baliseMeta .= 'nom=1&';
$baliseMeta .= 'contact=1&';
$baliseMeta .= 'lieu=1&';
echo("<a href='");
echo($baliseMeta);
echo("'>sqluer</a>");
?>
</h1>
