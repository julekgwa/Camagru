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
            $site_data['love'] = $this->likes($id);
            $site_data['hate'] = $this->dislikes($id);
        }

        if (filter_has_var(INPUT_POST, 'add-comment')) {
            if (Controller::logged_on()) {
                $user = $this->model('User');
                $user->setDB(Controller::$db);
                $id = $user->get_user_id(filter_var($_SESSION['logged_on_user']));
                $this->add_comment($id);
            } else {
                $site_data['nouser'] = 'Please login to comment.';
            }
        }

        if (filter_has_var(INPUT_POST, 'vote')) {
            if (Controller::logged_on()) {
                $user = $this->model('User');
                $user->setDB(Controller::$db);
                $id = $user->get_user_id(filter_var($_SESSION['logged_on_user']));
                $image_id = filter_input(INPUT_POST, 'like-img');
                $this->love_hate($image_id, $id);
            } else {
                $site_data['nouser'] = 'Please login to comment.';
            }
        }
        $this->view('templates/header');
        $this->view('img/index', $site_data);
        $this->view('templates/footer');
    }

    protected function get_image_info($id)
    {
        $image = $this->model('Image');
        $image->setDb(Controller::$db);
        return $image->get_image_by_id($id);
    }

    protected function likes($image_id)
    {
        $likes = $this->model('ImageLike');
        return $likes->get_likes(Controller::$db, $image_id);
    }

    protected function dislikes($image_id)
    {
        $likes = $this->model('ImageLike');
        return $likes->get_dislikes(Controller::$db, $image_id);
    }

    protected function get_comments($id)
    {
        $comment = $this->model('Comment');
        $comment->setDb(Controller::$db);
        return $comment->get_comments_by_id($id);
    }

    public function get_comment($id) {
        $comment = $this->model('Comment');
        $comment->setDb(Controller::$db);
        return $comment->get_comment_by_id($id);
    }

    protected function add_comment($user_id, $ajax = '')
    {
        $image_id = filter_input(INPUT_POST, 'image-id');
        $comment = filter_input(INPUT_POST, 'comment');

        $new_comment = $this->model('Comment');
        $new_comment->setDb(Controller::$db);
        $new_comment->set_comment_info($comment, $user_id, $image_id);
        $new_comment->insert_comment();
        if ($ajax) {
            return $new_comment->get_last_id();
        }
    }

    protected function love_hate($image_id, $user_id)
    {
        $like = $this->model('ImageLike');
        $like->setDb(Controller::$db);
        if (filter_input(INPUT_POST, 'vote') == 'love') {
            $like->set_like($image_id, $user_id, true);
            $like->like_hate('image_like_hate', 'image_like_love');
        } elseif (filter_input(INPUT_POST, 'vote') == 'hate') {
            $like->set_like($image_id, $user_id, 0);
            $like->like_hate('image_like_love', 'image_like_hate');
        }
    }

    public function like_ajax()
    {
        if (filter_has_var(INPUT_POST, 'vote')) {
            if (Controller::logged_on()) {
                $user = $this->model('User');
                $user->setDB(Controller::$db);
                $id = $user->get_user_id(filter_var($_SESSION['logged_on_user']));
                $image_id = filter_input(INPUT_POST, 'like-img');
                $this->love_hate($image_id, $id);
                $site_data['results'] = 'success.';
                $site_data['likes'] = $this->likes($image_id);
                $site_data['dislikes'] = $this->dislikes($image_id);
                echo json_encode($site_data);
            } else {
                $site_data['nouser'] = 'Please login to like or dislike.';
                echo json_encode($site_data);
            }
        }
    }

    public function add_comment_ajax() {
        if (filter_has_var(INPUT_POST, 'add-comment')) {
            if (Controller::logged_on()) {
                $user = $this->model('User');
                $user->setDB(Controller::$db);
                $id = $user->get_user_id(filter_var($_SESSION['logged_on_user']));
                $comment_id = $this->add_comment($id, 1);
                $comment = $this->get_comment($comment_id);
                $site_data['comment'] = $this->create_comment($comment);
                echo json_encode($site_data);
            } else {
                $site_data['nouser'] = 'Please login to comment.';
            }
        }
    }

    public function create_comment($comment) {
        if ($comment) {
            $create = " <p class=\"comment\">". $comment['comment'] . "</p>
                <p class=\"author\">-" . $comment['user_name'] . "</p>
            ";
            return $create;
        }
    }
}