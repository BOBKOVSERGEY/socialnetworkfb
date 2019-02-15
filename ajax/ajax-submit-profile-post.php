<?php
require __DIR__ . '/../init.php';
//include __DIR__ . '/../header.php';


if (isset($_POST['post_body'])) {
  $post = new Post($_POST['user_from']);
  $post->submitPost($_POST['post_body'], $_POST['user_to']);
}