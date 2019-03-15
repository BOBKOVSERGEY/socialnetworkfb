<?php
require __DIR__ . '/init.php';
require __DIR__ . '/includes/header.php';

$messageObj = new Message($userId);

if (isset($_GET['u'])) {
  $userTo = $_GET['u'];
} else {
  $userTo = $messageObj->getMostRecentUser();
  if ($userTo == false) {
    $userTo = 'new';
  }
}

if ($userTo != "new") {
  $userToObj = DB::query('SELECT * FROM users WHERE unique_id = ?', [$userTo])[0];

  $userToObj = new User($userToObj['id']);
}

if (isset($_POST['post_message'])) {
  if (isset($_POST['message_text'])) {

    $body = Base::security($_POST['message_text']);
    $date = date('Y-m-d H:i:s');
    $messageObj->sendMessage($userTo, $body, $date);
  }
}
?>

<section class="user-details">
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <div class="card">
          <div class="card-body">
            <div class="user-details__main-img p-3">
              <a href="<?php echo $userUniqueId; ?>"><img src="<?php echo $user['profile_pic']?>" alt=""></a>
            </div>
            <div>
              <a href="<?php echo $userUniqueId; ?>">
                <?php echo $user['first_name'] . " " . $user['last_name'];?>
              </a>
            </div>
            <div>
              <?php echo "Постов: " . $user['num_posts']; ?>
            </div>
            <div>
              <?php echo "Лайков: " . $user['num_likes']; ?>
            </div>
          </div>
        </div>
        <div class="card p-2 mt-3 text-center" id="conversation">
          <h4>Conversation</h4>
          <div class="conversation__load mt-3 mb-3">
            <?php echo $messageObj->getConvos(); ?>
          </div>
          <a class="btn btn-success" href="messages.php?u=new">New Message</a>
        </div>
      </div>
      <div class="col-md-9">
        <div class="card">
          <div class="card-body">
            <?php
            if ($userTo != 'new') {
              echo "<h4>You and <a href='" . $userTo . "'>" . $userToObj->getFirstAndLastName() . "</a></h4>";
              echo '<div class="messages__loaded" id="scroll_messages">'. $messageObj->getMessages($userTo) .'</div>';
            } else {
              echo '<h4>New Message</h4>';
            }

            ?>
            <form action="" method="post">
              <?php if ($userTo == 'new') {
                echo '<p class="text-success mb-3">Select the friend you would like to message</p>';
                echo '<div class="form-group">
                        <input type="text" class="form-control messages__search-friend" name="q" placeholder="To:">
                      </div>';
                echo '<div class="results">
                        
                      </div>';
              } else { ?>
                <div class="form-group">
                  <textarea name="message_text" class="form-control" id="message_textarea" rows="3" placeholder="Напишите ваше сообщение..."></textarea>
                </div>
              <?php }?>

              <button type="submit" name="post_message" id="message_submit" class="btn btn-primary">Отправить</button>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
require __DIR__ . '/includes/footer.php';
?>
