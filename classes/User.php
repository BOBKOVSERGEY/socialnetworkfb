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
  public function isFriend($userIdToCheck)
  {
   $userIdComma = ',' . $userIdToCheck . ',';
   if ((strstr($this->user['friend_array'], $userIdComma) || $userIdToCheck == $this->user['id'])) {
     return true;
   } else {
     return false;
   }
  }


   public function didReceiveRequest($userFrom)
  {
    $userTo = $this->user['id'];
    $result = DB::query("SELECT * FROM friend_request WHERE user_to = ? AND user_from = ? ", [$userTo, $userFrom]);

    if (count($result) > 0) {
      return true;
    } else {
      return false;
    }
  }


    public function didSendRequest($userTo)
    {
      $userFrom = $this->user['id'];
      $result = DB::query("SELECT * FROM friend_request WHERE user_to = ? AND user_from = ? ", [$userTo, $userFrom]);
      if (count($result) > 0) {
        return true;
      } else {
        return false;
      }
    }

   public function removeFriend($userToRemove)
   {
     $loggedInUser = $this->user['id'];

     $friends = DB::query("SELECT friend_array FROM users WHERE id = ?", [$userToRemove])[0];

     $friendsArrayId = $friends['friend_array'];

     $newFriendArray = str_replace($userToRemove . ",", '', $this->user['friend_array']);

     $removeFriend = DB::query("UPDATE users SET friend_array = ? WHERE id = ? ", [$newFriendArray,$loggedInUser]);

     $newFriendArray = str_replace($this->user['id'] . ",", '', $friendsArrayId);
     $removeFriend = DB::query("UPDATE users SET friend_array = ? WHERE id = ?", [$newFriendArray, $userToRemove]);
   }

   public function sendRequest($userTo)
   {
     $userFrom = $this->user['id'];
     DB::query("INSERT INTO friend_request VALUES(null,?, ?)", [$userTo, $userFrom]);
   }

   public function getMutuaFriends($userToCheck)
   {
      $mutualFriends = 0;
      $userArray = $this->user['friend_array'];
      $userArrayExplode = explode(',', $userArray);

      $result = DB::query('SELECT friend_array FROM users WHERE id = ?', [$userToCheck])[0];
      $userToCheckArray = $result['friend_array'];

      $userToCheckArrayExplode = explode(',', $userToCheckArray);

      foreach ($userArrayExplode as $i) {
        foreach ($userToCheckArrayExplode as $j) {
          if ($i == $j && $i != '') {
            $mutualFriends++;
          }
        }
      }

      return $mutualFriends;

   }
}