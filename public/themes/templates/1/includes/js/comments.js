/*!
 * comment.js
 */

/*!
 * MAIN SITE code
 */

window.CommentEditable = function (commentId, userId) {
    var string1 = 'latest_comment_edit';
    var editableComment = string1.concat(commentId);

    var string2 = 'comment_edit_icon';
    var editIcon = string2.concat(commentId);

    var string3 = 'comment_save_icon';
    var saveIcon = string3.concat(commentId);

    var string4 = 'comment_input';
    var commentInput = string4.concat(commentId);

    var input = document.getElementById(commentInput);
    input.style.display = 'inline';

    var save = document.getElementById(saveIcon);
    save.style.display = 'inline';

    var edit = document.getElementById(editIcon);
    edit.style.display = 'none';

    var output = document.getElementById(editableComment);
    output.style.display = 'none';
}

window.SaveEditable = function (commentId, url, action, extra, view = null, cCounter = null, vCounter = null) {
    var string = 'comment_input';
    var commentData = string.concat(commentId);

    var comment = document.getElementById(commentData).value
    comment = comment.replace(/\n\r?/g, '<br />');

    $.ajax({
        // The URL for the request
        url: url,
        data: 'action=' + action + '&comment_id=' + commentId + '&data=' + comment + '&view=' + view + '&c_counter=' + cCounter + '&v_counter=' + vCounter + '&' + extra,
        type: 'GET',
        dataType: 'html',
        // Code to run if the request succeeds;
        success: function (html) {
            $('#latest_comments_all').html(html);
        }
    });
}

window.DeleteEditable = function (commentId, url, action, extra, view = null, Ccounter = null, Vcounter = null) {
    $('#JSGenericModal').dialog({
        title: 'Delete',
        open: $('#JSGenericModalText').text('Are you sure you want to delete this comment?'),
        resizable: false,
        height: 200,
        modal: true,
        buttons: {
            'Delete': function () {
                $(this).dialog('close');
                $.ajax({
                    // The URL for the request
                    url: url,
                    data: 'action=' + action + '&comment_id=' + commentId + '&view=' + view + '&c_counter=' + Ccounter + '&v_counter=' + Vcounter + '&' + extra,
                    type: 'GET',
                    dataType: 'html',
                    // Code to run if the request succeeds;
                    success: function (html) {
                        $('#latest_comments_all').html(html);
                    }
                });
            },
            Cancel: function () {
                $(this).dialog('close');
            }
        }
    });
}

window.AddComment = function (userId, url, action, extra) {
    var commentData = 'comment_add';
    var comment = document.getElementById(commentData).value

    comment = comment.replace(/\n\r?/g, '<br />');
    document.getElementById('comment_add').value = '';

    $.ajax({
        // The URL for the request
        url: url,
        data: 'action=' + action + '&user_id=' + userId + '&data=' + comment + '&' + extra,
        type: 'GET',
        dataType: 'html',
        // Code to run if the request succeeds;
        success: function (html) {
            $('#latest_comments_all').html(html);
        }
    });
}

/*!
 * CPANEL code
 */

