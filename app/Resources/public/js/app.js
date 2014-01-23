(function($){

	"use strict";

    var $page = $('#page');
    var $menu = $('#menu');
    var menuVisible = false;
    var menu_x = Math.floor(parseInt($page.css('width').replace('px', '')) / 2);
    $menu.css('width', menu_x + 'px');

    $page.hammer()
        .on('swiperight', function(e){
            showMenu();
            e.gesture.stopDetect();
        })
        .on('swipeleft', function(e){
            hideMenu();
            e.gesture.stopDetect();
        })
        .on('drag', function(e){
            $page.removeClass('animateMenu');
            var deltaX = e.gesture.deltaX;

            if(deltaX > menu_x || deltaX < -menu_x ){
                return;
            }
            if(e.gesture.direction == "right" && !menuVisible){
                animateMenu($page, deltaX, 0);
            }
            if(e.gesture.direction == "left" && menuVisible){
                animateMenu($page, (menu_x - Math.abs(deltaX)), 0);
            }
            if(e.gesture.direction == "down" ){
                console.log('pull to refresh ');
            }
        })
        .on('dragend', function(e){
            if(Math.abs(e.gesture.deltaX) > menu_x/2) {
                if(e.gesture.direction == 'right') {
                    showMenu();
                } else if(e.gesture.direction == 'left'){
                    hideMenu();
                }
            }else{
                if(e.gesture.direction == 'right' && !menuVisible) {
                    hideMenu();
                } else if(e.gesture.direction == 'left' && menuVisible){
                    showMenu();
                }
            }
        });

        function showMenu(){
            animateMenu($page, menu_x, 200);
            menuVisible = true;
        }

        function hideMenu(){
            animateMenu($page, 0, 200);
            menuVisible = false;
        }

        function animateMenu($element, deltaX, delay)
        {
            if(delay !== 0){
                $element.removeClass('animateMenu');
                $element.addClass('animateMenu');
            }

            if(Modernizr.csstransforms3d) {
                $element.css("transform", "translate3d("+ deltaX +"px,0,0) scale3d(1,1,1)");
            }
            else if(Modernizr.csstransforms) {
                $element.css("transform", "translate("+ deltaX +"px,0)");
            }
            else {
                var px = deltaX;
                $element.css("left", px+"px");
            }
        }

        $(document).ready(function(){

            $('div.icon-menu').on('click', function(){
                if(menuVisible === true){
                    hideMenu();
                }else{
                    showMenu();
                }
            });

        });

})(jQuery);