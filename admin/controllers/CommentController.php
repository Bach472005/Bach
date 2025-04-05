<?php 

class CommentController
{
    public $commentModel;

    public function __construct(){
        $this->commentModel = new CommentModel();
    }

    public function get_comment() {
        $comments = $this->commentModel->get_comments();

        require_once './views/Comment/List.php';
    }
}