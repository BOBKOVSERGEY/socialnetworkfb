<?php
session_start();
spl_autoload_register(function($className) {
  require __DIR__ . '/classes/' . $className . '.php';
});

function debug($arr)
{
  echo '<pre>';
  print_r($arr);
  echo '</pre>';
}