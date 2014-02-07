(function($){

	"use strict";

    var $page = $('#page');
    var $menu = $('#menu');
    var $container = $('#container');
    var $menutop = $('#menutop');

    var menuVisible = false;
    var menu_x = Math.floor(parseInt($page.css('width').replace('px', '')) / 2);
    var page_y = parseInt($page.css('height').replace('px', ''));

    $menu.css('width', menu_x + 'px');
    //$container.css('min-height', page_y + 'px');
    //$page.css('position', 'absolute');

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
                if(e.gesture.deltaY < 150 && e.gesture.deltaY > 0){
                    animatePullTo(e.gesture.deltaY, 0);
                }
            }
        })
        .on('dragend', function(e){
            if(e.gesture.direction == 'down' ){
                animatePullTo(0, 200);
            }
            else{
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

        function animatePullTo(deltaY, delay)
        {
            if(delay !== 0){
                $page.addClass('animateMenu');
                $menutop.addClass('animateMenu');
            }else{
                $page.removeClass('animateMenu');
                $menutop.removeClass('animateMenu');
            }

            if(Modernizr.csstransforms3d) {
                $page.css("transform", "translate3d(0,"+ deltaY +"px,0) scale3d(1,1,1)");
                $menutop.css("transform", "translate3d(0,"+ deltaY +"px,0) scale3d(1,1,1)");
            }
            else if(Modernizr.csstransforms) {
                $page.css("transform", "translate(0,"+ deltaY +"px,)");
                $menutop.css("transform", "translate(0,"+ deltaY +"px,)");
            }
            else {
                var py = deltaY;
                $page.css("top", py+"px");
                $menutop.css("top", py+"px");
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