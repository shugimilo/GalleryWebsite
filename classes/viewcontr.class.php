<?php

class ViewContr extends View {
    private $id;
    private $user_id;
    private $image_id;
    private $viewed_at;

    public function __construct($image_id, $user_id){
        parent::__construct();
        $this->user_id = $user_id;
        $this->image_id = $image_id;
        $time = time();
        $now = date("Y-m-d H:m:s", $time);
        $this->viewed_at = $now;
    }

    public function compareAndIncrement(){
        $last_viewed = $this->getLastViewByUser($this->user_id, $this->image_id);
        if(empty($last_viewed)){
            $this->addView($this->image_id, $this->user_id);
        } else {
            $last_timestamp = strtotime($last_viewed);
            $this_timestamp = strtotime($this->viewed_at);
            $difference_in_s = abs($this_timestamp - $last_timestamp);
            $difference_in_m = $difference_in_s / 60;
            if($difference_in_m >= 60){
                $this->addView($this->image_id, $this->user_id);
            }
        }
    }

    public function getViews(){
        $view_count = $this->getTotalImageViews($this->image_id);
        return $view_count;
    }
}