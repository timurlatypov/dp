$(function () {
    $('#assignOrderManagerModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id') // Extract info from data-* attributes
        var order = button.data('order') // Extract info from data-* attributes
        var manager = button.data('manager') // Extract info from data-* attributes
        var managerid = button.data('managerid') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('#id').val(id)
        modal.find('#order').val(order)
        modal.find('#manager').val(manager)
        modal.find('#managerid').val(managerid)
    })
})

$(function () {
    $('#deleteOrderModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id') // Extract info from data-* attributes
        var order = button.data('order') // Extract info from data-* attributes
        var modal = $(this)
        modal.find('#id').val(id)
        modal.find('#order').val(order)
    })
})


$(function () {
    $('#deleteOrderModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id') // Extract info from data-* attributes
        var order = button.data('order') // Extract info from data-* attributes
        var modal = $(this)
        modal.find('#id').val(id)
        modal.find('#order').val(order)
    })
})


$(function () {
    $('#changeOrderStatusModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id') // Extract info from data-* attributes
        var order = button.data('order') // Extract info from data-* attributes
        var modal = $(this)
        modal.find('#id').val(id)
        modal.find('#order').text(order)
    })
})

$(function () {
    $('#changeOrderPaymentModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id') // Extract info from data-* attributes
        var order = button.data('order') // Extract info from data-* attributes
        var modal = $(this)
        modal.find('#id').val(id)
        modal.find('#order').text(order)
    })
})
