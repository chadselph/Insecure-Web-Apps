<?php
include 'header.php';

if(isset($_POST["title"]))
{
    if(isset($_SESSION["username"]))
    {
    pg_query_params("INSERT INTO stories(title,description) VALUES ($1,$2)",array($_POST['title'],$_POST['description']));
    echo 'Thanks for submitting the story. For now, it will be on the <a href="upcoming.php">upcoming page.</a>';
    pg_query_params("INSERT INTO smiggs (story_id,user_id) VALUES (currval('stories_id_seq'::regclass),$1)",array($_SESSION["uid"]));
    }
    else
    {
        echo "Please <a href='login.php'>login</a> first.";
    }
}
else
{

?>

<form method="POST">
    Title:<input type="text" name="title"><br />
    Description:<textarea name="description"></textarea><br />
    <input type="submit" value="Submit Story">
</form>
<?php

}
?>
