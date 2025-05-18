<?php

class StatsContr {
    private $user_id;
    private $image_id;
    private CommentContr $comment_contr;
    private LikeContr $like_contr;
    private ViewContr $view_contr;

    public function __construct($user_id, $image_id){
        $this->user_id = $user_id;
        $this->image_id = $image_id;
        $this->comment_contr = new CommentContr();
        $this->comment_contr->setParams($user_id, $image_id, "");
        $this->like_contr = new LikeContr();
        $this->like_contr->setParams($user_id, $image_id);
        if(isset($_SESSION["user_id"])){
            $this->view_contr = new ViewContr($image_id, $_SESSION["user_id"]);
        }
    }

    public function displayStats(){
        $image_control = new ImageContr();
        $image = $image_control->getImageByID($this->image_id);
        $this_image = new ImageContr();
        $this_image->setParams($image);
        $owner_id = $this_image->getUserID();
        $is_liked = $this->like_contr->checkIfUserLiked();
        $like_count = $this->like_contr->getLikes();
        $comment_count = 0;
        $comments = $this->comment_contr->fetchImageComments();
        $rating_contr = new RatingContr();
        $rating_contr->setImageID($this->image_id);
        $average_rating = $rating_contr->fetchAverageRating();
        if(isset($_SESSION["user_id"])){
            $view_count = $this->view_contr->getViews();
        }
        if(!(empty($comments))){
            foreach($comments as $comment){
                if(!(empty($comment))){
                    $comment_count++;
                }
            }
        }
        if($is_liked){
            $heart = "images/utility/full_heart.png";
        } else {
            $heart = "images/utility/empty_heart.png";
        }
        echo '<div class="stats">';
        echo '<span class="stats">'.$like_count.'</span>';
        echo '<img class="stats_img" id="likeBtn'.$this->like_contr->getImageID().'" src="'.$heart.'" onclick="likeImage('.$this->like_contr->getImageID().')">';
        echo '<span class="stats">'.$comment_count.'</span>';
        echo '<a href="#comment'.$this->comment_contr->getImageID().'"><img class="stats_img" src="images/utility/comment.png"></a>';
        if(isset($_SESSION["user_id"]) && ($_SESSION["user_id"] == $owner_id)){
            echo '<span class="stats">'.$view_count.'</span>';
            echo '<img class="stats_img" src="images/utility/view.png">';
            echo '<span class="stats">'.$average_rating.'</span>';
            echo '<img class="stats_img" src="images/utility/star.png">';
        }
        echo '</div>';
    }
}