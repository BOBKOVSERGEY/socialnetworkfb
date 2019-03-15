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






  $('.messages__search-friend').on('keyup', function () {
    $.post('/ajax/ajax-friend-search.php', {query:this.value, userLoggedIn:userUniqueId}, function (data) {
      $('.results').html(data);
    });
  });


});


$(function(){

  $('#jcrop_target').Jcrop({
    aspectRatio: 1,
    setSelect:   [ 200,200,37,49 ],
    onSelect: updateCoords
  });

});

function updateCoords(c)
{
  $('#x').val(c.x);
  $('#y').val(c.y);
  $('#w').val(c.w);
  $('#h').val(c.h);
};

function checkCoords()
{
  if (parseInt($('#w').val())) return true;
  alert('Please select a crop region then press submit.');
  return false;
};
//End JCrop Bits

function cancelCrop(){
  //Refresh page
  top.location = 'upload.php';
  return false;
}

// scroll messages
if (document.querySelector('#scroll_messages')) {
  let divMessages = document.querySelector('#scroll_messages');
  divMessages.scrollTop = divMessages.scrollHeight;
}
