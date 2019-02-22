<?php
require __DIR__ . '/init.php';
require __DIR__ . '/includes/header.php';

if (isset($_GET['profile_uniqueid'])) {
  $uniqueId = $_GET['profile_uniqueid'];

  $userObj = DB::query('SELECT * FROM users WHERE unique_id = ?', [$uniqueId])[0];
  $numFriends = (substr_count($user['friend_array'], ',')) - 1;
}

if (isset($_POST['remove_friend'])) {
  $user = new User($_SESSION['user_id']);
  $user->removeFriend($userObj['id']);
}

if (isset($_POST['add_friend'])) {
  $user = new User($_SESSION['user_id']);

  $user->sendRequest($userObj['id']);
  header("Location: $uniqueId");

}

if (isset($_POST['respond_request'])) {
  header("Location: requests.php");
}

?>
  <section class="user-details">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <div class="card">
            <div class="card-body">
              <div class="user-details__main-img mb-3">
                <img src="<?php echo $userObj['profile_pic']; ?>" alt="<?php echo $userObj['username'];?>">
              </div>
              <p class="text-center"><?php echo $userObj['username'];?></p>
              <ul class="list-group mb-3">
                <li class="list-group-item">Posts: <?php echo $userObj['num_posts']; ?></li>
                <li class="list-group-item">Likes: <?php echo $userObj['num_likes']; ?></li>
                <li class="list-group-item">Friends: <?php echo $numFriends; ?></li>
              </ul>
              <div>
                <form action="<?php echo $uniqueId?>" method="post">
                  <?php
                  $profileUser = new User($userObj['id']);

                  if ($profileUser->isClosed()) {
                    header("Location: user_closed.php");
                  }
                  $loggedInUser = new User($_SESSION['user_id']);


                  if ($userUniqueId != $uniqueId) {
                    if ($loggedInUser->isFriend($userObj['id'])) {
                      echo '<input type="submit" name="remove_friend" class="btn btn-danger" value="Remove Friend"><br><br>';
                    } else if ($loggedInUser->didReceiveRequest($userObj['id'])) {
                      echo '<input type="submit" name="respond_request" class="btn btn-warning" value="Respond to request"><br><br>';
                    } else if ($loggedInUser->didSendRequest($userObj['id'])) {
                      echo '<input type="submit" name="" class="btn btn-primary" value="Respond Sent"><br><br>';
                    } else {
                      echo '<input type="submit" name="add_friend" class="btn btn-success" value="Add friend"><br><br>';
                    }
                  }
                  ?>
                </form>
                <input type="submit" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" value="Post Something">
                <?php if ($userUniqueId != $uniqueId) { ?>
                  <div class="m-3"><span class="badge badge-pill badge-info"><?php echo $loggedInUser->getMutuaFriends($userObj['id']); ?></span> Mutual friends</div>
                <?php  } ?>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-9">
          <div class="card mb-3">
            <div class="card-body">
              <div class="posts_area"></div>
              <div class="text-center m-3">
                <i id="loading" class="fa fa-spinner fa-3x fa-spin"></i>
              </div>
              <div>

              </div>

            </div>

          </div>
        </div>
      </div>
    </div>
  </section>
  <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Post something</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" class="profile_post" method="post">
          <div class="modal-body">
            <div class="form-group">
              <textarea class="form-control" name="post_body" rows="3"></textarea>
              <input type="hidden" name="user_from" value="<?php echo $_SESSION['user_id']; ?>">
              <input type="hidden" name="user_to" value="<?php echo $userObj['id']; ?>">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="post_button" class="btn btn-primary" id="submit_profile_post">Post</button>
          </div>
        </form>
      </div>
    </div>
  </div>

<?php
require __DIR__ . '/includes/footer-profile.php';
?>