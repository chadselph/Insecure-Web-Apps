<?php
   // include 'header.php';
    if(isset($_POST["username"]))
    {
        if(($_POST["username"] == "chadmin") && $_POST["password"]=="goodpass")
        {
            setcookie("user-id",md5($_POST["username"]));
            Header('Location: /');
        }
        else
        {
            $error = "Incorrect username or password!";
        }
    }
    else
    {
?>

<?php

    }
?>
<html><head><title>EJ - Journal Your Life</title>
<style type="text/css">
body
{
    background: black;
    color: white;
    margin: 0 0 0 0;
}
.blog
{
    background: green;
}
#header
{
    background: #555;
    height: 50px;
    border-bottom: 1px solid #aaa;
}
</style>
</head>
<body>
<div id="header">
<h1 style="float: right">emojournal</h1>
<?php
    pg_connect("dbname=ej");
    if(isset($_COOKIE['user-id']) && $_COOKIE['user-id'] == md5("chadmin"))
    {
        $admin = true;
        echo "Hello, admin.";
    }
    else
    {
        $admin = false;
        echo "You are not <a href='login.php'>logged in</a>.";
    }

?>
</div>
<br>
<h1>Admin login</h1>
<?php echo "<strong>".$error."</strong>"; ?>
<form method=POST>
Username: <input type="text" name="username">
<br>
Password: <input type="password" name="password">
<br>
<input type="submit" value="login">
</form>
