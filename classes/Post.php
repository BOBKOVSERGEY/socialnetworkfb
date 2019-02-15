<?php
class Post
{
  private $userObj;

  public function __construct($user)
  {
    $this->userObj = new User($user);
  }

  public function submitPost($body, $userTo)
  {
    $body = Base::security($body);
    if (!empty($body)) {
      // current date and time
      $dateAdded = date("Y-m-d H:i:s");

      // get username
      $addedBy = $this->userObj->getUserId();
      // get userId
      $userId = $this->userObj->getUserId();

      $uniqueId = $this->userObj->getUniqueId();

      if ($userTo == $addedBy) {
        $userTo = "none";
      }

      DB::query("INSERT INTO posts VALUES (null, :body, :added_by, :user_to, :date_added, 'no', 'no', '0', :userid)", [':body' => $body, ':added_by' => $addedBy, ':user_to' => $userTo, ':date_added' => $dateAdded, ':userid' => $userId]);

      $numPosts = $this->userObj->getNumPosts();
      $numPosts++;
      DB::query('UPDATE users SET num_posts=:numposts WHERE id=:userid', [':numposts' => $numPosts, ':userid'=> $userId]);

    }
  }

  public function getTime($dateTime)
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



  public function loadPostsFriends($data, $limit)
  {
    $page = $data['page'];

    $userLoggedId = $this->userObj->getUserId();


    if($page == 1)
      $start = 0;
    else
      $start = ($page - 1) * $limit;

    $str = ""; //String to return

    $dbPosts = DB::query('SELECT * FROM posts WHERE deleted=:deleted ORDER BY id DESC', [':deleted' => 'no']);

    if (count($dbPosts) > 0) {
      $numIteration = 0;
      $count = 1;
      foreach ($dbPosts as $post) {
        //debug($post);
        $id = $post['id'];
        $body = $post['body'];
        $addedBy = $post['added_by'];
        $dateTime = $post['date_added'];
        $userId = $post['user_id'];

        if ($post['user_to'] == 'none') {
          $userTo = "";
        } else {
          $userToObj = new User($post['user_to']);
          $userToName = $userToObj->getFirstAndLastName();
          $userTo = "to <a href='" . $userToObj->getUniqueId() . "'>" . $userToName . "</a>";
        }

        $addedByObj = new User($userId);
        if ($addedByObj->isClosed()) {
          continue;
        }


        if ($this->userObj->isFriend($userId)) {
          if ($numIteration++ < $start) {
            continue;
          }

          if ($count > $limit) {
            break;
          } else {
            $count++;
          }

          if ($userLoggedId == $addedBy)
            $delete_button = '<button class="btn btn-danger btn-delete-post" style="float: right" data-id-delete-post="' . $id . '">×</button>';
          else
            $delete_button = '';

          $user = DB::query('SELECT first_name, unique_id, last_name, profile_pic FROM users WHERE id=:added_by', [':added_by' => $userId])[0];
          //debug($user);

          $commentsCheck = DB::query("SELECT * FROM posts_comments WHERE post_id=:postid", [':postid'=>$id]);
          $amountComments = count($commentsCheck);



          $timeMessage = $this->getTime($dateTime);


          $str .= '<div class="card status_post mt-3 p-3">
                    <div class="row align-items-center">
                      <div class="col-md-2">
                        <div class="post_profile_pic">
                          <img class="rounded-circle" src="'. $user['profile_pic'] .'" width="100%" alt="">
                        </div>
                      </div>
                      <div class="col-md-10">
                        <div class="posted_by">
                          <a href="'. $user['unique_id'] .'">'. $user['first_name'] . ' ' . $user['last_name'] . '</a>  ' . $userTo . ' ' . $timeMessage . '
                          '. $delete_button . '
                        </div>
                        <div class="mt-2 mb-2">' . $body . '</div>
                        ' . $this->displayLikes($id, $userId) . '
                      </div>
                      <div class="mt-3 ml-3 mr-3">Comments <span class="badge badge-secondary">'. $amountComments .'</span></div>
                    </div>'. $this->displayComments($id, $userId) .'
                   </div>';

        }

      }

      if ($count > $limit) {
        $str .= '<input type="hidden" class="nextPage" value="' . ($page + 1) . '">
							<input type="hidden" class="noMorePosts" value="false">';
      } else {
        $str .= '<input type="hidden" class="noMorePosts" value="true">
                  <p class="text-center m-3"> No more posts to show! </p>';
      }


    }

    return $str;

  }

