<?php
    pg_connect("dbname=ej");
    if(isset($_POST["name"]))
    {
        $comment = strip_tags($_POST["comment"],"<b><br><p><i>");
        pg_query_params("INSERT INTO comments (name,content,ip,blog_id) VALUES ($1,$2,$3,$4)",array($_POST['name'],$comment,$_SERVER['REMOTE_ADDR'],$_POST["blog_id"]));
        echo "Posted.";
    }

?>
