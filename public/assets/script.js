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