$(function () {
  var timeoutId;
  $('.full-description').hover(function(){
    if (!$('.full-description').hasClass('active')) {
      if (!timeoutId) {
        timeoutId = window.setTimeout(function() {
          timeoutId = null;
          $('.full-description').toggleClass('active');
          $('.comments-block').toggleClass('active');
          // var text = $('.comments-block p').text();
          // $('.comments-block p').html(text.substr(0, 123) + '...');
        }, 700);
      }
    }
  }, function() {
    if (timeoutId) {
      window.clearTimeout(timeoutId);
      timeoutId = null;
    }
  });
  $('.comments-block').hover(function(){
    if (!$('.comments-block').hasClass('active')) {
      if (!timeoutId) {
        timeoutId = window.setTimeout(function() {
          timeoutId = null;
          $('.full-description').toggleClass('active');
          $('.comments-block').toggleClass('active');
        }, 700);
      }
    }
  }, function() {
    if (timeoutId) {
      window.clearTimeout(timeoutId);
      timeoutId = null;
    }
  });

  $('.carousel').carousel({ interval: 6000 });

  $('.onclick-1').click(function() { $('.filters-1').slideToggle(); });
  $('.onclick-2').click(function() { $('.filters-2').slideToggle(); });
  $('.onclick-3').click(function() { $('.filters-3').slideToggle(); });
  $('.onclick-4').click(function() { $('.filters-4').slideToggle(); });
});

//
// onclick .add-to-cart
//
$('.add-to-cart').on('click', function (e) {
  e.preventDefault();
  var id = $(this).data('id');
  var bookKind = $(this).data('kind');
  var url = '/cart/add-' + bookKind;
  $.ajax({
    url: url,
    data: {id: id},
    type: 'GET',
    success: function (res) {
      //  todo: here i need to update cart
      showCart(res);
    },
    error: function () {
      alert('add-to-cart: error');
    }
  });
});

//
// onclick .del-item
//
$('#cart .modal-body').on('click', '.del-item', function () {
  var id = $(this).data('id');
  $.ajax({
    url: '/cart/del-item',
    data: {id: id},
    type: 'GET',
    success: function (res) {
      showCart(res);
    },
    error: function () {
      alert('del-item: error');
    }
  });
});

//
// function showCart
//
function showCart(cart) {
  $('#cart .modal-body').html(cart);
  $('#cart').modal();
}

//
// function clearCart
//
function clearCart() {
  $.ajax({
    url: '/cart/clear',
    type: 'GET',
    success: function (res) {
      showCart(res);
    },
    error: function () {
      alert('clearCart: error');
    }
  });
}