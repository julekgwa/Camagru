<?php

class Edit extends Controller
{

    public function index()
    {
        if (!Controller::logged_on()) {
            Controller::redirect(SITE_URL . '/login');
        }
        $user_name = $_SESSION['logged_on_user'];
        $user = $this->model('User');
        $user->setDB(Controller::$db);
        $details = $user->get_user($user_name);
        if (filter_has_var(INPUT_POST, 'upload')) {
            $site_data['img'] = $this->uploads();
        }
        $site_data['id'] = $details['user_id'];
        $this->view('templates/header');
        $this->view('edit/index', $site_data);
        $this->view('templates/footer');
    }

    public function uploads()
    {
        $img = $this->model('Image');
        $img->setDb(Controller::$db);
        $title = filter_input(INPUT_POST, 'title');
        $user_id = filter_input(INPUT_POST, 'user-id');
        $img_name = $_FILES['photo']['name'];
        $tmp_name = $_FILES['photo']['tmp_name'];
        $img_url = 'default';
        $success = 'unable to upload the image';
        $img_upload = $_SERVER['DOCUMENT_ROOT']  . '/Camagru/public/uploads/user-img/' . $img_name;
        if (($url = $img->move_uploaded_img($tmp_name, $img_upload))) {
            $img_url = $url;
            $success = 'image successfully uploaded';
        }
        $img->set_image_info($title, $img_name, $user_id);
        $img->insert_image();
        return $success;
    }
}
