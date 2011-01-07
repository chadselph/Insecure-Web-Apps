<?php
include 'header.php';
if(isset($_SESSION["user"]))
{
    echo $_SESSION["user"]->friends(10000);
}
else
{
    echo "Please <a href='register.php'>register</a> or <a href='login.php'>login.";

}
?>
