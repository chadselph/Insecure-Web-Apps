<?php
include '../db.php';
mysql_connect("localhost",$dbuser,$dbpass);
mysql_select_db($dbname);
session_start(); 

if(isset($_POST["username"]))
{
    if(eregi('^.*@.*\..*',$_POST["username"]))
    {
        $username = $_POST['username'];
        $pass = md5($_POST['password']);
        $query = "INSERT INTO users(email,password) VALUES('$username','$pass')";
        $r = mysql_query($query);
        $e = mysql_error();
        if($e)
        {
            echo $e;
            echo "<p>".$query;
        }
        else
        {
            $_SESSION["id"] = mysql_insert_id();
            header('Location: /');
            return;
        }
    }
    else
    {
        $error = "<div style='background:yellow;'>Invalid email</div>";
    }
}


if(isset($_SESSION['id']))
{
    $loggedin = true;
}
else
{
    $loggedin = false;
}
?>
<html>
<head><title>4flame</title>
<script>

</script>
<style type="text/css">
body
{
    background: tan;
}
.happy
{
    background: yellow;
    color: green;
}
a
{
    color: red;
}
h1
{
    color: brown;
    text-align: center;
}
</style>
</head>
<body>
<h1>Registration is free, but only because I'm generous.</h1>
<?php echo $error; ?>
        <form method=POST>
            Email address:<input type="text" name="username"><br />
            Password: <input type="password" name="password"><br />
            <input type="submit" value="register">
        </form>
</body>
</html>
