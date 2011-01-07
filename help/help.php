<?php
if(isset($_POST['button']))
{
    pg_connect("host=localhost dbname=main user=main_www_csg password=chicken12345");

    $team = (int) ($_SERVER['REMOTE_ADDR'][3]);
    pg_query_params("INSERT INTO claims (challenge_id,team_id,type) VALUES ($1,$2,'Hint Request')",array($_GET['id'],$team));
    echo "submitted";

}
else
{

?>
Are you sure?<br>
<form method=POST>
<input type="submit" name="button" value="Yes">
</form>
<?php
}
?>
