$(function () {
  // button for profile post
  $('#submit_profile_post').on('click', function () {
    $.ajax({
      type: 'POST',
      url: '/ajax/ajax-submit-profile-post.php',
      data: $('form.profile_post').serialize(),
      success: function (msg) {
        $('#exampleModal').modal('hide');
        location.reload();
      },
      error: function () {
        alert('Failure');
      }
    });
  })

  // форма регистрации
  $('#signUp').on('click', function (event) {
    event.preventDefault();
    $(".first").slideUp('slow', function () {
      $(".second").slideDown('slow');
    })
  });

  $('#signIn').on('click', function (event) {
    event.preventDefault();
    $(".second").slideUp('slow', function () {
      $(".first").slideDown('slow');
    })
  })

  $('body').on('click', '.btn-delete-post', function (e) {
    e.preventDefault();
    let postid = $(this).data('id-delete-post');
    bootbox.confirm("are you sure that you want this post?", function (result) {
      $.ajax({
        type: 'POST',
        url: '/ajax/ajax-delete-post.php',
        data:{
          'post_id': postid,
          'result': result
        },
        success: function (r) {
          console.log(r);
        },
        error: function () {
          alert('Failure');
        }
      });

      if(result) {
        location.reload();
      }

    });
    
  });
});

