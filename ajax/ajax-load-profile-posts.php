<?php
require __DIR__ . '/../init.php';

$limit = 15; // number of posts to be loaded per call

$posts = new Post($_POST['userId']);
echo $posts->loadProfilePosts($_POST, $limit);