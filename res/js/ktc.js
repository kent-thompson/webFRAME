// Kent Thompson Consulting - Copyright (c) 2007-2023
var gRFade = false;
var gAniCount = 0;
$(document).ready(function() {
	jQuery('.stickybox').stickyfloat();
	$('#up-arrow').stickyfloat('update',{ duration:0 });
	//krcol();
	krcol();
	ksize();
	kbalance();
});	

$(window).on("load", function(e){
	if( ! sessionStorage.ran ) {
		//$("#rev-notice").show();
		//$("#rev-notice").delay(10000).fadeOut(1000, function() {
			//$("#rev-notice").css('display','none');
		//});
		// sessionStorage.ran = "true";
	}
	var w = $(window).outerWidth();
	if( $(window).width() > 481 ) {
		//
	} else {
		ksize();
	}
	$('.flexslider').flexslider({
		animation:"fade",
		slideshowSpeed:5000,
		//animationSpeed:400,
		controlNav:false,
		slideshow:true,
		initDelay:2000,
		before: function(slider) {
			//slider.resize();
		}
	});
	$('.stickybox').stickyfloat('update',{ duration:0 });

	krcol();
	ksize();
	kbalance();
	//kbalance();
});

function runlogo( txt ) {
	/*localStorage.setItem("plogotext", txt);
	gAniCount += 1;*/
}

$(function(){
    $('.menuitem').on('mouseenter', function(){
	    //$(this).css("display", "none");
		$(this).fadeTo("fast", 0.6);
		$(this).css("display", "");
		$(this).fadeTo("10", 1.0);	
    }); 
});

/*
$(function(){
	$('.menuitem')
		.css( {backgroundPosition: "0 0" } )
		.mouseover(function(){
			$(this).stop().animate({backgroundPosition:'0px 60px'}, {duration:250});
		})
		.mouseout(function(){
			$(this).stop().animate({backgroundPosition:'0px 0px'}, {duration:250});
		})
});	
*/
$(function(){
    $('#up-arrow').click(function() {
		//scroll(0,0);
        var top = document.getElementById('lone').offsetTop; //Getting Y of target element
        window.scrollTo(0, top);            	
        
    });
});

function kbalance() {
	var w = $(window).outerWidth();
	//console.log( w );
	if( w <= 479 ) {
		$('.stickybox').stickyfloat('update',{ duration:0 });
		$('.sidebar').removeClass( 'stickybox' );
		
		var h = $('.sidebar').outerHeight(true);
		$('.col-left').css( 'height', h + 'px' );
		
		var cht = parseInt( $('.col-center p:last').position().top + $('.col-center p:last').outerHeight(true) , 10 );

		$('.wrapper').css( 'height', (cht + h + $('#up-arrow').height()) + 'px' );
		return;
	} 
	if( ! $('.sidebar').hasClass('stickybox') ) {
		$('.sidebar').addClass( 'stickybox' );
	}
	$('.stickybox').stickyfloat('update',{ duration:0 });
	var lht = $('#smenu').outerHeight(true) + $('#skeybox').outerHeight(true);
	var cht = parseInt( $('.col-center p:last').position().top + $('.col-center p:last').height(), 10 );
	if( lht <= cht ) {
		$('.col-left').css( 'height', cht + 'px' );
		$('.wrapper').css( 'height', (cht + 10) + 'px' );
	} else {
		$('.col-left').css( 'height', lht + 'px' );
		$('.col-center').css( 'height', lht + 'px' );
		$('.wrapper').css( 'height', (lht + 10) + 'px' );
	}
	if( $('#cpp_logo').height() + lht > cht ) {
		$('#cpp_logo').hide();
	}
}

function ksize() {
	var h = Number( $('#ilogo').outerHeight() );
	$('#plogo').height( h );
	$('.header').height( h );
}

function krcol() {
	var ww = $(window).outerWidth();
	var cw = ww - $('.col-left').outerWidth();
	$('.sidebox').show(); // todo
	$('.col-left').css('position','static');
	$('.col-left').css('float','left');
	var rw = (cw / ww) * 100;
	var t;
	if( ww >= 1184 ) {
		t = 1;
	} else if( ww <= 1183 && ww >= 599 ) {
		t = 2;
	} else if( ww <= 596 && ww >= 559 ) {
		t = 3;
	} else if( ww <= 558 && ww >= 518 ) {
		t = 5;
	} else if( ww <= 517 && ww >= 481 ) {
		t = 6;
	} else if( ww <= 479 ) {
		t = 0;
		rw = 96;
		$('.sidebox').hide();
		$('.col-left').css('clear', 'both');
		$('.col-left').css('position','relative');
		$('#lone').css("left", Math.max(0, (($(window).width() - $($('.col-left')).outerWidth()) / 2) + $(window).scrollLeft()) + "px");
	}
	rw -= t;
	$('.col-center').css( 'width', rw + '%' );
	var tw = $('.col-left').outerWidth() + $('.col-center').outerWidth() + 5;
	if( ww <= 479 ) {
		tw = $('.col-center').outerWidth();
	}
	$('#plogo').css( 'width', tw + 'px' );
}

$(window).resize(function(){
	krcol();
	ksize();
	kbalance();
});
