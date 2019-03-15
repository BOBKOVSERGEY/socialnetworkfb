<?php
require __DIR__ . '/../init.php';


$query = $_POST['query'];
$userLoggedIn = $_POST['userLoggedIn'];

$names = explode(' ', $query);