  public function loadProfilePosts($data, $limit)
  {
    $page = $data['page'];

    $profileUserId = $data['profileUserId'];

    $userLoggedId = $this->userObj->getUserId();


    if($page == 1)
      $start = 0;
    else
      $start = ($page - 1) * $limit;

    $str = ""; //String to return

    $dbPosts = DB::query('SELECT * FROM posts WHERE deleted=:deleted AND((added_by=:added_by AND user_to = :user_to) OR user_to =:profileUserId) ORDER BY id DESC', [':deleted' => 'no', ':added_by' => $profileUserId, ':user_to' => 'none', ':profileUserId' => $profileUserId]);
    if (count($dbPosts) > 0) {
      $numIteration = 0;
      $count = 1;
      foreach ($dbPosts as $post) {
        //debug($post);
        $id = $post['id'];
        $body = $post['body'];
        $addedBy = $post['added_by'];
        $dateTime = $post['date_added'];
        $userId = $post['user_id'];

        /*if ($post['user_to'] == 'none') {
          $userTo = "";
        } else {
          $userToObj = new User($post['user_to']);
          $userToName = $userToObj->getFirstAndLastName();
          $userTo = "to <a href='" . $userToObj->getUniqueId() . "'>" . $userToName . "</a>";
        }

        $addedByObj = new User($userId);
        if ($addedByObj->isClosed()) {
          continue;
        }*/


        //if ($this->userObj->isFriend($userId)) {
          if ($numIteration++ < $start) {
            continue;
          }

          if ($count > $limit) {
            break;
          } else {
            $count++;
          }

          if ($userLoggedId == $addedBy)
            $delete_button = '<button class="btn btn-danger btn-delete-post" style="float: right" data-id-delete-post="' . $id . '">×</button>';
          else
            $delete_button = '';

          $user = DB::query('SELECT first_name, unique_id, last_name, profile_pic FROM users WHERE id=:added_by', [':added_by' => $userId])[0];
          //debug($user);

          $commentsCheck = DB::query("SELECT * FROM posts_comments WHERE post_id=:postid", [':postid'=>$id]);
          $amountComments = count($commentsCheck);



          $timeMessage = $this->getTime($dateTime);


          $str .= '<div class="card status_post mt-3 p-3">
                    <div class="row align-items-center">
                      <div class="col-md-2">
                        <div class="post_profile_pic">
                          <img class="rounded-circle" src="'. $user['profile_pic'] .'" width="100%" alt="">
                        </div>
                      </div>
                      <div class="col-md-10">
                        <div class="posted_by">
                          <a href="'. $user['unique_id'] .'">'. $user['first_name'] . ' ' . $user['last_name'] . '</a> ' . $timeMessage . '
                          '. $delete_button . '
                        </div>
                        <div class="mt-2 mb-2">' . $body . '</div>
                        ' . $this->displayLikes($id, $userId) . '
                      </div>
                      <div class="mt-3 ml-3 mr-3">Comments <span class="badge badge-secondary">'. $amountComments .'</span></div>
                    </div>'. $this->displayComments($id, $userId) .'
                   </div>';

        //}

      }

      if ($count > $limit) {
        $str .= '<input type="hidden" class="nextPage" value="' . ($page + 1) . '">
							<input type="hidden" class="noMorePosts" value="false">';
      } else {
        $str .= '<input type="hidden" class="noMorePosts" value="true">
                  <p class="text-center m-3"> No more posts to show! </p>';
      }


    }

    return $str;

  }

