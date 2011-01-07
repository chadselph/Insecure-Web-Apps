<?php

    include 'header.php';
?>
<style type="text/css">
#comments
{
    float: left;
    width: 33%;
    background: #ff9;
    text-align: center;
}
#statuses
{
    float: left;
    text-align: center;
    width: 33%;
    background: #9ff;
}
#friends
{
    float: left;
    text-align: center;
    width: 33%;
    background: #ff9;
}
</style>
<script type="text/javascript">
function comment(to)
{
    content = escape($("#comment-box")[0].value);
    $("#comments").load('actions.php?action=comment&to='+to+'&comment='+content);
}
function addFriend(id)
{
    $("#status").load('actions.php?action=request_friend&friend='+id);
}
</script>
<?php
    $user = new User($_GET["id"]);
    echo $user->info();
    if(!isset($_SESSION["user"]))
    {
        echo "Login or register to friend ".$user->name.".";
    } 
    else if($_SESSION["user"]->id == $user->id)
    {
        echo "(this is you)";
    }
    else if($_SESSION["user"]->ismutual($user->id))
    {
?>
        <textarea id="comment-box"></textarea>
        <input type="button" onclick="comment(<?php echo $user->id;  ?>)" value="add comment">
<?php
    } 
    else if(!($_SESSION["user"]->isfriend($user->id)))
    {
?>
    <div id="status"><input type="button" onclick="addFriend(<?php echo $user->id; ?>);" value="Add Friend"/></div>
<?php

    }
    else
    {
        echo "awaiting mutual friend approval";
    }
    echo "<br>";
    echo $user->comments();
    echo $user->statuses();
    echo $user->friends();
?>
</div>
