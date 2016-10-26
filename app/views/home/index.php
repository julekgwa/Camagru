<?php

require_once('pagination.php');
require_once('Db.php');
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
$Db = new Db('mysql:host=localhost;dbname=db_julekgwa','root','000000',$options);

// get row count
$row_count = $Db->rowCounts('images'); // "images" is the name of the table

// how many records should be displayed on a page?
$num_rows = 12;

// get last page
$last_page = ($row_count / $num_rows) - 1;
if(!is_int($last_page)){
    $last_page = (int)$last_page + 1;
}
$start = 0; // starting position (offset)
$limit = $num_rows; // number of records to return

if($current_page !== 'index.php'){
    $start = ($limit * $page_number);
}
// get rows left in the database
$rows_left = $Db->rowsLeft('images', $start, $limit);


if($rows_left < $num_rows){
    $limit = $num_rows;
}
 $obj = $site_data['obj'];
// // selecting data from the database
$select = $Db->get_images_limit($start, $limit);
// var_dump($obj);
//  $site_data['images'] = $obj->get_images_limit($start, $limit);
//  print_r($site_data['images']);
//  exit();
$site_data['images'] = $select;
// $img = new $obj;
// $img->setDB(Controller::$db);
// $site_data['test'] = $img->get_images_limit();
// print_r($site_data['test']);

// // from the data we have, we can now create pages by looping through the $last_page.
// // we are going to create pages until the we reach the last page, by copying index.php or some other page.
// for ($counter = 1; $counter <= $last_page; $counter++) {
//     $page = $counter . '.php';
//     if(!file_exists($page)){
//         copy('index.php', $page);
//     }
// }
?>
<div class="gallery">
    <div class="grid">
        <?php if ($site_data['images']) : ?>
            <?php foreach ($site_data['images'] as $image) : ?>
                <div class="cell">
                    <a href="<?php echo SITE_URL . '/img/' . $image['image_id']; ?>" ><img class="responsive-image" src="<?php echo SITE_URL . '/uploads/user-img/' . $image['image_url']; ?>"></a>
                    <p class="uploader">uploaded by <?php echo ' - <a href="' . SITE_URL . '/profile/'
                            . $image['user_name'] . '">' . $image['user_name'] . '</a>'; ?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <ul class="pagination" role="menubar" arial-label="Pagination">
        <li class="arrow" arial-disabled="true"><a href="<?php echo ($page_number - 1).'.php'; ?>">&laquo; Previous</a></li>
        <!-- pagination goes here -->
        <?php pagination($page_number, 4, 4); ?>
        <li class="arrow" arial-disabled="true"><a href="<?php echo ($page_number + 1).'.php'; ?>">Next &raquo; </a></li>
    </ul>
</div>