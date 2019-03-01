<?php

class Message
{
  private $userObj;

  public function __construct($user)
  {
    $this->userObj = new User($user);
  }

  public function getMostRecentUser()
  {
    $userLoggedIn = $this->userObj->getUniqueId();

    $user = DB::query('SELECT user_to, user_from FROM messages WHERE user_to = ? OR user_from = ? ORDER BY id DESC LIMIT 1', [$userLoggedIn, $userLoggedIn])[0];
    debug($user);

    if (count($user) == 0) {
      return false;
    }

    $userTo = $user['user_to'];
    $userFrom = $user['user_from'];

    if ($userTo != $userLoggedIn) {
      return $userTo;
    } else {
      return $userFrom;
    }

  }

  public function sendMessage($userTo, $body, $date)
  {
    if (!empty($body)) {
      $userLoggedIn = $this->userObj->getUniqueId();
      DB::query('INSERT INTO messages VALUES (null,:userto,:userfrom,:body,:date,:opened,:viewed,:deleted)', [':userto' => $userTo, ':userfrom' => $userLoggedIn, ':body' => $body, ':date' => $date, ':opened' => 'no', ':viewed' => 'no', ':deleted' => 'no']);
    }
  }
}