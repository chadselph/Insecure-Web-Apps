<style type="text/css">
body
{
    background: #a24;
}
h1
{
    color: #42a;
}
h2
{
    background: blue;
    text-decoration: underline;
    color: green;
}

</style>
<h1> BUYJUNK.COM!</h1>
<h2><blink>SAVE SAVE SAVE!!</blink></h2>
<marquee>$$$$$$$</marquee>
<center>IPODS DVDS HD-DVD BLUE-RAY CAMERA PHONE VIAGRA CHICKEN 
<table>
<tr><th colspan=3>INVENTORY</th></tr>
<?php
    pg_connect("dbname=buyjunk");
    $result = pg_query("SELECT * FROM forsale");
    while($row = pg_fetch_array($result))
    {
        echo '<tr><td>';
        echo $row["name"];
        echo '</td><td>';
        echo '$'.$row["price"];
        echo '</td></tr>';
    }

?>
</table>
</center>
