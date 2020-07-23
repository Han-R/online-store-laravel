$(document).ready(function () {
    
    
    var rtl = false;
    if ($("html").attr("lang") == 'ar') {
         rtl = true;
    }

    $('.cIn-remove').click(function () {
        $(this).parent().remove();
    })

    
    
    $(document).on('click', '.dropdown.filter_pro', function (e) {
        e.stopPropagation();
    });
    $(".btn_filter_action").click(function () {
        $(this).parent().parent().removeClass('open');
    });
    
     $(".hamburger").click(function () {
        $("body,html").addClass('menu-toggle');
        $(".hamburger").addClass('active');
    });
    $(".m-overlay").click(function () {
        $("body,html").removeClass('menu-toggle');
        $(".hamburger").removeClass('active');
    });
    
    
    
	var owl = $('#homeSlider');

        owl.on('initialized.owl.carousel change.owl.carousel',function(elem){
            var current = elem.item.index;
            $(elem.target).find(".owl-item").eq(current).find(".to-animate").removeClass('fadeInUp animated');
        });
       
        owl.on('initialized.owl.carousel changed.owl.carousel',function(elem){
            window.setTimeout(function () {
                var current = elem.item.index;
                $(elem.target).find(".owl-item").eq(current).find(".to-animate").addClass('fadeInUp animated');
            }, 400);
        });
    
	    owl.owlCarousel({
	            items: 1,
	            loop: true,
                rtl: true,
	            margin: 0,
	            responsiveClass: true,
	            nav: true,
	            dots: true,
	            smartSpeed: 500,
	            autoplay: true,
	            autoplayTimeout: 5000,
	            autoplayHoverPause: true,
	            navText:['<span><img src="images/arrow-right.svg"></span>','<span><img src="images/arrow-right.svg"></span>'],
	    });
    
        $("#client-slider").owlCarousel({
 
            // Most important owl features
            loop:true,
            rtl: true,
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
            autoplay:false
        })


     /*Decrease & Increase*/    
var minimum_quanitiy=$(".jsQuantityDecrease").attr("minimum"),
productQuantity=minimum_quanitiy;
$(document).on("click",".jsQuantityDecrease",function () {
    var quantity = $(this).parent().find('input[name="count-quat1"]').val();
    quantity = quantity * 1;
    var newQuantity = quantity - 1;
    $(this).parent().find('input[name="count-quat1"]').val(newQuantity);
    if (newQuantity <2) {
        $(this).parent().find(".jsQuantityDecrease").addClass("disabled");
    } else{
         $(this).parent().find(".jsQuantityDecrease").removeClass("disabled");
    }
}),

$(document).on("click",".jsQuantityIncrease",function () {
    var quantity = $(this).parent().find('input[name="count-quat1"]').val();
    quantity = quantity * 1;
    var newQuantity = quantity + 1;
    $(this).parent().find('input[name="count-quat1"]').val(newQuantity);
    if (newQuantity >=2) {
        $(this).parent().find(".jsQuantityDecrease").removeClass("disabled");
    } else{
         $(this).parent().find(".jsQuantityDecrease").addClass("disabled");
    }
    
})   
    
        
/*upload image*/
        var readURL2 = function(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.up-img-pic').attr('src', e.target.result);
                }
        
                reader.readAsDataURL(input.files[0]);
            }
        }
        

        $("#up--file").on('change', function () {
            readURL2(this);
        });

         /*upload image*/
        var readURL1 = function(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.up-img-pic1').attr('src', e.target.result);
                }
        
                reader.readAsDataURL(input.files[0]);
            }
        }
        

        $("#up--file1").on('change', function () {
            readURL1(this);
        });

         /*upload image*/
        var readURL2 = function(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.up-img-pic2').attr('src', e.target.result);
                }
        
                reader.readAsDataURL(input.files[0]);
            }
        }

    /*slider owl carousel*/
        
    $('#slider .owl-carousel').owlCarousel({
    loop:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:1
        }
    }
 }); 
    
    $('#offers .owl-carousel').owlCarousel({
    loop:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:1
        }
    }
 }); 
    
    $('#viewers .owl-carousel').owlCarousel({
    center: true,
    loop: true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:3
        }
    }
 }); 
    
    $('#recommend .owl-carousel').owlCarousel({
    center: true,
    loop: true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:3
        }
    }
 }); 
    
    $('#topCosmetics .owl-carousel').owlCarousel({
    center: true,
    loop: true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:3
        }
    }
 }); 
   
    $('#TopElectronic .owl-carousel').owlCarousel({
    loop:true,
    responsive:{
        0:{
            items:1
        },
        
        600:{
            items:4
        },
        
        100:{
            items:2
        }
    }
});
    
    
    
    /*Counter*/
    
     $('.count').prop('disabled', true);
   			$(document).on('click','.plus',function(){
				$('.count').val(parseInt($('.count').val()) + 1 );
    		});
        	$(document).on('click','.minus',function(){
    			$('.count').val(parseInt($('.count').val()) - 1 );
    				if ($('.count').val() == 0) {
						$('.count').val(1);
					}
    	   });
    
    function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url('+e.target.result +')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
        }
        }
        $("#imageUpload").change(function() {
            readURL(this);
        });
});



