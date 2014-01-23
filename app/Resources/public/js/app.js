(function($){

	"use strict";

    var $page = $('#page');
    var $menu = $('#menu');
    var menuVisible = false;
    var swip = false;
    var menu_x = Math.floor(parseInt($page.css('width').replace('px', '')) / 2);
    $menu.css('width', menu_x + 'px');

    $page.hammer()
        .on('swiperight', function(e){
            if(menuVisible || swip){
                return;
            }
            swip = true;
            goToMax($page, 200);
            e.gesture.preventDefault();
        })
        .on('swipeleft', function(e){
            if(!menuVisible  || swip){
                return;
            }
            swip = true;
            goToMin($page, 200);
            e.gesture.preventDefault();
        })
        .on('drag', function(e){
            var deltaX = e.gesture.deltaX;
            if(deltaX > menu_x || deltaX < -menu_x ){
                return;
            }
            if(e.gesture.direction == "right" && !menuVisible){
                transformElement($page, deltaX, 0);
            }
            if(e.gesture.direction == "left" && menuVisible){
                transformElement($page, (menu_x - Math.abs(deltaX)), 0);
            }
        })
        .on('dragend', function(e){
            if(!swip){
                if(e.gesture.direction == 'right' && !menuVisible){
                    if(e.gesture.deltaX < ( menu_x/2)){
                        goToMin($page, 200);
                    }else{
                        goToMax($page, 200);
                    }
                }
                if(e.gesture.direction == 'left' && menuVisible){
                    if(Math.abs(e.gesture.deltaX) < (menu_x/2)){
                        goToMax($page, 200);
                    }else{
                        goToMin($page, 200);
                    }
                }
            }
        });

        function transformElement($element, deltaX, delay){
            if(Modernizr.csstransforms3d) {
                setTimeout(function(){
                    $element.css("transform", "translate3d("+ deltaX +" px,0,0) scale3d(1,1,1)");
                }, delay);

            }
            else if(Modernizr.csstransforms) {
                setTimeout(function(){
                    $element.css("transform", "translate("+ deltaX +" px,0)");
                }, delay);
            }
            else {
                setTimeout(function(){
                    var px = menu_x;
                    $element.css("left", px+"px");
                }, delay);
            }
        }

        function goToMax($element, delay){
            if(Modernizr.csstransforms3d) {
                $element.css("transform", "translate3d("+ menu_x +" px,0,0) scale3d(1,1,1)");
            }
            else if(Modernizr.csstransforms) {
                $element.css("transform", "translate("+ menu_x +" px,0)");
            }
            else {
                var px = menu_x;
                $element.css("left", px+"px");
            }
            menuVisible = true;
            swip = false;
        }

        function goToMin($element, delay){
            if(Modernizr.csstransforms3d) {
                $element.css("transform", "translate3d("+ 0 +" px,0,0) scale3d(1,1,1)");
            }
            else if(Modernizr.csstransforms) {
                $element.css("transform", "translate("+ 0 +" px,0)");
            }
            else {
                var px = 0;
                $element.css("left", px+"px");
            }
            menuVisible = false;
            swip = false;
        }

})(jQuery);