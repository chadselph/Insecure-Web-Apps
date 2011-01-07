<?php
    session_start();
    pg_connect("dbname=smugg");
    function smigg($story)
    {
        pg_query_params("INSERT INTO smiggs (user_id,story_id) VALUES ($1,$2)", array($_SESSION["uid"],$story));
        $result = pg_query_params("SELECT count(1) FROM smiggs  WHERE story_id=$1",array($story));
        $row = pg_fetch_array($result);
        return $row[0];
    }

?>
