;(function($) {
  var $type = $('.js-form-type');
  var $dept = $('.js-dept-group');

  $type.on('change', function() {
    if ($type.val() === 'professor' || $type.val() === 'dean') {
      $dept.fadeIn();
    } else {
      $dept.fadeOut();
    }
  });
})(jQuery);