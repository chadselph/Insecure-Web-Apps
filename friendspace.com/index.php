<?php

    include 'header.php';
    if(!isset($_SESSION["user"]))
    { 
?>
<div id="main">
<p />
Why join?
<ul>
<li>Discover crappy bands!</li>
<li>Take bad photos of yourself!</li>
<li>Stalk people from class!</li>
<li>Let your friends know your every thought!</li>
<li>And much more!!</li>
</ul>
<a href="register.php">Join friendspace today!</a>
</div>
<?php

    }
    else
    {
?>
<script type="text/javascript">
        function sendstatus(form)
        {
            $.get('actions.php',"action=status_update&status="+$("#status")[0].value,function(data,textStatus){  $("#status-form")[0].innerHTML=data;  });
        }

</script>
<br>
    <div id="status-form" style="border: 1pt solid;"><h3>Tell us, how are you feeling?  Dig deep. We wanna know.</h3>
        <form action="actions.php">
            <textarea id="status" rows=3 cols=60></textarea>
            <input type="hidden" name="action" value="status_update" />
            <input type="button" value="update" onclick="sendstatus(this)">

        </form>
</div>
<br>
<?php
        $user = $_SESSION["user"];
        echo "<h3>Actions</h3>";
        echo "<a href='profile.php?id=".$user->id."'>View my profile</a>";
        echo "<br><a href='edit.php'>Edit my description</a>";
        echo "<h3>Friend's Updates</h3>";
        echo $user->friendsUpdates();
        $fr = $user->getFriendRequests();
        if($fr)
        {
            echo "<h3>Friend Requests</h3>";
            foreach($fr as $requester)
            {
                $r = new User($requester["user_id"]);
                echo $r->link();
            }
        }

    }
?>
