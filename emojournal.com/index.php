<html><head>
<script type="text/javascript" src="jquery.js"></script>
<title>EJ - Journal Your Life</title>
<script type="text/javascript">
function submitThis(element)
{
    name = element.name.value;
    comment = element.comment.value;
    blog_id = element.blog_id.value;
  $.post("comment.php","name="+name+"&comment="+comment+"&blog_id="+blog_id,function(a,b)
{
    element.parentNode.innerHTML = a;
    return false;
});
        return false;
}

</script>
<style type="text/css">
body
{
    background: black;
    color: white;
    margin: 0 0 0 0;
    text-align: center;
}
.blog h2
{
    background: white;
    color: black;
    margin: 0;
}
.blog a
{
    color: white;
    margin: 0 0 0 0;
    text-align: right;
}
.blog
{
    border: 2px solid white;
    margin: 0 25% 20 25%;
    text-align: left;
}
#comments
{
    display: none;
    background: #555;
}
.comment
{
    margin: 0 10% 0 10%;
    background: #333;
    border-bottom: 1px solid #fff;
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
        echo " <a href='post.php'>Post New</a>";
    }
    else
    {
        $admin = false;
        echo "You are not <a href='login.php'>logged in</a>.";
    }
    echo "</div>";
    $q = pg_query("SELECT * FROM blogs ORDER BY ID DESC LIMIT 5");
    while($blag = pg_fetch_array($q))
    {
        echo "<p>";
        echo "<div class='blog'>";
        echo '<h2>'.$blag["title"].'</h2>';
        echo $blag["content"];

        echo "<div><a href='javascript:void($(\"#comments\").fadeIn())'>Display Comments</a></div>";
        echo '<div id="comments">';
        $r_comments = pg_query_params("SELECT * FROM comments WHERE blog_id = $1 ORDER BY ID",array($blag['id']));
        while($comment = pg_fetch_array($r_comments))
        {
            echo '<div class="comment">'.$comment["name"]."<br>".$comment["content"].'</div>';
        }
        echo "<br>";
        echo '<form method=post onSubmit="return submitThis(this);">';
        echo "Name: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' id='name'><br/>";
        echo "Comment: <textarea id='comment'></textarea><br>";
        echo "<input type='hidden' id='blog_id' value='".$blag['id']."' >";
        echo "<input type='submit' value='Comment'>";
        echo "</form>";
        echo "</div>";
        echo "</div>";
    }

?>
