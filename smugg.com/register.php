<?php
    include 'header.php';
    if(isset($_POST["username"]))
    {
        $result = pg_query_params("SELECT id FROM users WHERE username = $1",array($_POST["username"]));
        if(pg_num_rows($result) == 0)
        {
            if($_POST["password1"] == $_POST["password2"])
            {
                if($_POST["answer"] == $_SESSION["answer"])
                {
                    //good register
                    pg_query_params("INSERT INTO users (username,password) VALUES ($1,MD5($2))",array($_POST["username"],$_POST["password1"]));
                    echo 'Thanks for joining. <a href="login.php">Login</a>';
                    return;
                   // header("Location: index.php");
                }
                else
                {
                    $error = "Try another math problem ;-)";
                }

            }
            else
            {
                $error = "Passwords did not match!";
            }
        }
        else
        {
            $error = "This username has been taken!";
        }
    }
    $random1 = (rand() % 30);
    $random2 = (rand() % 10);
    $_SESSION["answer"] = $random1 + $random2;
    $math = "Solve: $random1 + $random2";
?>
<h2>Register New Account</h2>
<?php echo "<strong>$error</strong>";?><br />
<form method=POST>
Username: <input type="text" name="username"><br />
Password: <input type="password" name="password1"><br />
Password: <input type="password" name="password2"><br />
<?php  echo $math; ?> = <input type="text" name="answer"><br/>
<input type="submit" value="Register">
</form>

