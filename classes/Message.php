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

  public function getLatestMessage($userLoggedIn, $userUniqueId)
  {
    $details = [];
    $message = DB::query('SELECT body, user_to, date FROM messages WHERE (user_to = ? AND user_from = ?) OR (user_to = ? AND user_from = ?) ORDER BY id DESC LIMIT 1', [$userLoggedIn, $userUniqueId, $userUniqueId, $userLoggedIn])[0];


    $sentBy = ($message['user_to'] == $userLoggedIn) ? 'They said: ' : 'You said: ';
    $timeMessage = Base::getTime($message['date']);

    array_push($details, $sentBy);
    array_push($details, $message['body']);
    array_push($details, $timeMessage);

    return $details;

  }

  public function getConvos()
  {
    $userLoggedIn = $this->userObj->getUniqueId();
    $returnString = '';
    $convos = [];
    $users = DB::query('SELECT user_to, user_from FROM messages WHERE user_to = ? OR user_from = ? ORDER BY id DESC', [$userLoggedIn, $userLoggedIn]);

    foreach ($users as $user) {
      $userToPush = ($user['user_to'] != $userLoggedIn) ? $user['user_to'] : $user['user_from'];
      $id = DB::query('SELECT id FROM users WHERE unique_id = ?', [$userToPush])[0];
      $userToPushId = $id['id'];

      if (!in_array($userToPushId, $convos)) {
        array_push($convos, $userToPushId);
      }
    }


    foreach ($convos as $userId) {
      $userFoundObj = new User($userId);
      $latestMessageDetail = $this->getLatestMessage($userLoggedIn, $userFoundObj->getUniqueId());

      $dots = (strlen($latestMessageDetail[1]) >= 12) ? '...' : '';

      $split = str_split($latestMessageDetail[1], 12);
      $split = $split[0] . $dots;

      $returnString .= '<div class="card p-2 mt-2 mb-2">
                              
                              <a href="messages.php?u='. $userFoundObj->getUniqueId() .'">
                                 <img width="100px" class="rounded-circle" src="' . $userFoundObj->getProfilePic() .'" alt="' . $userFoundObj->getUsername() . '">
                                 <div>'. $userFoundObj->getFirstAndLastName() .'</div>
                              </a>
                                 <p>' . $latestMessageDetail[2] . '</p>
                                 <p>' . $latestMessageDetail[0] . $split .'</p>
                              
                            </div>';


    }

    return $returnString;


  }
}