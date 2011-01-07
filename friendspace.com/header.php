<?php
    include 'User.php';
    session_start();
?>
<html>
    <head><title>FriendSpace :-)</title>
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript">

    </script>
    <style type="text/css">
body
{
    margin: 0 40 40 40;
}
#header
{
    background: #009;
    font-family: arial;
    color: white;
    padding: 6px;
}
#header a
{
    color: white;
    text-decoration: none;
}
#linkbar
{
    float: left;
}
#linkbar a:hover
{
    background: #0000a0;
}
#linkbar,#userlinks
{
    background: #00a;
}
#header em
{
}
#userlinks
{
    float: right;
}
.friend
{
    display: table-cell;
    height: 150px;
    width: 150px;
}
.comment
{
    width: 100%;
    border-bottom: 1px solid;
    text-align: left;
}
.comment-content
{
    vertical-align: middle;
    left: 100px;
}
.comment img
{
    width: 50pt;
}


    </style>
    </head>
<body>
<noscript style="background: red;">
Uh oh! It looks like you have javascript turned off. Please turn it on or this site won't be very useful to you!
</noscript>
<div id="header">
<h1>friendspace</h1><em>A place for noobs</em><br>
<span id="linkbar">
<a href="/">Home</a> | 
<a href="/friends.php">Friends</a> | 
<a href="/music.php">Music</a> | 
<a href="/browse.php">Browse People</a> | 
<a href="video.php">Video</a>
</span>
<?php
    if(isset($_SESSION['user']))
    {
?>
<span id="userlinks">
Logged in as <?php echo $_SESSION["user"]->name; ?>
 | <a href="logout.php">Logout</a>
</span>
<?php

    }
    else
    {
?>
<span id="userlinks">
<a href="login.php">Login</a>
</span>
<?php

    }
?>
<br>
</div>

</body>
</html>
