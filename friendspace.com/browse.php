<?php

include 'header.php';
?>
<style type="text/css">
.person
{
    height: 150px;
    width: 150px;
    border: 1pt solid;
    display: table-cell;
    text-align: center;
}
</style>
<p>
<?php
$r_people = pg_query("SELECT * FROM users ORDER BY RANDOM() LIMIT 8");
$i = 0;
while($person = pg_fetch_array($r_people))
{
    $i++;
    $url = "profile.php?id=".$person["id"];
    echo "<div class='person'>".$person["name"].
        '<br><a href="'.$url.'"><img src="'.$person["photo-url"].'" height=100;></a>'.
        '<br>'.$person["age"].'/'.$person["gender"].
        "</div>";
    if($i == 4)
    {
        echo "<br>";
    }
}

?>
