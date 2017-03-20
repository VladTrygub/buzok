<?php
use yii\helpers\Url;

?>

<?php if (!empty($_SESSION['cart'])): ?>
  <div class="table-responsive">
    <table class="table table-hover table-stripped">
      <thead>
      <tr>
        <th>Name</th>
        <th>Price</th>
        <th>EBook</th>
        <th>PaperBook</th>
        <th>Quantity</th>
        <th><span class="glyphicon glyphicon-remove"></span></th>
      </tr>
      </thead>
      <tbody>
      <?php foreach ($_SESSION['cart'] as $id => $item): ?>
        <tr>
          <th><a href="<?= Url::to(['shop/view', 'id' => $id]) ?>"><?= $item['name'] ?></a></th>
          <th><?= $item['price'] ?></th>
          <?php
          $ebook = '';
          $pbook = '';
          $max = 1;

          if ($item['book_kind'] == 'ebook') {
            $ebook = 'checked';
          } else {
            $pbook = 'checked';
            $max = $item['count_paper_books'];
          }

          if ($item['is_ebook'] == 0) {
            $ebook .= ' disabled';
          }

          if ($item['count_paper_books'] == 0) {
            $pbook .= ' disabled';
          }

          ?>
          <th><input class="myradio1" type="radio" name="book-kind-<?= $id ?>" value="ebook" <?= $ebook ?>
                     data-id="<?= $id ?>"></th>
          <th><input class="myradio2" type="radio" name="book-kind-<?= $id ?>" value="pbook" <?= $pbook ?>
                     data-id="<?= $id ?>"
                     data-max="<?= $item['count_paper_books'] ?>"></th>
          <th>
            <div class="quantity">
              <input class="quantity-<?= $id ?>" max="<?= $max ?>" min="1" step="1" value="1" type="number">
              <div class="quantity-nav">
                <div class="quantity-button quantity-up">
                  <a href="#" class="btnUp"><p>+</p></a>
                </div>
                <div class="quantity-button quantity-down">
                  <a href="#" class="btnDown"><p>-</p></a>
                </div>
              </div>
            </div>
          </th>
          <th>
            <span
                    class="glyphicon glyphicon-remove text-danger del-item"
                    data-id="<?= $id ?>">
            </span>
          </th>
        </tr>
      <?php endforeach; ?>
      <tr>
        <td colspan="5" align="right">Quantity:</td>
        <td><?= $_SESSION['cart.qty'] ?></td>
      </tr>
      <tr>
        <td colspan="5" align="right">Sum:</td>
        <td><?= $_SESSION['cart.sum'] ?></td>
      </tr>
      </tbody>
    </table>
  </div>
<?php else: ?>
  <h3>Корзина пуста</h3>
<?php endif; ?>


<script>
  //
  // onclick .btnUp
  //
  $('.btnUp').on('click', function (e) {
    e.preventDefault();
    var spinner = $(this).parent().parent().parent(),
      input = spinner.find('input[type="number"]'),
      min = input.attr('min'),
      max = input.attr('max');
    var oldValue = parseFloat(input.val());
    if (oldValue >= max) {
      var newVal = oldValue;
    } else {
      var newVal = oldValue + 1;
    }
    spinner.find("input").val(newVal);
    spinner.find("input").trigger("change");
  });

  //
  // onclick .btnDown
  //
  $('.btnDown').on('click', function (e) {
    e.preventDefault();
    var spinner = $(this).parent().parent().parent(),
      input = spinner.find('input[type="number"]'),
      min = input.attr('min'),
      max = input.attr('max');
    var oldValue = parseFloat(input.val());
    if (oldValue <= min) {
      var newVal = oldValue;
    } else {
      var newVal = oldValue - 1;
    }
    spinner.find("input").val(newVal);
    spinner.find("input").trigger("change");
  });

  //
  // onclick .myradio1
  //
  $('.myradio1').on('click', function () {
    var id = $(this).data('id');
    $('.quantity-' + id).attr('max', 1);
  });

  //
  // onclick .myradio2
  //
  $('.myradio2').on('click', function () {
    var id = $(this).data('id');
    var max = $(this).data('max');
    $('.quantity-' + id).attr('max', max);
  });
</script>
