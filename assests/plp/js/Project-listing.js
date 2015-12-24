 $(document).ready(function(){
    $(".selectpicker").chosen();
     $("#sticky_item").stick_in_parent({offset_top: 50});
     $('.drp-budjet .drop-listing').bind('click', function()
        {
            $(".budget-menu-slide").slideToggle();
        });
     
    
     /*---select---box___*/
     
     
     var ulSelect = function($select) {
    
    // $select.hide();
    var $opts = $select.find('option');
    
    return (function() {
        var items = '',
            html = '';
        $opts.each(function() {
            items += '<li><a href="#" class="item"> <span class="icon rs"> </span>' + $(this).text() + '</a></li>';
        });
        html = 
            '<ul class="menu-select">'+ 
                '<li class="sub">'+
            '<a class="seletion-box drop-listing sprite-af" href="#">'+ $opts.filter(':selected').text() +'</a>' +
                    '<ul>' + items + '</ul>'+
                '</li>'+
            '</ul>';
        $(html)
            .find('.sub a')
            .click(function(e) {
                e.preventDefault();
                var $this = $(this);
                $this.parents('.menu-select').find('.seletion-box').text($this.text());
                $opts.eq($this.parent().index()).prop('selected', true);
            }).end().insertAfter($select);
    }());

};

ulSelect($('#min-value'));
ulSelect($('#max-value'));
  
     $('.seletion-box').click(function(event){
       $(this).next('ul').slideToggle();
     });     
     $('.bedroom-slide').click(function(event){
        event.stopPropagation();
         $(".bed-room-drop").slideToggle("fast");
         $(".drop-down-more").hide();
         $('.budget-menu-slide').hide()
    });
     
    $('.more-slide').click(function(event){
        event.stopPropagation();
         $(".drop-down-more").slideToggle("fast");
        $(".bed-room-drop").hide();
    });
    $(".drop-down-more,.bed-room-drop").on("click", function (event) {
        event.stopPropagation();
    });
     
     
 });
    
    
    
   $(document).on("click", function () {
    $(".bed-room-drop").hide();
    $(".drop-down-more").hide();
    $('.budget-menu-slide').show();     
    
});