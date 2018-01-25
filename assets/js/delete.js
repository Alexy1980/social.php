$(function(){
   $(document).on('click', '.deleteComment', function(){
       var commentID = $(this).data('comment');
       var tweetID = $(this).data('tweet');
       // одновременно с удалением из базы удаляем и из представления
       $.post('http://twitter/core/ajax/deleteComment.php', {deleteComment:commentID}, function(){
           $.post('http://twitter/core/ajax/popuptweets.php', {showpopup:tweetID}, function(data){
               $('.popupTweet').html(data);
               $('.tweet-show-popup-box-cut').click(function(){
                   $('.tweet-show-popup-wrap').hide();
               });
           });
       });
   });
});
