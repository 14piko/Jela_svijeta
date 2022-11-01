$(document).ready(function () {
    remove();
    var $wrapper = $('.js-add-new');

    function remove() {
        $('.js-remove').click(function (e) {
            e.preventDefault();
            var item = $(this).closest('.js-remove-item');
            item.fadeOut();
            setTimeout(function () {
                item.remove();
            }, 500);
        });
    }


    $('.js-add').click(function (e) {
        e.preventDefault();
        var prototype = $wrapper.data('prototype');
        var index = $wrapper.data('index');
        var newForm = prototype.replace(/__name__/g, index);
        $wrapper.data('index', index + 1);
        $(this).after(newForm);
        remove();
    });
});