  public function displayComments($postId, $userId)
  {
    $user  = DB::query('SELECT added_by, user_to FROM posts WHERE id=:postid', [':postid' => $postId])[0];
    ob_start();
    $postedTo = $user['added_by'];

    if (isset($_POST['postComment' . $postId])) {

      $postBody = Base::security($_POST['post_body']);
      $dateTimeNow = date("Y-m-d H:i:s");
      if ($postBody) {
        DB::query("INSERT INTO posts_comments VALUES (null, :postbody, :userid, :userto, :datetimenow, 'no', :postid)", [':postbody' => $postBody, ':userid' => $userId, ':userto' => $postedTo, ':datetimenow' => $dateTimeNow, ':postid' => $postId]);
        echo "<p>Комментарий добавлен!</p>";
      } else {
        echo "<p>Введите что нибудь!</p>";
      }
    }

    ?>
    <div class="mt-3 mb-3"><form action="index.php?post_id=<?php echo $postId ?>" method="post">
      <div class="form-group mb-3">
        <textarea name="post_body" class="form-control" rows="2" placeholder="Введите комментарий"></textarea>
      </div>
      <button type="submit" name="postComment<?php echo $postId; ?>"  class="btn btn-info btn-sm">Комментировать</button>
    </form></div>
    <?php

    $getComments = DB::query("SELECT * FROM posts_comments WHERE post_id = :postid ORDER BY id DESC", [':postid'=>$postId]);

    if (count($getComments) != 0) {
      echo '<div class="comments">';
      foreach ($getComments as $comment) {

        $commentBody = $comment['post_body'];
        $postedTo = $comment['posted_to'];
        $postedBy = $comment['posted_by'];
        $dateAdded = $comment['date_added'];
        $removed = $comment['removed'];

        $timeMessage = $this->getTime($dateAdded);

        $userObj = new User($postedBy);

        ?>
        <div class="">
          <div class="d-flex mt-3 align-items-center">
            <a href="<?php if (!empty($postedBy)) { echo $userObj->getUniqueId(); } ?>" style="text-decoration: none; margin-right: 10px;"><img src="<?php echo $userObj->getProfilePic(); ?>" title="" alt="" style="width: 30px; border-radius: 50%;"></a>
            <a href="<?php if (!empty($postedBy)) { echo $userObj->getUniqueId(); } ?>" style="text-decoration: none; margin-right: 10px;"><?php echo $userObj->getFirstAndLastName(); ?></a>
            <span><?php echo $timeMessage; ?></span>
          </div>
          <div class="mb-3">
            <?php echo $commentBody; ?>
          </div>
        </div>
        <?php
      }
      echo '</div>';
    } else {
      //echo "<p class='text-center m-2'>No comments to Show!</p>";
    }
    return ob_get_clean();
  }

  public function displayLikes($postId, $userId)
  {
    $getLikes = DB::query('SELECT likes, added_by, user_id FROM posts WHERE id=:postid', [':postid'=> $postId])[0];
    ob_start();
    $totalLikes = $getLikes['likes'];
    $userLiked = $getLikes['user_id'];

    $user = DB::query('SELECT * FROM users WHERE id = :userliked', [':userliked' => $userLiked])[0];


        $totalUserLikes = $user['num_likes'];
        $userName = $user['username'];

        // like button
        if (isset($_POST['like_button'])) {
          $totalLikes++;
          $totalUserLikes++;
          DB::query('UPDATE posts SET likes = :totallikes WHERE id = :postid', [':totallikes' => $totalLikes, ':postid' => $postId]);
          DB::query('UPDATE users SET num_likes = :totaluserlikes WHERE id = :userid', [':totaluserlikes' => $totalUserLikes, ':userid' => $userLiked]);
          DB::query('INSERT INTO likes (username, post_id, user_id) VALUES(:username, :postid, :userid)', [':username' => $userName, ':postid' => $postId, ':userid' => $_SESSION['user_id']]);
        }

    // unlike button
        if (isset($_POST['unlike_button'])) {
          $totalLikes--;
          $totalUserLikes--;
          DB::query('UPDATE posts SET likes = :totallikes WHERE id = :postid', [':totallikes' => $totalLikes, ':postid' => $postId]);
          DB::query('UPDATE users SET num_likes = :totaluserlikes WHERE id = :userid', [':totaluserlikes' => $totalUserLikes, ':userid' => $userLiked]);
          DB::query('DELETE FROM likes WHERE user_id =:userid AND post_id=:postid', [':userid' => $_SESSION['user_id'], ':postid'=>$postId]);
        }

            $check = DB::query('SELECT * FROM likes WHERE user_id = :userid AND post_id = :postid', [':userid' => $_SESSION['user_id'], ':postid'=> $postId]);
                $count = count($check);



                if ($count > 0) {
                  echo '<form action="index.php?post_id=' . $postId . '" method="post">
                      <input type="submit" class="btn" name="unlike_button" value="UnLike">
                      <span class="badge badge-secondary">'. $totalLikes .'</span> Likes
                    </form>';
                } else {
                  echo '<form action="index.php?post_id=' . $postId . '" method="post">
                      <input type="submit" class="btn" name="like_button" value="Like">
                      <span class="badge badge-secondary">'. $totalLikes .'</span> Likes
                    </form>';
                }
    return ob_get_clean();
  }

}