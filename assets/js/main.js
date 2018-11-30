$(function () {
  // button for profile post
  $('#submit_profile_post').on('click', function () {
    $.ajax({
      type: 'POST',
      url: '/includes/handlers/ajax_submit_profile_post.php',
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
});

