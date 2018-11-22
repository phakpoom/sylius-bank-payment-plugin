$(function () {
    $('[data-phpmob-action]').on('click', function (e) {
        e.preventDefault();
        var comment = prompt('Your comment');

        if (null === comment) {
            return;
        }

        var $el =  $(this);
        var url = $el.data('phpmob-action').replace(/\:type/, $(e.target).data('transition'));

        if (comment.trim()) {
            url += '/' + comment.trim();
        }

        $el.find('button').addClass('disabled');
        $.ajax({
            type: 'PUT',
            url: url,
            complete: function () {
                $el.find('button').removeClass('disabled');
            },
            success: function () {
                window.location.reload();
            },
            error: function (xhr) {
                alert(xhr.statusText);
            }
        })
    });
});
