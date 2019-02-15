<?php
require __DIR__ . '/../init.php';

if (isset($_POST['post_id'])) {
  $post_id = $_POST['post_id'];
}

if (isset($_POST['result'])) {
  if ($_POST['result'] == true) {
    DB::query("UPDATE posts SET deleted='yes' WHERE id=?", [$post_id]);
  }
}