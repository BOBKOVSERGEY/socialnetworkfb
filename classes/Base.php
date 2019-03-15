<?php

class Base
{
  public static function security($data)
  {
    return trim(strip_tags($data));
  }

  public static function getTime($dateTime)
  {
    //date_default_timezone_set('Europe/Moscow');
    $dateTimeNow = date("Y-m-d H:i:s");
    $startDate = new DateTime($dateTime); //Time of post
    $endDate = new DateTime($dateTimeNow); //Current time
    $interval = $startDate->diff($endDate); //Difference between dates

    if ($interval->y >= 1) {
      if ($interval == 1)
        $timeMessage = $interval->y . " year ago"; //1 year ago
      else
        $timeMessage = $interval->y . " years ago"; //1+ year ago
    } else if ($interval->m >= 1) {
      if ($interval->d == 0) {
        $days = " ago";
      } else if ($interval->d == 1) {
        $days = $interval->d . " day ago";
      } else {
        $days = $interval->d . " days ago";
      }


      if ($interval->m == 1) {
        $timeMessage = $interval->m . " month " . $days;
      } else {
        $timeMessage = $interval->m . " months " . $days;
      }

    } else if ($interval->d >= 1) {
      if ($interval->d == 1) {
        $timeMessage = "Yesterday";
      } else {
        $timeMessage = $interval->d . " days ago";
      }
    } else if ($interval->h >= 1) {
      if ($interval->h == 1) {
        $timeMessage = $interval->h . " hour ago";
      } else {
        $timeMessage = $interval->h . " hours ago";
      }
    } else if ($interval->i >= 1) {
      if ($interval->i == 1) {
        $time_message = $interval->i . " minute ago";
      } else {
        $timeMessage = $interval->i . " minutes ago";
      }
    } else {
      if ($interval->s < 30) {
        $timeMessage = "Just now";
      } else {
        $timeMessage = $interval->s . " seconds ago";
      }
    }
    return $timeMessage;
  }
}