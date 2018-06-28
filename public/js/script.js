$(function() {
    $('.reset').click(function() {
        $('#new_beer').val('');
        $('#beer_id').val('');
    });
    $('.change').click(function() {
        $('#new_beer').val($(this).data('name'));
        $('#beer_id').val($(this).data('id'));
    });
});