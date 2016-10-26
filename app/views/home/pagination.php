<?php
  // find the current page
 if (empty($site_data['id'])) {
   $current_page = 'index.php';
 }else {
  $current_page = $site_data['id'] .'.php';
 }

  // remove the .php extension and get the page number
  $page_number = rtrim($current_page, '.php');

  // function for pagination links, before the current page.
  // the function will have 2 parameters, one for the current page number ($page_number), and one for 
  // the number of pages before the current page ($num_prev_pages).

  function prev_pages($page_number,$num_prev_pages){
    $list_items = ''; // to save all list items.
    while ($num_prev_pages >= 1) {
      $page_number -= 1;
      // adding items to the list only if they are positive numbers.
      if($page_number >= 1){
                            $page = $page_number.'.php'; // get the page before adding it to the list
                            $page_exits = (file_exists("$page") ? '' : 'class="hide"' ); //check if page exits, and assign a class to the list item.
        $list_items = '<li '.$page_exits.' ><a href="' . SITE_URL . '/' . $page_number . '">' . $page_number . '</a></li>' . $list_items; 
      }
      $num_prev_pages -= 1;
    }
    return $list_items;
  }

  // function for pagination links, after the current page.
  // the function has two parameters, one for the current page number ($page_number), and one for the number of 
  // pages after the current page ($num_next_pages).

  function next_pages($page_number, $num_next_pages) {
    $list_items = ''; // to save list items.
    $count = 1;
    while ($count <= $num_next_pages) {
      $page_number += 1;
                        $page = $page_number .'.php'; // get the page before adding it to the list
                        $page_exits = (file_exists("$page") ? '' : 'class="hide"' ); //check if page exits, and assign a class to the list item.
      $list_items .= '<li '.$page_exits.'><a href="' . SITE_URL . '/' . $page_number . '">' .$page_number . '</a></li>';
      $count += 1;
    }
    return $list_items;
  }

  //  function for creating the pagination.
  //  the function has 3 parameters, one for the current page number ($page_number), 
  //  number of previous pages ($num_prev_pages), and number of the next pages ($num_next_pages).

  function pagination($page_number, $num_prev_pages, $num_next_pages){

    $prev_pages_list = prev_pages($page_number,$num_prev_pages);
    $next_page_list = next_pages($page_number, $num_next_pages);
                $page_exits = ($page_number == 'index' ? ' hide' : '' ); //check if current page is index.php
    $list_items = $prev_pages_list . '<li class="current'.$page_exits.'"><a href="">' . $page_number . '</a> </li>' . $next_page_list;
    echo $list_items;
  }

  // working with the database
