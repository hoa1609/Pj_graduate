(function ($) {
  $(document).ready(function () {

    $('#price-range-submit').hide();

    $("#min_price,#max_price").on('change', function () {

      $('#price-range-submit').show();
      var min_price_range = parseInt($("#min_price").val());
      var max_price_range = parseInt($("#max_price").val());
      if (min_price_range > max_price_range) {
        $('#max_price').val(min_price_range);
      }

      $("#slider-range").slider({
        values: [min_price_range, max_price_range]
      });

    });


    $("#min_price,#max_price").on("paste keyup", function () {

      $('#price-range-submit').show();

      var min_price_range = parseInt($("#min_price").val());
      var max_price_range = parseInt($("#max_price").val());
      if (min_price_range == max_price_range) {
        max_price_range = min_price_range + 100;
        $("#min_price").val(min_price_range);
        $("#max_price").val(max_price_range);
      }

      $("#slider-range").slider({
        values: [min_price_range, max_price_range]
      });

    });

  });
})(jQuery);

