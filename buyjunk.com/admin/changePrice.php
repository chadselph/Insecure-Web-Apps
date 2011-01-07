<?php
    session_start();
    if($_SESSION["id"])
    {
        if(isset($_POST["item"]))
        {
            pg_connect("dbname=buyjunk");    
            pg_query_params("UPDATE forsale SET price=$1 WHERE id=$2",array($_POST["price"],$_POST["item"]));
        }
    }
    else if(isset($_POST["password"]))
    {
        if($_POST["password"] == "qwertyqwerty")
        {
            $_SESSION["id"] = "set";
            
        }
        else
        {
            echo "wrong password";
        }
    }
    else
    {
        echo "not logged in. permission denied.";
        echo "<form method=POST>password: <input type='password' name='password'><input type='submit' value='login'></form>";
    }
?>
