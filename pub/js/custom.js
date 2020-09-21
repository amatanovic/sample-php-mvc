$(document).ready(function() {
    $('.post-comment').on('click', function () {
        var postButton = $(this),
            postId = postButton.attr('data-post_id'),
            postCommentsUl = $('#post-comments-' + postId),
            commentTextarea = $('#new-comment-' + postId);

        // disable post button
        postButton.prop('disabled', true);

        $.ajax({
            type: 'POST',
            url: '/post/createComment',
            data: {
                'postId': postId,
                'commentContent': commentTextarea.val()
            },
            success: function (data) {
                postCommentsUl.append('<li class="list-group-item">' + data.content + '</li>');
            },
            complete: function () {
                // enable post button
                postButton.prop('disabled', false);
                commentTextarea.val('');
            },
            dataType: 'json'
        });
    })
});
