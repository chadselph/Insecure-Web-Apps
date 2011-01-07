<?php
    include 'User.php';
    session_start();

    if(!isset($_SESSION["user"]))
    {
        echo "not logged in";
        return;
    }
    $user = $_SESSION["user"];
    switch ($_REQUEST["action"])
    {
        case "status_update":
            $user->updateStatus($_REQUEST["status"]);
            echo "Updated";
            break;
        case "request_friend":
            $user->addFriend($_REQUEST["friend"]);
            break;
        case "comment":
            if($user->ismutual($_REQUEST['to']))
            {
                $content = htmlspecialchars($_REQUEST['comment']);
                pg_query_params('INSERT INTO comments ("to","from",content) VALUES ($2,$1,$3)',array($user->id,$_REQUEST['to'],$content));
                $to = new User($_REQUEST['to']);
                echo $to->comments();
            }
            else
            {
                echo "Not mutual friends.";
            }
            break;
        case "update_profile":
            $user->updateDescription($_REQUEST['description'],$_REQUEST['photo-url']);
            Header('Location: http://friendspace.com/'.$user->url);
            break;


    }

?>
