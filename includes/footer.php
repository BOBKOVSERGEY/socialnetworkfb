<script src="/assets/js/lib.js"></script>
<script src="/assets/js/main.js"></script>
<?php if (isset($_SESSION['user_id'])) {?>
  <script>

      var userId = "<?php if ($_SESSION['user_id']) echo $_SESSION['user_id']; ?>";
      var userUniqueId = "<?php if ($_SESSION['unique_id']) echo $_SESSION['unique_id']; ?>";

      $('#loading').show();
      function ajaxRequest() {
        $.ajax({
          url: "../ajax/ajax-load-posts.php",
          type: "POST",
          data:"page=1&userId=" + userId,
          cache: false,

          success: function (data) {
            $('#loading').hide();
            $('.posts_area').html(data)
          }
        });
      }
      ajaxRequest();
      $(window).scroll(function () {
        var height = $('.posts_area').height();

        var scroll_top = $(this).scrollTop();
        var innerHeight = window.innerHeight;

        var page = $('.posts_area').find('.nextPage').val();
        console.log(page);

        var noMorePosts = $('.posts_area').find('.noMorePosts').val();


        var fullHeight = scroll_top + innerHeight;
        //$(window).scrollTop() + $(window).height() >= $(document).height() - 200
        //$(window).scrollTop() + $(window).height() >= $(document).height() && noMorePosts === 'false'

        //console.log('scroll' + scroll_top);
        //console.log('height window' + $(window).height());
        //console.log('document h' + ($(document).height()-20));
        //console.log('sroll + window height ' + ($(window).scrollTop() + $(window).height()));

        if (($(window).scrollTop() + $(window).height()) >= ($(document).height() - 5)  && noMorePosts === 'false') {


          $('#loading').show();

          var ajaxReq = $.ajax({
            url: "../ajax/ajax-load-posts.php",
            type: "POST",
            data:"page=" + page + "&userId=" + userId,
            cache: false,

            success: function (response) {
              $('.posts_area').find('.nextPage').remove();
              $('.posts_area').find('.noMorePosts').remove();

              $('#loading').hide();
              $('.posts_area').append(response)
            }
          });

        }

        return false;

      })
  </script>
<?php }?>

</body>
</html>