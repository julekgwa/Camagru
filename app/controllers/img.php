<?php

class Img extends Controller
{
    public function index($id = '')
    {
        $id = (int)$id;
        $site_data = $this->get_image_info($id);
        if (!empty($site_data)) {
            if (($comments = $this->get_comments($id))) {
                $site_data['comments'] = $comments;
            }
        }

        if (filter_has_var(INPUT_POST, 'add-comment')) {
            if (Controller::logged_on()) {
                $this->add_comment();
            } else {
                $site_data['nouser'] = 'Please login to comment.';
            }
        }
        $this->view('templates/header');
        $this->view('img/index', $site_data);
        $this->view('templates/footer');
    }

    protected function get_image_info($id) {
        $image =  $this->model('Image');
        $image->setDb(Controller::$db);
        return $image->get_image_by_id($id);
    }

    protected function get_comments($id) {
        $comment = $this->model('Comment');
        $comment->setDb(Controller::$db);
        return $comment->get_comments_by_id($id);
    }

    protected function add_comment() {
        $image_id = filter_input(INPUT_POST, 'image-id');
        $user_id = filter_input(INPUT_POST, 'user-id');
        $comment = filter_input(INPUT_POST, 'comment');

        $new_comment = $this->model('Comment');
        $new_comment->setDb(Controller::$db);
        $new_comment->set_comment_info($comment, $user_id, $image_id);
        $new_comment->insert_comment();
    }
}