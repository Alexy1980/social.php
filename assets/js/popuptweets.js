$(function(){
    $(document).on('click', '.t-show-popup', function(){
        var tweet_id = $(this).data('tweet');
        $.post('http://twitter/core/ajax/popuptweets.php', {showpopup:tweet_id}, function(data){
            $('.popupTweet').html(data);
            $('.tweet-show-popup-box-cut').click(function(){
                $('.tweet-show-popup-wrap').hide();
            });
        });
    });

    $(document).on('click', '.imagePopup', function(e){
        // метод stopPropagation() останавливает всплытие (bubbling) события “клик” к родительским элементам
        e.stopPropagation();
        var tweet_id = $(this).data('tweet');
        $.post('http://twitter/core/ajax/imagePopup.php', {showImage:tweet_id}, function(data){
            $('.popupTweet').html(data);
            $('.close-imagePopup').click(function(){
                $('.img-popup').hide();
            });
        });
    });
});
