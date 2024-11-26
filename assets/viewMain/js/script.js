/*women slider*/
$(document).ready(function() {
    $('#slides').lightSlider({
        autoWidth:true,
        loop:true,
        onSliderLoad: function() {
            $('#slider').removeClass('women-slider');
        } 
    });  
  });

  /*men slider*/
$(document).ready(function() {
    $('#slide').lightSlider({
        autoWidth:true,
        loop:true,
        onSliderLoad: function() {
            $('#slide').removeClass('men-slider');
        } 
    });  
  });