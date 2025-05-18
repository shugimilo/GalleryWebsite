<?php

class AdminTableContr {
    public function openCommentTable(){
        echo '<table>';
        echo '<tr><th>id</th><th>posted by</th><th>image id</th><th>comment body</th><th>posted at</th></tr>';
    }

    public function openUserTable(){
        echo '<table>';
        echo '<tr><th>id</th><th>username</th><th>email</th><th>first name</th><th>last name</th><th>date of birth</th><th>user type</th><th>created at</th><th>updated at</th></tr>';
    }

    public function promoteUserButton($user_id){
        echo '<form action="includes/admin/promoteuser.inc.php" method="post">';
        echo '<button class="button-55" style="font-size: 0.6em;" type="submit" value="'.$user_id.'" name="promote">promote to artist</button>';
        echo '</form>';
    }

    public function deleteUserButton($user_id){
        echo '<form action="includes/admin/deleteuser.inc.php" method="post">';
        echo '<button class="button-56" style="font-size: 0.6em;" type="submit" value="'.$user_id.'" name="delete">delete user</button>';
        echo '</form>';
    }

    public function generateUsersTable($users){
        foreach($users as $user){
            echo '<tr>';
            echo '<td>'.$user["id"].'</td>';
            echo '<td>'.$user["username"].'</td>';
            echo '<td>'.$user["email"].'</td>';
            echo '<td>'.$user["first_name"].'</td>';
            echo '<td>'.$user["last_name"].'</td>';
            echo '<td>'.$user["date_of_birth"].'</td>';
            echo '<td>'.$user["user_type"].'</td>';
            echo '<td>'.$user["created_at"].'</td>';
            echo '<td>'.$user["updated_at"].'</td>';
            echo '<td>';
            if($user["user_type"] == UserType::USER){
                $this->promoteUserButton($user["id"]);
            }
            $this->deleteUserButton($user["id"]);
            echo '</td>';
            echo '</tr>';
        }
    }

    public function closeTable(){
        echo '</table>';
    }

    public function openImageTable(){
        echo '<table>';
        echo '<tr><th>id</th><th>file name</th><th>title</th><th>description</th><th>uploaded at</th><th>edited at</th><th>owner</th><th>likes</th></th><th>views</th></th><th>comments</th></tr>';
    }

    public function deleteImageButton($image_id){
        echo '<form action="includes/admin/deleteimage.inc.php" method="post">';
        echo '<button class="button-56" style="font-size: 0.6em;" type="submit" value="'.$image_id.'" name="delete">delete image</button>';
        echo '</form>';
    }

    public function generateImageTable($images){
        foreach($images as $image){
            echo '<tr>';
            echo '<td>'.$image["id"].'</td>';
            echo '<td>'.$image["file_name"].'</td>';
            echo '<td>'.$image["title"].'</td>';
            echo '<td>'.$image["file_description"].'</td>';
            echo '<td>'.$image["uploaded_at"].'</td>';
            echo '<td>'.$image["edited_at"].'</td>';
            
            $util = new Utility();
            $owner = $util->getUserName($image["user_id"]);
            echo '<td>'.$owner.'</td>';
            
            $like_contr = new LikeContr();
            $like_contr->setImageID($image["id"]);
            $likes = $like_contr->getLikes();
            echo '<td>'.$likes.'</td>';

            $comment_contr = new CommentContr();
            $comment_contr->setImageID($image["id"]);
            $comments = $comment_contr->getImageComments();
            echo '<td>'.$comments.'</td>';

            $view_contr = new ViewContr($_SESSION["user_id"], $image["id"]);
            $views = $view_contr->getViews();
            echo '<td>'.$views.'</td>';
            echo '<td>';
            $this->deleteImageButton($image["id"]);
            echo '</td>';
            echo '</tr>';
        }
    }

    public function generateCommentTable($comments){
        foreach($comments as $comment){
            $util = new Utility();
            $owner = $util->getUserName($comment["posted_by"]);
            echo '<tr>';
            echo '<td>'.$comment["id"].'</td>';
            echo '<td>'.$owner.'</td>';
            echo '<td>'.$comment["image_id"].'</td>';
            echo '<td>'.$comment["comment_body"].'</td>';
            echo '<td>'.$comment["posted_at"].'</td>';
            echo '<td>';
            $this->deleteCommentButton($comment["image_id"], $comment["posted_by"]);
            echo '</td>';
            echo '</tr>';
        }
    }

    public function deleteCommentButton($image_id, $user_id){
        echo '<form action="includes/admin/deletecomment.inc.php" method="post">';
        echo '<button class="button-56" style="font-size: 0.6em;" type="submit" value="'.$image_id.'-'.$user_id.'" name="delete">delete comment</button>';
        echo '</form>';        
    }
}