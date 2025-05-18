<form action="includes/comment.inc.php" method="post">
    <label for="comment_body">What do you think of this image?</label>
    <input class="custom_input" id="comment<?php echo $this->image->getID() ?>" type="text" name="comment_body" id="comment_body">
    <button class="button-55" type="submit" value="<?php echo $this->image->getID() ?>" name="submit">submit</button>
</form>