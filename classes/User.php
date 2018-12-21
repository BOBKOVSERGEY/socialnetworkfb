<?php


class User
{
  private $user;

  public function __construct($user)
  {
    $this->user = DB::query('SELECT * FROM users WHERE id=:userid', [':userid' => $user])[0];
  }

  public function getFirstAndLastName()
  {
    return $this->user['first_name'] . " " . $this->user['last_name'];
  }

  public function getUsername()
  {
    return $this->user['username'];
  }

  public function getUserId()
  {
    return $this->user['id'];
  }

  public function getUniqueId()
  {
    return $this->user['unique_id'];
  }

  public function getNumPosts()
  {
    return $this->user['num_posts'];
  }

  public function getProfilePic()
  {
    return $this->user['profile_pic'];
  }

  public function getFriendArray()
  {
    return $this->user['friend_array'];
  }
  public function isClosed()
  {
    if ($this->user['user_closed'] == 'yes') {
      return true;
    } else {
      return false;
    }
  }
  public function isFriend($username_to_check)
  {
   $usernameComma = "," . $username_to_check . ",";
   if ((strstr($this->user['friend_array'], $usernameComma) || $username_to_check == $this->user['username'])) {
     return true;
   } else {
     return false;
   }
  }


  /*public function didReceiveRequest($user_from)
  {
    $user_to = $this->user['username'];
    $check_request_query = mysqli_query($this->con, "SELECT * FROM friend_request WHERE user_to='$user_to' AND user_from='$user_from'");
    if (mysqli_num_rows($check_request_query) > 0) {
      return true;
    } else {
      return false;
    }
  }
  /*

  public function didSendRequest($user_to)
  {
    $user_from = $this->user['username'];
    $check_request_query = mysqli_query($this->con, "SELECT * FROM friend_request WHERE user_to='$user_to' AND user_from='$user_from'");
    if (mysqli_num_rows($check_request_query) > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function removeFriend($user_to_remove)
  {
    $logged_in_user = $this->user['username'];

    $query = mysqli_query($this->con, "SELECT friend_array FROM users WHERE username='$user_to_remove'");
    $row = mysqli_fetch_array($query);
    $friend_array_username = $row['friend_array'];

    $new_friend_array = str_replace($user_to_remove . ",", '', $this->user['friend_array']);
    $remove_friend = mysqli_query($this->con, "UPDATE users SET friend_array='$new_friend_array' WHERE username='$logged_in_user'");

    $new_friend_array = str_replace($this->user['username'] . ",", '', $friend_array_username);
    $remove_friend = mysqli_query($this->con, "UPDATE users SET friend_array='$new_friend_array' WHERE username='$user_to_remove'");
  }

  public function sendRequest($user_to)
  {
    $user_from = $this->user['username'];
    $query = mysqli_query($this->con, "INSERT INTO friend_request VALUES(null,'$user_to', '$user_from')");
  }*/
}