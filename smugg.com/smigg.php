<?php
    include 'functions.php';
    if(isset($_SESSION["username"]))
    {
        //do stuff
        error_reporting(0);
        echo smigg($_POST["story"]);
    }
    else
    {
        echo "";
    }
?>
