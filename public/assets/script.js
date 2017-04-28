+(function($, undefined) {
  // <form data-verilete="user" data-verilete-name=
  // Verilete = Verify delete
  $('[data-verilete]').on('submit', function(e) {
    var el = $(this)
    var resource = el.data('verilete') || 'resource';
    var name = el.data('verilete-name')

    if (!confirmation({ resource: resource, name: name }) ) {
      e.preventDefault()
    }
  })

  function confirmation({resource, name}) {
    const message = `Are you sure to delete this ${resource}`

    return confirm(!name
      ? `${message}?`
      : `${message} (${name})?`)
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