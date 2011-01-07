<?php
include '../db.php';
mysql_connect("localhost",$dbuser,$dbpass);
mysql_select_db($dbname);
session_start(); 

if(isset($_SESSION["id"]))
{
    $id = $_POST['post'];
    $content = mysql_real_escape_string($_POST['content']);
    $content = htmlspecialchars($content);
    $user = $_SESSION["id"];
    mysql_query("INSERT INTO replies (thread_id,content,user_id) VALUES ".
        "($id,'$content',$user)");
    echo mysql_error();
    echo "comment posted. <a href=/>go back</a>";

}
else
{
    echo "log in first";
    return;
}

?>
