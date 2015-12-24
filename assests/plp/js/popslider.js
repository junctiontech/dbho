var sync1 = $("#sync1");
var sync2 = $("#sync2");
 
          sync1.owlCarousel({
            singleItem : true,
            slideSpeed : 1000,
            navigation: true,
            pagination:false,
            navigationText : [""],
            afterAction : syncPosition,
            responsiveRefreshRate : 200,
          });
         
          sync2.owlCarousel({
            items : 8,
            itemsDesktop      : [1199,8],
            itemsDesktopSmall     : [979,6],
            pagination:false,
            navigation: true,
            navigationText : [""],
            responsiveRefreshRate : 100,
            afterInit : function(el){
              el.find(".owl-item").eq(0).addClass("synced");
            }
          });
 
  function syncPosition(el){
    var current = this.currentItem;
    $("#sync2")
      .find(".owl-item")
      .removeClass("synced")
      .eq(current)
      .addClass("synced")
    if($("#sync2").data("owlCarousel") !== undefined){
      center(current)
    }
  }
 
  $("#sync2").on("click", ".owl-item", function(e){
    e.preventDefault();
    var number = $(this).data("owlItem");
    sync1.trigger("owl.goTo",number);
  });
 
  function center(number){
    var sync2visible = sync2.data("owlCarousel").owl.visibleItems;
    var num = number;
    var found = false;
    for(var i in sync2visible){
      if(num === sync2visible[i]){
        var found = true;
      }
    }
 
    if(found===false){
      if(num>sync2visible[sync2visible.length-1]){
        sync2.trigger("owl.goTo", num - sync2visible.length+2)
      }else{
        if(num - 1 === -1){
          num = 0;
        }
        sync2.trigger("owl.goTo", num);
      }
    } else if(num === sync2visible[sync2visible.length-1]){
      sync2.trigger("owl.goTo", sync2visible[1])
    } else if(num === sync2visible[0]){
      sync2.trigger("owl.goTo", num-1)
    }
    
  }

var sync3 = $("#sync3");
var sync4 = $("#sync4");
 
          sync3.owlCarousel({
            singleItem : true,
            slideSpeed : 1000,
            navigation: true,
            pagination:false,
            navigationText : [""],
            afterAction : syncPositionTwo,
            responsiveRefreshRate : 200,
          });
         
          sync4.owlCarousel({
            items : 8,
            itemsDesktop      : [1199,8],
            itemsDesktopSmall     : [979,6],
            pagination:false,
            navigation: true,
            navigationText : [""],
            responsiveRefreshRate : 100,
            afterInit : function(el){
              el.find(".owl-item").eq(0).addClass("synced");
            }
          });
 
  function syncPositionTwo(el){
    var current = this.currentItem;
    $("#sync4")
      .find(".owl-item")
      .removeClass("synced")
      .eq(current)
      .addClass("synced")
    if($("#sync4").data("owlCarousel") !== undefined){
      centerTwo(current)
    }
  }
 
  $("#sync4").on("click", ".owl-item", function(e){
    e.preventDefault();
    var number = $(this).data("owlItem");
    sync3.trigger("owl.goTo",number);
  });
 
  function centerTwo(number){
    var sync4visible = sync4.data("owlCarousel").owl.visibleItems;
    var num = number;
    var found = false;
    for(var i in sync4visible){
      if(num === sync4visible[i]){
        var found = true;
      }
    }
 
    if(found===false){
      if(num>sync4visible[sync4visible.length-1]){
        sync4.trigger("owl.goTo", num - sync4visible.length+2)
      }else{
        if(num - 1 === -1){
          num = 0;
        }
        sync4.trigger("owl.goTo", num);
      }
    } else if(num === sync4visible[sync4visible.length-1]){
      sync4.trigger("owl.goTo", sync4visible[1])
    } else if(num === sync4visible[0]){
      sync4.trigger("owl.goTo", num-1)
    }
    
  }

  var sync5 = $("#sync5");
var sync6 = $("#sync6");
 
          sync5.owlCarousel({
            singleItem : true,
            slideSpeed : 1000,
            navigation: true,
            pagination:false,
            navigationText : [""],
            afterAction : syncPositionThree,
            responsiveRefreshRate : 200,
          });
         
          sync6.owlCarousel({
            items : 8,
            itemsDesktop      : [1199,8],
            itemsDesktopSmall     : [979,6],
            pagination:false,
            navigation: true,
            navigationText : [""],
            responsiveRefreshRate : 100,
            afterInit : function(el){
              el.find(".owl-item").eq(0).addClass("synced");
            }
          });
 
  function syncPositionThree(el){
    var current = this.currentItem;
    $("#sync6")
      .find(".owl-item")
      .removeClass("synced")
      .eq(current)
      .addClass("synced")
    if($("#sync6").data("owlCarousel") !== undefined){
      centerThree(current)
    }
  }
 
  $("#sync6").on("click", ".owl-item", function(e){
    e.preventDefault();
    var number = $(this).data("owlItem");
    sync5.trigger("owl.goTo",number);
  });
 
  function centerThree(number){
    var sync6visible = sync6.data("owlCarousel").owl.visibleItems;
    var num = number;
    var found = false;
    for(var i in sync6visible){
      if(num === sync6visible[i]){
        var found = true;
      }
    }
 
    if(found===false){
      if(num>sync6visible[sync6visible.length-1]){
        sync6.trigger("owl.goTo", num - sync6visible.length+2)
      }else{
        if(num - 1 === -1){
          num = 0;
        }
        sync6.trigger("owl.goTo", num);
      }
    } else if(num === sync6visible[sync6visible.length-1]){
      sync6.trigger("owl.goTo", sync6visible[1])
    } else if(num === sync6visible[0]){
      sync6.trigger("owl.goTo", num-1)
    }
    
  }

var floorsync1 = $("#floor-sync1");
var floorsync2 = $("#floor-sync2");
 
          floorsync1.owlCarousel({
            singleItem : true,
            slideSpeed : 1000,
            navigation: true,
            pagination:false,
            navigationText : [""],
            afterAction : syncPosition,
            responsiveRefreshRate : 200,
          });
         
          floorsync2.owlCarousel({
            items : 8,
            itemsDesktop      : [1199,8],
            itemsDesktopSmall     : [979,6],
            pagination:false,
            navigation: true,
            navigationText : [""],
            responsiveRefreshRate : 100,
            afterInit : function(el){
              el.find(".owl-item").eq(0).addClass("synced");
            }
          });
 
  function syncPosition(el){
    var current = this.currentItem;
    $("#floor-sync2")
      .find(".owl-item")
      .removeClass("synced")
      .eq(current)
      .addClass("synced")
    if($("#floor-sync2").data("owlCarousel") !== undefined){
      center(current)
    }
  }
 
  $("#floor-sync2").on("click", ".owl-item", function(e){
    e.preventDefault();
    var number = $(this).data("owlItem");
    sync1.trigger("owl.goTo",number);
  });