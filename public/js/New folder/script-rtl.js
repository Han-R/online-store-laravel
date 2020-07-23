$(document).ready(function(){

    /*open menu*/
    $(".hamburger").click(function(){
        $("body,html").addClass('menu-toggle');
        $(".hamburger").addClass('active');
    });
    $(".m-overlay").click(function(){
        $("body,html").removeClass('menu-toggle');
        $(".hamburger").removeClass('active');
    });
        
    $('a[href="#search"]').on('click', function(event) {
    event.preventDefault();
        $('#search').addClass('open');
        $('#main-wrapper').addClass('wrapper-blur');
        setTimeout(function(){
            $('#search form > input[type="text"]').focus();
        },100);
    });

    $('#search, #search .overlay-close').on('click keyup', function(event) {
        if (event.target == this || event.target.className == 'overlay-close' || event.keyCode == 27) {
            $(this).removeClass('open');
            $('#main-wrapper').removeClass('wrapper-blur');
        }
    });

    var owl = $('#homeSlider');

        owl.on('initialized.owl.carousel change.owl.carousel',function(elem){
            var current = elem.item.index;
            $(elem.target).find(".owl-item").eq(current).find(".to-animate").removeClass('fadeInUp animated');
            $(elem.target).find(".owl-item").eq(current).find(".to-animate2").removeClass('slideInUp animated');
        });
       
        owl.on('initialized.owl.carousel changed.owl.carousel',function(elem){
            window.setTimeout(function(){
                var current = elem.item.index;
                $(elem.target).find(".owl-item").eq(current).find(".to-animate").addClass('fadeInUp animated');
                $(elem.target).find(".owl-item").eq(current).find(".to-animate2").addClass('slideInUp animated');
            }, 400);
        });
        owl.owlCarousel({
                items: 1,
                loop: true,
                margin: 0,
                responsiveClass: true,
                nav: true,
                dots: true,
                smartSpeed: 500,
                autoplay: true,
                autoplayTimeout: 5000,
                autoplayHoverPause: true,
                animateOut: 'fadeOut',
                animateIn: 'fadeIn',
                navText:['<i class="fa fa-angle-right"></i>',
                '<i class="fa fa-angle-left"></i>'],
        });
	$("#client-slider").owlCarousel({
 
            // Most important owl features
            loop:true,
            margin:0,
            responsiveClass:true,
            responsive:{
                0:{
                    items:1,
                },
                460:{
                    items:2,
                },
                767:{
                    items:3,
                },
                
                992:{
                    items:5,
                }

            },
            dots:true,
            nav:false,
            autoplay:false,
            rtl:true
        });
    
    $("#screen_slide1").owlCarousel({
 
            // Most important owl features
            item: 3,
            loop:true,
            margin:5,
            responsiveClass:true,
            responsive:{
                0:{
                    items:1,
                },
                460:{
                    items:2,
                },
                767:{
                    items:3,
                },
               

            },
            dots:true,
            nav:false,
            autoplay:true,
            rtl: true
        });
    
    
    
     $("#home_slide").owlCarousel({
                items: 1,
                loop: true,
                margin: 0,
                responsiveClass: true,
                nav: false,
                dots: true,
                smartSpeed: 500,
                autoplay: false,
                autoHeight:true,
                autoplayTimeout: 5000,
                autoplayHoverPause: true,
                // animateOut: 'fadeOut',
                // animateIn: 'fadeIn',
        })
    
    
    
    var leftArrow = $('.slider .fa-chevron-left'),
        rightArrow = $('.slider .fa-chevron-right');
    
    function checkclients() {
        
        $('.box-test:first').hasClass('active') ? leftArrow.fadeOut() : leftArrow.fadeIn();
        
        $('.box-test:last').hasClass('active') ? rightArrow.fadeOut() : rightArrow.fadeIn();

    }

    checkclients();
    
    $('.slider i').click(function () {
        
        if ($(this).hasClass('fa-chevron-right')) {
            
            $('.slider .active').fadeOut(1000, function () {
               
                $(this).removeClass('active').next('.box-test').addClass('active').fadeIn(1000);
                
                checkclients();
            });
            
        } else {
            
            $('.slider .active').fadeOut(1000, function () {
               
                $(this).removeClass('active').prev('.box-test').addClass('active').fadeIn(1000);
                
                checkclients();
            });
            
        }
        
        
    });
    
     $(".loading").fadeOut(1500, function () {
        
        $("body").css({
            
            position: "static",
            
            top: "auto",
            
            bottom: "auto",
            
            height: "auto"
            
        });
        
        $(this).parent().fadeOut(1500, function () {
            
            $(this).remove();
            
        });
    });

    

    
});
    
