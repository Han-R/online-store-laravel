$(window).scroll(function () {
            
        if ($(window).scrollTop() >= 200) {
            $('#header').addClass('fixed-header');
        }
        else {
            $('#header').removeClass('fixed-header');
        }
        
        
});