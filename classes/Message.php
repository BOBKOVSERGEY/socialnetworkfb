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

  public function getMessages($userFrom)
  {
    $userLoggedIn = $this->userObj->getUniqueId();
    $data = '';

    DB::query("UPDATE messages SET opened='yes' WHERE user_to=? AND user_from=?",[$userLoggedIn, $userFrom]);
    $messages = DB::query("SELECT * FROM messages WHERE (user_to=? AND user_from=?) OR (user_from=? AND user_to=?)",[$userLoggedIn, $userFrom, $userLoggedIn, $userFrom]);

    //debug($messages);
    foreach ($messages as $message) {
     $usetTo = $message['user_to'];
     $usetFrom = $message['user_from'];
     $body = $message['body'];

     $divTop = ($usetTo == $userLoggedIn) ? '<div class="message alert-success mb-2 p-2" >' : '<div class="message alert-info mb-2 p-2">';
     $data = $data . $divTop . $body . '</div>';
    }

    return $data;
  }
}