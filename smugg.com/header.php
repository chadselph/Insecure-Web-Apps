<?php
    include_once 'functions.php';
?>
<html>
<head><title>Smugg - Social News for the Unsocial</title>
<script type="text/javascript" src="jquery.js"></script>
<style type="text/css">
body
{
    background: #fff;
}
h1 a
{
    color: white;
    text-decoration: none;
}
#header
{
    width: 100%;
    color: white;
    background: #33f;
}
#header a
{
    color: white;
}
#header h1
{
    font-style: bold;
}
.smiggs
{
    background: #ff0;
    font-style: bold;
    padding: 10px;
}
</style>
</head>
<body>
<div id="header">
<h1><a href="/">smugg</a></h1>
<?php
if(isset($_SESSION["username"]))
{
    echo 'Logged in as '.$_SESSION["username"];
    echo ' <a href="submit.php">Submit story</a>';
    echo ' <a href="logout.php">Logout</a>';
}
else
{
 echo '<a href="login.php">Login</a> or <a href="register.php">register</a>';   
}
?>
</div>