$(document).ready(function () {
    $('#comments_all').click(function () {
        $.ajaxQueue({
            // The URL for the request
            url: 'ajax_comments.php',
            data: 'view=comments_all',
            type: 'GET',
            dataType: 'html',
            // Code to run if the request succeeds;
            success: function (html) {
                $('.jsCommentsWrapper').html(html);
            }
        });
    })
    $('#comments_game_comments').click(function () {
        $.ajaxQueue({
            // The URL for the request
            url: 'ajax_comments.php',
            data: 'view=comments_game_comments',
            type: 'GET',
            dataType: 'html',
            // Code to run if the request succeeds;
            success: function (html) {
                $('.jsCommentsWrapper').html(html);
            }
        });
    })
    $('#comments_game_review_comments').click(function () {
        $.ajaxQueue({
            // The URL for the request
            url: 'ajax_comments.php',
            data: 'view=comments_game_review_comments',
            type: 'GET',
            dataType: 'html',
            // Code to run if the request succeeds;
            success: function (html) {
                $('.jsCommentsWrapper').html(html);
            }
        });
    })
    $('#comments_interview_comments').click(function () {
        $.ajaxQueue({
            // The URL for the request
            url: 'ajax_comments.php',
            data: 'view=comments_interview_comments',
            type: 'GET',
            dataType: 'html',
            // Code to run if the request succeeds;
            success: function (html) {
                $('.jsCommentsWrapper').html(html);
            }
        });
    })
    $('#comments_article_comments').click(function () {
        $.ajaxQueue({
            // The URL for the request
            url: 'ajax_comments.php',
            data: 'view=comments_article_comments',
            type: 'GET',
            dataType: 'html',
            // Code to run if the request succeeds;
            success: function (html) {
                $('.jsCommentsWrapper').html(html);
            }
        });
    })
    $('.jsCommentsWrapper').on('click', '.jsUserCommentsLink', function () {
        var view = 'users_comments';
        var userId = $(this).data('user-id');
        $.ajaxQueue({
            // The URL for the request
            url: 'ajax_comments.php',
            data: 'view=' + view + '&user_id=' + userId,
            type: 'GET',
            dataType: 'html',
            // Code to run if the request succeeds;
            success: function (html) {
                $('.jsCommentsWrapper').html(html);
            }
        });
    })
    // Edit Comment Function
    $('.jsCommentsWrapper').on('click', '.jsCommentsEditButton', function () {
        var commentsId = $(this).data('comments-id');
        var commentType = $(this).data('comment-type');
        var jsCommentTextBoxId = 'jsCommentTextBox'.concat(commentsId);
        $.ajaxQueue({
            // The URL for the request
            url: 'ajax_comments_edit.php',
            data: 'action=get_comment_text&comments_id=' + commentsId + '&comment_type=' + commentType,
            type: 'GET',
            dataType: 'html',
            // Code to run if the request succeeds;
            success: function (html) {
                $('#' + jsCommentTextBoxId).html(html);
                // listenSaveButton();
            }
        });
    })
    // Edit Comment Function dropdown item
    $('.jsCommentsWrapper').on('click', '.jsCommentsEditDropdownItem', function () {
        var commentsId = $(this).data('comments-id');
        var commentType = $(this).data('comment-type');
        var jsCommentTextBoxId = 'jsCommentTextBox'.concat(commentsId);
        $.ajaxQueue({
            // The URL for the request
            url: 'ajax_comments_edit.php',
            data: 'action=get_comment_text&comments_id=' + commentsId + '&comment_type=' + commentType,
            type: 'GET',
            dataType: 'html',
            // Code to run if the request succeeds;
            success: function (html) {
                $('#' + jsCommentTextBoxId).html(html);
                // listenSaveButton();
            }
        });
    })
    // Edit Save Comment Function
    $('.jsCommentsWrapper').on('click', '.jsCommentsEditSaveButton', function () {
        var commentsId = $(this).data('comments-id');
        var commentType = $(this).data('comment-type');
        var jsCommentTextBoxId = 'jsCommentTextBox'.concat(commentsId);
        var commentText = $('#' + jsCommentTextBoxId + ' > #jsCommentText').val();
        commentText = commentText.replace(/\n\r?/g, '<br />');

        $.ajaxQueue({
            // The URL for the request
            url: 'ajax_comments_edit.php',
            data: 'action=save_comment_text&comments_id=' + commentsId + '&comment_text=' + commentText + '&comment_type=' + commentType,
            type: 'POST',
            dataType: 'html',
            // Code to run if the request succeeds;
            success: function (html) {
                var returnHtml = html.split('[BRK]');
                $('#' + jsCommentTextBoxId).html(returnHtml[0]);
                window.OSDMessageDisplay(returnHtml[1]);
            }
        });
    })
    // Delete Comment Function
    $('.jsCommentsWrapper').on('click', '.jsCommentsDeleteButton', function () {
        var commentsId = $(this).data('comments-id');
        $('#JSGenericModal').dialog({
            title: 'Delete Comment',
            open: $('#JSGenericModalText').text('Are you sure you want to delete this comment?'),
            resizable: false,
            height: 200,
            modal: true,
            buttons: {
                'Delete': function () {
                    $(this).dialog('close');
                    $.ajaxQueue({
                        // The URL for the request
                        url: 'db_comments.php',
                        data: 'action=delete&comments_id=' + commentsId,
                        type: 'POST',
                        dataType: 'html',
                        // Code to run if the request succeeds;
                        success: function (html) {
                            var begin = html.startsWith('You');
                            if (begin) {
                            } else {
                                $('#jsCommentId' + commentsId).html('');
                            }
                            window.OSDMessageDisplay(html);
                        }
                    });
                },
                Cancel: function () {
                    $(this).dialog('close');
                }
            }
        });
    })
    // Delete Comment Function in dropdown
    $('.jsCommentsWrapper').on('click', '.jsCommentsDeleteDropdownItem', function () {
        var commentsId = $(this).data('comments-id');
        $('#JSGenericModal').dialog({
            title: 'Delete Comment',
            open: $('#JSGenericModalText').text('Are you sure you want to delete this comment?'),
            resizable: false,
            height: 200,
            modal: true,
            buttons: {
                'Delete': function () {
                    $(this).dialog('close');
                    $.ajaxQueue({
                        // The URL for the request
                        url: 'db_comments.php',
                        data: 'action=delete&comments_id=' + commentsId,
                        type: 'POST',
                        dataType: 'html',
                        // Code to run if the request succeeds;
                        success: function (html) {
                            var begin = html.startsWith('You');
                            if (begin) {
                            } else {
                                $('#jsCommentId' + commentsId).html('');
                            }
                            window.OSDMessageDisplay(html);
                        }
                    });
                },
                Cancel: function () {
                    $(this).dialog('close');
                }
            }
        });
    })

    $(window).scroll(function () {
        if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
            var lastTimestamp = $('.comments_post_box:last').attr('id');
            loadMoreData(lastTimestamp);
        }
    });

    $('.jsCommentsWrapper').on('click', '.comments_button_dropdown', function () {
        var dropdownId = $(this).data('dropdown-id');
        $('#dropdown_box' + dropdownId).toggle('.dropdown_show');
    })

    function loadMoreData (lastTimestamp) {
        var view = $('#view').html();
        if (view === 'users_comments') {
            var userId = $('.jsUserCommentsLink:first').data('user-id');
        }
        $.ajaxQueue({
            // The URL for the request
            url: 'ajax_comments.php',
            data: 'action=autoload&view=' + view + '&last_timestamp=' + lastTimestamp + '&user_id=' + userId,
            type: 'GET',
            dataType: 'html',
            // Code to run if the request succeeds;
            success: function (html) {
                $('.infinite-item:last').append(html);
            }
        });
    }
})
