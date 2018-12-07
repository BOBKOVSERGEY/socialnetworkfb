<?php
session_start();
error_reporting(-1);
spl_autoload_register(function($className) {
  require __DIR__ . '/classes/' . $className . '.php';
});

$timeZone = date_default_timezone_get("Europe/Moscow");

function debug($arr)
{
  echo '<pre>';
  print_r($arr);
  echo '</pre>';
}