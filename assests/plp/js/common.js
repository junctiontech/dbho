$(window).scroll(function() {
        var scrollVal = $(this).scrollTop();
        if ($(this).scrollTop() > 70) {
                    $('.search-content').addClass('affix');
                } else {
                    $('.search-content').removeClass('affix');
                }
     
    });
 $(document).ready(function(){

if(typeof element !='undefined'){
     $(".selectpicker").chosen();
}            
var feedbackTab = {
    speed:300,
    containerWidth:$('.map-details-sliding').outerWidth(),
    containerHeight:$('.map-details-sliding').outerHeight(),
    tabWidth:$('.map-details-sliding').outerWidth(),
    init:function(){
        $('.map-details-sliding').css('height',feedbackTab.containerHeight + 'px');
        $('.map-view img,.arrow-sprt').click(function(event){
            if ($('.map-details-sliding').hasClass('open')) {
                $('.map-details-sliding')
                .animate({right:'-' + feedbackTab.containerWidth}, feedbackTab.speed)
                .removeClass('open');
                 $('.map-arrow-suuport .arrow-sprt').animate({right:'-' + feedbackTab.containerWidth}, feedbackTab.speed);
                $('.results-top .arrow-sprt').show();
            } else {
                $('.map-details-sliding')
                .animate({right:'1px'},  feedbackTab.speed)
                .addClass('open');
                $('.map-arrow-suuport .arrow-sprt').animate({right: feedbackTab.containerWidth},  feedbackTab.speed);
                $('.results-top .arrow-sprt').hide();
            }
            event.preventDefault();
        });
    }
};
feedbackTab.init();  
    $("#tab-map li a").click(function(e){
    e.preventDefault();
    $(this).tab('show');
    });
   

    });

$(document).ready(function(){	
if(typeof jQuery().bxSlider!='undefined') {
    $('.footer-link').bxSlider({
        minSlides: 1,
        maxSlides: 1,
        slideWidth: 1000,
        pager: false,
        infiniteLoop:false,
        hideControlOnEnd:true 
    });
}
      	// Initialize navgoco with default options
//        $(".menunav").navgoco({
//            caret: '<span class="caret"></span>',
//            accordion: false,
//            openClass: 'open',
//            save: true,
//            cookie: {
//                name: 'navgoco',
//                expires: false,
//                path: '/'
//            },
//            slide: {
//                duration: 300,
//                easing: 'swing'
//            }
//        });
$('.sticky-arrow').click(function () {
    if ($(this).hasClass('up')) {
        $(this).removeClass('up');
        $('.sticky-bottom .showpopup').removeClass('showpopup');
        $('.sticky-bottom').animate({
            bottom: "-40px"
        });
    } else {
        $(this).addClass('up');
        $('.sticky-bottom').animate({
            bottom: "0px"
        });
    }
});
$('.sticky-bottom .pop-trigger').click(function (){
     $(this).parent().siblings().removeClass('showpopup');
     $(this).parent().toggleClass('showpopup');
    $(".send_pop_up").removeClass("active").fadeOut();
});
    
         
$('.send-mail').click(function (){
    $('pop-container').addClass("showpopup");
    $(".send_pop_up").addClass("active").fadeIn();
    
});
     
     
    
if(typeof jQuery().enscroll!='undefined')   {
$('.pop_up .pop_bd').enscroll();
}
    
});
//Navigation Menu Slider
 $('#nav-expander').on('click',function(e){
    e.preventDefault();
    $('body').toggleClass('nav-expanded');
});
//common expand collaps section script
$(document).ready(function () {	
	$(document).on('click','.expandmenuitem',function() {
		var thisVar = $(this);
		if(typeof thisVar.attr("expandsection")!='undefined')
		{
			var expandmenusection = $(".expandmenusection[showsection='"+thisVar.attr("expandsection")+"']");	
			if(!expandmenusection.is(":visible"))
			{
				$(".expandmenusection").slideUp("fast");
				/*var left = ($(".drop-row").width() - thisVar.position().left)-thisVar.width() + 20;
				var top = thisVar.position().top + thisVar.outerHeight(true);
				expandmenusection.css({"top":top,"right":left});*/
				expandmenusection.slideDown();
				$(this).addClass("active");
			}
			else{
				$(this).removeClass("active");	
				$(".expandmenuitem").removeClass("active");
			}
		}
	});
	$(document).on('mouseup', function(e) {
		var expandmenusectionLength = $('.expandmenusection').length;
		var expandmenusectionVisibleLength = $('.expandmenusection:visible').length;
		if (expandmenusectionLength>0 && expandmenusectionVisibleLength>0 && expandmenusectionLength!=expandmenusectionVisibleLength)
		{
			if (!$(e.target).parents().hasClass('expandmenusection')) {
				$('.expandmenusection').slideUp("fast");
				$(".expandmenuitem").removeClass("active");
			}
		}
	});
    $.fn.placeholder();
});	

(function($) {
          $.fn.placeholder = function() {
            if(typeof document.createElement("input").placeholder == 'undefined') {
              $('[placeholder]').focus(function() {
                var input = $(this);
                if (input.val() == input.attr('placeholder')) {
                  input.val('');
                  input.removeClass('placeholder');
                }
              }).blur(function() {
                var input = $(this);
                if (input.val() == '' || input.val() == input.attr('placeholder')) {
                  input.addClass('placeholder');
                  input.val(input.attr('placeholder'));
                }
              }).blur().parents('form').submit(function() {
                $(this).find('[placeholder]').each(function() {
                  var input = $(this);
                  if (input.val() == input.attr('placeholder')) {
                    input.val('');
                  }
              })
            });
          }
        }
        })(jQuery);

