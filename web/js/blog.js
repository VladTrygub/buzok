//
//  onclick .add-like
//
$('.add-like').on('click', function (e) {
  e.preventDefault();
  var id = $(this).data('id');
  if ($(this).hasClass('liked'))
    removeLike($(this), id);
  else
    addLike($(this), id);
});

//
//  onclick .rate-up
//
$('.rate-up').on('click', function (e) {
  e.preventDefault();
  var id = $(this).data('id');
  if ($(this).hasClass('rated')) {
    removeRateUp($(this), id);
  } else if ($('.rate-down[data-id = ' + id + ']').hasClass('rated')) {
    removeRateDown($('.rate-down[data-id = ' + id + ']'), id);
    rateUp($(this), id);
  } else {
    rateUp($(this), id);
  }
});

//
//  onclick .rate-down
//
$('.rate-down').on('click', function (e) {
  e.preventDefault();
  var id = $(this).data('id');
  if ($(this).hasClass('rated')) {
    removeRateDown($(this), id);
  } else if ($('.rate-up[data-id = ' + id + ']').hasClass('rated')) {
    removeRateUp($('.rate-up[data-id = ' + id + ']'), id);
    rateDown($(this), id);
  } else {
    rateDown($(this), id);
  }
});

//
//  onclick .login
//
$('.login').on('click', function (e) {
  e.preventDefault();
  showMsgToLogin();
});


//
//  onclick .deny-rate
//
$('.deny-rate').on('click', function (e) {
  e.preventDefault();
  alert('This is your comment, you can\'t rate');
});

//
//  onclick .add-user-comment
//
$('.add-user-comment').on('click', function (e) {
  e.preventDefault();
  //  todo: here i need to check if textarea is not empty
  var comment = $('#add-comment').val();
  var post_id = $(this).data('post-id');
  if (comment) {
    addUserComment(comment, post_id);
  } else {
    alert('no');
  }
});

//
//  ajax /blog/rate-up
//
function rateUp($this, $id) {
  $.ajax({
    url: '/blog/rate-up',
    data: {id: $id},
    type: 'GET',
    success: function (res) {
      $($this).toggleClass('rated');
      $($this).html('<i class="fa fa-thumbs-up" aria-hidden="true"></i> ' + res);
    },
    error: function () {
      alert('rate-up: error');
    }
  });
}

//
//  ajax /blog/rate-down
//
function rateDown($this, $id) {
  $.ajax({
    url: '/blog/rate-down',
    data: {id: $id},
    type: 'GET',
    success: function (res) {
      $($this).toggleClass('rated');
      $($this).html('<i class="fa fa-thumbs-down" aria-hidden="true"></i> ' + res);
    },
    error: function () {
      alert('rate-down: error');
    }
  });
}

//
//  ajax /blog/remove-rate-up
//
function removeRateUp($this, $id) {
  $.ajax({
    url: '/blog/remove-rate-up',
    data: {id: $id},
    type: 'GET',
    success: function (res) {
      $($this).toggleClass('rated');
      if (res == 'zero')
        $($this).html('<i class="fa fa-thumbs-o-up" aria-hidden="true"></i>');
      else
        $($this).html('<i class="fa fa-thumbs-o-up" aria-hidden="true"></i> ' + res);
    },
    error: function () {
      alert('remove-rate-up: error');
    }
  });
}

//
//  ajax /blog/remove-rate-down
//
function removeRateDown($this, $id) {
  $.ajax({
    url: '/blog/remove-rate-down',
    data: {id: $id},
    type: 'GET',
    success: function (res) {
      $($this).toggleClass('rated');
      if (res == 'zero')
        $($this).html('<i class="fa fa-thumbs-o-down" aria-hidden="true"></i> ');
      else
        $($this).html('<i class="fa fa-thumbs-o-down" aria-hidden="true"></i> ' + res);
    },
    error: function () {
      alert('remove-rate-down: error');
    }
  });
}

//
//  ajax /blog/add-like
//
function addLike($this, $id) {
  $.ajax({
    url: '/blog/add-like',
    data: {id: $id},
    type: 'GET',
    success: function (res) {
      $($this).toggleClass('liked');
      if (res == 'zero')
        $($this).html('<i class="fa fa-heart" aria-hidden="true"></i>');
      else
        $($this).html('<i class="fa fa-heart" aria-hidden="true"></i> ' + res);
    },
    error: function () {
      alert('add-like: error');
    }
  });
}

//
//  ajax /blog/remove-like
//
function removeLike($this, $id) {
  $.ajax({
    url: '/blog/remove-like',
    data: {id: $id},
    type: 'GET',
    success: function (res) {
      $($this).toggleClass('liked');
      if (res == 'zero')
        $($this).html('<i class="fa fa-heart-o" aria-hidden="true"></i>');
      else
        $($this).html('<i class="fa fa-heart-o" aria-hidden="true"></i> ' + res);
    },
    error: function () {
      alert('remove-like: error');
    }
  });
}

//
//  ajax /blog/add-user-comment
//
function addUserComment($userComment, $post_id) {
  $.ajax({
    url: '/blog/add-user-comment',
    data: {
      text: $userComment,
      post_id: $post_id
    },
    type: 'POST',
    success: function (res) {
      addCommentToOtherComments(res);
    },
    error: function () {
      alert('add-user-comment: error');
    }
  });
}

//
// function addCommentToOtherComments
//
function addCommentToOtherComments(res) {
  $('#comments').append(res);
  var comment = $('.new').toggleClass('new');
  comment.hide();
  comment.fadeIn(1000);
}

//
// function showMsgToLogin
//
function showMsgToLogin() {
  alert('login');
}