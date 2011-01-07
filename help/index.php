<html><head><title>CSG Challenges</title>
<style type="text/css">
body
{
    background: #000;
    color: #0f0;
}
h1
{

}
a
{
    color: #fff;
}
a:hover
{
    background: #fff;
    color: #0f0;
}
#scoreboard
{
    color: #000;
    font-size: 18pt;
    background: #fff;
    padding: 4px;
    width: 242px;
}
#t1
{
    background: #f00;
}
#t2
{
    background: #00f;
}
.challenge:hover
{
    background: #444;
}
.challenge
{
    background: #333;
}
.challenge a
{
    
}
</style>
</head>
<h1>WSU Computer Security Group</h1>
<h2>Event: www.fail.com</h2><br />

<a href="rules.html">Rules</a>
<a href="tutorials.html">Tutorials</a>
<div id="scoreboard">
Scores:
    <div id="t1">TEAM1: 0 PTS</div>
    <div id="t2">TEAM2: 0 PTS</div>
</div>
<?php
$dbconn = pg_connect("host=localhost dbname=main user=main_www_csg password=chicken12345");
$result = pg_query("SELECT * FROM Challenges ORDER BY Status,ID");
while($row = pg_fetch_array($result))
{
?>
<div class="challenge">
<h3><?php echo $row["name"];  ?></h3>
Status: <?php echo $row["status"];  ?><br>
URL: <?php echo '<a href="'.$row["url"].'">'.$row["url"].'</a>'  ?><br />
Challenge: <?php echo $row["challenge"];  ?>
<br />
<?php
$result2 = pg_query_params("SELECT * FROM hints WHERE challenge_id = $1",array($row["id"]));
$hints = pg_num_rows($result2);
$points = 30 - (30*$hints) + (time() - mktime(5,30,0))/60;
$points = (int) $points;
if($row["status"] == "Unclaimed" || 1)
{
echo "Points: $points<br />";
echo "<br/>Hints:";
if($hints > 0)
{
?>
<div class="hints">
<ul>
<?php
while($hint = pg_fetch_array($result2))
{
?>
  <li> <?php echo $hint["hint"];?> </li>
<?php
}
?>
</ul>
</div>
<?php
}
?>
<a href="help.php?id=<?php echo $row["id"]; ?>">Ask for hints</a>
<?php
}
echo '</div>';

}
?>
