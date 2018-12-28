<?php
ob_start();
session_start();
error_reporting(-1);
spl_autoload_register(function($className) {
  require __DIR__ . '/classes/' . $className . '.php';
});

function debug($arr)
{
  echo '<pre>';
  print_r($arr);
  echo '</pre>';
}
function debugVarDump($array)
{
  echo '<pre>';
  var_dump($array);
  echo '</pre>';
}