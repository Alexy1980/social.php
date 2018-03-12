$(function(){
    $(document).on('click', '#messagePopup', function(){
        var getMessages = 1;
        $.post('http://twitter/core/ajax/messages.php', {showMessage:getMessages}, function(data){
            $('.popupTweet').html(data);
        });
    });

    $(document).on('click', '.people-message', function(){
        var get_id = $(this).data('user');
        $.post('http://twitter/core/ajax/messages.php', {showChatPopup:get_id}, function(data){
            $('.popupTweet').html(data);
        });

        $.post('http://twitter/core/ajax/messages.php', {showChatMessage:get_id}, function(data){
            $('.main-msg-inner').html(data);
        });
    });
});
