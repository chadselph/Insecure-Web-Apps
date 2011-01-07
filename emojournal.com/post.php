<?php
    if($_COOKIE["user-id"] != md5("chadmin"))
    {
        Header("Location: /login.php");
        return;
    }
    pg_connect("dbname=ej");
    if(isset($_POST["title"]) && $_POST['challenge'] == "beat this, robot")
    {
        pg_query_params("INSERT INTO blogs (title,content) VALUES ($1,$2)",array($_POST['title'],$_POST['content']));
        echo "Posted.";
    }
    else
    {
?>
<form method=POST>
    <input type="hidden" value="beat this, robot" name='challenge'>
    Title: <input type="text" name="title"><p>
    Content: <textarea style="height: 90%;width: 90%;" name="content">Blag here</textarea>
<br><input type="submit" value='blagit'>
</form>

<?php
    }

?>
