<?php
    pg_connect("dbname=friendspace");

    class User
    {
        public $id;
        public $name;
        public $description;
        public $gender;
        public $photourl;
        public $age;
        public $friends;
        public $statuses;
        public $comments;
        public $url;
        function User($id)
        {
            $id = (int) $id;
            $url = 'profile.php?id='.$id;
            $r = pg_query_params("SELECT * FROM users WHERE id =$1",array($id));
            if(pg_num_rows($r) != 1)
            {
                exit();
            }
            $row = pg_fetch_array($r);
            $this->id = $id;
            $this->name = $row["name"];
            $this->description = $row["description"];
            $this->gender = $row["gender"];
            $this->photourl = $row["photo-url"];
            $this->age = $row["age"];
            $this->friends = array();
            $r_friends = pg_query_params("SELECT users.* FROM friends INNER JOIN users ON users.id = friends.friend_id WHERE user_id = $1",array($id));
            while($row = pg_fetch_array($r_friends))
            {
                array_push($this->friends,$row);
            }
            $r_statuses = pg_query_params("SELECT * FROM status WHERE user_id=$1 ORDER BY \"when\" DESC",array($id));;
            $this->statuses = pg_fetch_all($r_statuses);


            $r_comments = pg_query_params("SELECT users.*,content,stamp FROM comments INNER JOIN users on users.id=comments.from WHERE \"to\"= $1 ORDER BY stamp DESC",array($this->id));
            $this->comments = pg_fetch_all($r_comments);
            //always have at least one friend
            if(count($this->friends) == 0)
            {
                $this->addFriend(1);
                $chad = new User(1);
                $chad->addFriend($id);
            }

            
        }
        function info()
        {
            return '<div id="profile"><h2>Profile of '.$this->name.'</h2><i>'.
                $this->statuses[0]["content"].'</i>@'.$this->statuses[0]["when"].
                '<br><img src="'.$this->photourl.'" height=80><br>'.
                'Age/gender: '.$this->age.'/'.$this->gender.'<br>'.
                '<b>About me:</b> '.$this->description.'<br>'.
                '<br>';
                '</div>';
        }
        function friends($count=8)
        {
            $str = "<div id='friends'><h2>Friends:</h2>";
            if(!$this->friends)
            {
                return $str."This user has no friends.</div>";
            }
            $i=0;
            foreach($this->friends as $friend)
            {
                $url = 'profile.php?id='.$friend['id'];
                $i++;
                $str.='<div class="friend"><a href="'.$url.'"><img height=100 src="'.$friend["photo-url"].'"></a><br>'.$friend["name"]."</div>";
                if($i%4==0) $str.="<br>";
            }
            return $str."</div>";
        }
        function comments($count=10)
        {
            $str = "<div id='comments'><h2>Comments:</h2>";
            $i = 0;
            if(!$this->comments)
            {
                return $str."This user has no comments.</div>";
            }
            foreach($this->comments as $comment)
            {
                $url = 'profile.php?id='.$comment['id'];
                $str.= '<table class="comment"><tr><td><a href="'.$url.'"><img src="'.$comment["photo-url"].'"></a><br>'.$comment['name'].'</td><td><div class="comment-content">'.$comment["content"].'</div></td></tr></table>';
                $i++;
                if($i >= $count) break;
            }
            return $str."</div>";
        }
        function statuses($count=10)
        {
            $str = "<div id='statuses'><h2>Status History:</h2>";
            if(!$this->statuses)
            {
                return $str."No status history.</div>";
            }
            foreach($this->statuses as $comment)
            {
                $str.='<div class="status">'.$comment["content"].' @ '.$comment['when'].'</div>';
            }
            return $str.'</div>';
        }
        function updateStatus($status)
        {
            $status = htmlspecialchars($status);
            pg_query_params("INSERT INTO status (user_id,content) VALUES ($1,$2)",array($this->id,$status));
            $r_statuses = pg_query_params("SELECT * FROM status WHERE user_id=$1 ORDER BY \"when\" DESC",array($id));;
            $this->statuses = pg_fetch_all($r_statuses);
        }
        function addFriend($friend)
        {
            if($this->isfriend($friend))
            {
                echo "already friends or requested to be friend";
            }
            else
            {
                pg_query_params("INSERT INTO friends (user_id,friend_id) VALUES ($1,$2)",array($this->id,$friend));
            }
            $r_friends = pg_query_params("SELECT users.* FROM friends INNER JOIN users ON users.id = friends.friend_id WHERE user_id = $1",array($this->id));
            $this->friends = pg_fetch_all($r_friends);
            

        }
        function isfriend($id)
        {
            if(!$this->friends) return false;
            foreach($this->friends as $friend)
            {
                if((int)$id == (int)$friend["id"]) return true;
            }
            return false;
        }
        function ismutual($id)
        {
            $buddy = new User($id);
            return $buddy->isfriend($this->id) && $this->isfriend($id);
        }
        function friendsUpdates()
        {
            $str = "";
            $r_updates = pg_query_params("SELECT * FROM updates WHERE subscriber = $1 LIMIT 10",array($this->id));
            $updates = pg_fetch_all($r_updates);
            foreach($updates as $update)
            {
                $url = 'profile.php?id='.$update['id'];
                $str.= "<div class='update'><a href='$url'>".$update["name"].'</a>: '.$update["content"]."@ ".$update["when"]."</div>";
            }
            return $str;
        }
        function getFriendRequests()
        {
            $r_fr = pg_query_params("SELECT * FROM friends WHERE friend_id = $1 AND user_id NOT IN (SELECT friend_id FROM friends WHERE user_id=$1)",array($this->id));
            return pg_fetch_all($r_fr);
        }
        function link()
        {
            return "<div id='friend'><a href='profile.php?id=".$this->id."'><img src='".$this->photourl."' height=100></a>".$this->name."</div>";
        }
        function updateDescription($desc,$photourl)
        {
            $desc = htmlspecialchars($desc);
            $photourl = str_replace(" ","%20",$photourl);
            $photourl = str_replace("\"","%22",$photourl);
            pg_query_params("UPDATE users SET description=$1,\"photo-url\"=$3 WHERE ID=$2",array($desc,$this->id,$photourl));
            $this->description = $desc;
            $this->photourl = $photourl;
        }

    }
    if($_SERVER["REQUEST_URI"] == "/User.php")
    {
        $me = new User(2);
        echo $me->info();
        echo $me->friends();
        echo $me->comments();
    }
