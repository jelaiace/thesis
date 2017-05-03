  // <form data-verilete="user" data-verilete-name=
  // Verilete = Verify delete
+(function($, undefined) {
  var prevent = true;

  $('[data-verilete]').on('submit', function(e) {
    if (!prevent) {
      return;
    }

    e.preventDefault();

    var el = $(this)
    var resource = el.data('verilete') || 'resource'
    var name = el.data('verilete-name')

    swal({
      title: 'Warning',
      type: 'warning',
      text: message({ resource: resource, name: name }),
      showCancelButton: true
    }, function() {
      prevent = false;
      el.submit();
    })
  })

  function message({resource, name}) {
    const text = `Are you sure to delete this ${resource}`

    return !name
      ? `${text}?`
      : `${text} (${name})?`
  }
})(jQuery)

+(function($) {
  $('[data-jort]').on('click', function() {
    var el = $(this)
    var key = el.data('jort')
    var q = new URLSearchParams(window.location.search)
    var sort = q.get('sort')
    var descending = `-${key}`
    
    if (!sort || (sort !== key && sort !== descending)) {
      q.set('sort', key)
    } else if (sort.substr(0, 1) === '-') {
      q.delete('sort')
    } else {
      q.set('sort', descending)
    }

    window.location.search = String(q)
  })
})(jQuery)