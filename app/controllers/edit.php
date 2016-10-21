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
        $img_upload = $_SERVER['DOCUMENT_ROOT'] . '/Camagru/public/uploads/user-img/' . $img_name;
        if (($url = $img->move_uploaded_img($tmp_name, $img_upload))) {
            $img_url = $url;
            $success = 'image successfully uploaded';
        }
        $img->set_image_info($title, $img_name, $user_id);
        $img->insert_image();
        return $success;
    }

    public function image_test()
    {
        if (isset($_POST['image'])) {
            $url = $_SERVER['DOCUMENT_ROOT'] . '/Camagru/public/uploads/user-img/';
            $img = $_POST['image'];
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            $file = $url . uniqid() . '.png';
            $success = file_put_contents($file, $data);
            if ($success) {
                $imposer = $_SERVER['DOCUMENT_ROOT'] . '/Camagru/public/images/' . trim($_POST['src']);
                $this->superimp($file, $imposer);
            }
        }
    }

    public function superimp($real_image, $superImposer)
    {
        //the source image, foreground.
        $sourceImage = $superImposer;

//the destination image, background.
        $destImage = $real_image;

//the size of the source image.
        list($sourceWidth, $sourceHeight) = getimagesize($sourceImage);

//creating a new image from the source image.
        $src = imagecreatefrompng($sourceImage);

//create a new image from the destination.
        $dest = imagecreatefrompng($destImage);

//setting the x and y positions of the source image, on topofthe destination image.
        $src_xPosition = 0; //75 pixels from the left.
        $src_yPosition = 0; //50 pixels from the top.

//set the x and y positions of the source image to be copied to the destination image
        $src_cropXposition = 0; //do not crop at the side
        $src_cropYposition = 0; //do not crop on the top

//merge the source and destination
        imagecopy($dest, $src, $src_xPosition, $src_yPosition, $src_cropXposition, $src_cropYposition, $sourceWidth, $sourceHeight);

        imagepng($dest, $real_image);
    }
}
