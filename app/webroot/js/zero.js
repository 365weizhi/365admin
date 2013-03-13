$(function() {

  var $container = $('#cascade-container');

  $container.imagesLoaded( function(){
    $container.masonry({
      itemSelector : '.image-block'
    });
  });

});
