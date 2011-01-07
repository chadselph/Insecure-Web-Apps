<?php
    include 'header.php';
    if(isset($_POST["username"]))
    {
        $result = pg_query_params("SELECT id,name FROM users WHERE name = $1 AND MD5($2) = password",array($_POST["username"],$_POST["password"]));
        if(pg_num_rows($result) == 1)
        {
            $user = pg_fetch_array($result);
            $loggedin = new User($user["id"]);
            $_SESSION["user"] = &$loggedin;
            /*  the redirect makes this too hard with urllib2 */
           //  header("Location: index.php");
            echo '<script type="text/javascript">window.location="/";</script>';
            return;
        }
        else
        {
            $error = "Bad username or password.";
        }
    }
?>
<br>
<?php echo "<strong>".$error."</strong>"; ?>
<form method=POST>
Username: <input type="text" name="username">
<br>
Password: <input type="password" name="password">
<br>
<input type="submit">
</form>

