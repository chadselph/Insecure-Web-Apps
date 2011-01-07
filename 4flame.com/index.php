<?php
include '../db.php';
mysql_connect("localhost",$dbuser,$dbpass);
mysql_select_db($dbname);
session_start(); 

if(isset($_POST["login"]))
{
    $username = mysql_real_escape_string($_POST['login']);
    $pass = md5($_POST['pass']);
    $r = mysql_query("SELECT * FROM users WHERE email='$username' AND password='$pass'");
    if(mysql_num_rows($r) == 1)
    {
        $user = mysql_fetch_array($r);
        $_SESSION["id"] = $user["id"];
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
<?php
    if(!$loggedin)
    {
        echo "<form method=post>login:<input type=text name='login'>pass:<input name='pass' type=password><input type=submit value='login'>";
    }
?>
<h1>4flame</h1>
<div class="happy">We are now <a href="code.tar.gz">open source!</a></div>
<?php
   $result = mysql_query("SELECT * FROM threads");
   while($row = mysql_fetch_array($result))
   {
        echo "<div class='topic'><h2>".$row["topic"]."</h2>";
        $result_replies = mysql_query("SELECT replies.content,users.email FROM replies INNER JOIN users ON replies.user_id = users.id WHERE thread_id = ".$row["id"]);
        while($reply = mysql_fetch_array($result_replies))
        {
            echo "<div class='reply'><b>".$reply['email']."</b>:".$reply['content']."</div>";
        }
        if($loggedin)
        {
?>
        <form action="reply.php" method=POST>
            <textarea name="content"></textarea>
            <input type="hidden" name="post" value=<?php echo $row["id"]; ?>>
            <input type="submit" value="reply">

        </form>
<?php
        }
        else
        {
            echo "<a href='register.php'>Register to reply</a>";
        }
        echo "</div>";
   }

?>
</body>
</html>
