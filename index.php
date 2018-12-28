<?php
require __DIR__ . '/init.php';
require __DIR__ . '/includes/header.php';

$postObj = new Post($_SESSION['user_id']);
//debug($postObj);

if (isset($_POST['post'])) {
  $postObj->submitPost($_POST['post_text'], 'none');
  header("Location: /");
}

if (isset($_GET['post_id'])) {
  $postId = $_GET['post_id'];
  $postObj->displayComments($postId, $userId);
  header('Location: /');
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
        </div>
        <div class="col-md-9">
          <div class="card mb-3">
            <div class="card-body">
              <form class="post_form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="form-group">
                  <textarea name="post_text" class="form-control" id="post_text" rows="3" placeholder="Есть что сказать?"></textarea>
                </div>
                <button type="submit" name="post" id="post_button" class="btn btn-primary">Сказать</button>
              </form>
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
<?php
require __DIR__ . '/includes/footer.php';
?>