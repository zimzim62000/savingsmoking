/**
 * requestAnimationFrame and cancel polyfill
 */
(function() {
    var lastTime = 0;
    var vendors = ['ms', 'moz', 'webkit', 'o'];
    for(var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
        window.requestAnimationFrame = window[vendors[x]+'RequestAnimationFrame'];
        window.cancelAnimationFrame =
            window[vendors[x]+'CancelAnimationFrame'] || window[vendors[x]+'CancelRequestAnimationFrame'];
    }

    if (!window.requestAnimationFrame)
        window.requestAnimationFrame = function(callback, element) {
            var currTime = new Date().getTime();
            var timeToCall = Math.max(0, 16 - (currTime - lastTime));
            var id = window.setTimeout(function() { callback(currTime + timeToCall); },
                timeToCall);
            lastTime = currTime + timeToCall;
            return id;
        };

    if (!window.cancelAnimationFrame)
        window.cancelAnimationFrame = function(id) {
            clearTimeout(id);
        };
}());


function HammerPage(element){

    "use strict";

    var _self = this;
    this.$element = $(element);
    this.dir = false;

    this.init = function(){

        $(window).on("load resize orientationchange", function() {
            _self.resizeContainer();
        });
    };

    this.resizeContainer = function(){
        this.hideMenu();
        this.menu_x = Math.floor(parseInt(this.$element.css('width').replace('px', '')) / 2);
        this.page_y = parseInt(this.$element.css('height').replace('px', ''));
        $('#menu').css('width', this.menu_x+'px');//@todo move that
    };

    this.animateMenu = function($element, deltaX, delay){
        if(delay !== 0){
            $element.addClass('animateMenu');
        }else{
            $element.removeClass('animateMenu');
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
    };

    function handleHammer(ev) {

        ev.gesture.preventDefault();
        var deltaX = Math.abs(ev.gesture.deltaX);

        switch(ev.type) {

            case 'dragleft':
                if(_self.dir === false){
                    _self.dir = 'left';
                }
                if(_self.menuVisible){
                    if(_self.menu_x >= deltaX ){
                        _self.animateMenu(_self.$element, (_self.menu_x - deltaX), 0);
                    }
                }
                break;

            case 'dragright':
                if(_self.dir === false){
                    _self.dir = 'right';
                }
                if(!_self.menuVisible){
                    if(_self.menu_x >= deltaX ){
                        _self.animateMenu(_self.$element, deltaX, 0);
                    }
                }
                break;

            case 'swipeleft':
                _self.hideMenu();
                ev.gesture.stopDetect();
                break;

            case 'swiperight':
                _self.showMenu();
                ev.gesture.stopDetect();
                break;

            case 'release':

                if(_self.dir == 'right' && !_self.menuVisible){
                    if(deltaX <= (_self.menu_x / 2 )){
                        _self.hideMenu();
                    }else{
                        _self.showMenu();
                    }
                }else if(_self.dir == 'left' && _self.menuVisible){
                    if(deltaX <= (_self.menu_x / 2 )){
                        _self.showMenu();
                    }else{
                        _self.hideMenu();
                    }
                }else{
                    _self.hideMenu();
                }

                _self.dir = false;
                break;
        }
    }

    var hammertime = new Hammer(this.$element[0], {
        drag: true,
        drag_block_horizontal: false,
        drag_block_vertical: false,
        drag_lock_to_axis: true,
        drag_max_touches: 1,
        drag_min_distance: 30,
        swipe: true,
        swipe_max_touches: 1,
        swipe_velocity: 0.7
    });
    hammertime.on("release dragleft dragright swipeleft swiperight", handleHammer);

    this.showMenu = function(){
        _self.animateMenu(_self.$element, _self.menu_x, 200);
        _self.menuVisible = true;
    };

    this.hideMenu = function(){
        _self.animateMenu(_self.$element, 0, 200);
        _self.menuVisible = false;
    };
}

$(document).ready(function(){

    var mypage = new HammerPage("#page");
    mypage.init();

    $('#icon-menu').click(function(){
        if(mypage.menuVisible === true){
            mypage.hideMenu();
        }else{
            mypage.showMenu();
        }
    });

});