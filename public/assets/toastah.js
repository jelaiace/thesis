;(function(window, $, undefined) {
  var body = $('body');
  var container = $('<div class="toast-float" data-toastah-container></div>');

  body.append(container);

  function toastah(message) {
    var item = $(`
      <div class="item">
        ${message}
        <button class="close">
          ×
        </button>
      </div>
    `);

    container.append(item);

    setTimeout(() => {
      item.remove();
    }, 10000);
  }

  container.on('click', '.item > .close', function() {
    var item = $(this).parent('.item').remove();
  });

  window.toastah = toastah;
})(window, jQuery);