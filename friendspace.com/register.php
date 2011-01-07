<?php
    include 'header.php';
    if(isset($_POST["user"]))
    {
        $result = pg_query_params("SELECT id FROM users WHERE user = $1",array($_POST["user"]));
        if(pg_num_rows($result) == 0)
        {
            if($_POST["password1"] == $_POST["password2"])
            {
                if(substr($_POST["photo-url"],0,4) == "http")
                {
                    //good register sanitize data
                    $age = (int) $_POST["age"];
                    $description = strip_tags($_POST["description"]);
                    $gender = htmlspecialchars($_POST["gender"]);
                    $photo = str_replace(" ","%20",$_POST["photo-url"]);
                    pg_query_params("INSERT INTO users (name,password,age,description,gender,\"photo-url\") VALUES ($1,MD5($2),$3,$4,$5,$6)",array($_POST["user"],$_POST["password1"],$age,$description,$gender,$photo));

                    echo 'Thanks for joining. <a href="login.php">Login</a>';
                    return;
                   // header("Location: index.php");
                }
                else
                {
                    $error = "Invalid url!";
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
?>
<h2>Register New Account</h2>
<?php echo "<strong>$error</strong>";?><br />
<form method=POST>
Username: <input type="text" name="user"><br />
Password: <input type="password" name="password1"><br />
Password: <input type="password" name="password2"><br />
Describe Yourself:<textarea name="description"></textarea><br />
Gender: <select name="gender"><option>Male</option><option>Female</option></select><br/>
Age: <input type="text" name="age" size=5><br />
Photo (URL): <input type="text" name="photo-url" value="http://"><br />
You can upload your photo on our partner site, <a href="http://picshack.com">picshack.com</a><br/>
<input type="submit" value="Register">
</form>

