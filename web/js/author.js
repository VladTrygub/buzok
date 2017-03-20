//
//  onclick .create-book-button
//
$('.create-book-button').on('click', function (e) {
  e.preventDefault();
  $(this).fadeOut(200);
  parent = $(this).parent();
  createBook(parent);
});

//
//  ajax /author/create-book
//
function createBook(parent) {
  $.ajax({
    url: '/author/create-book',
    type: 'GET',
    success: function (res) {
      $(parent).html(res).hide().fadeIn(1000);
    },
    error: function () {
      alert('rate-up: error');
    }
  });
}