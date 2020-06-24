$(function(e) {

	e( '#menu-primary li:has(ul)' ).doubleTapToGo();

      e(window).resize(function() {
        var h = e(window).height(),
            w = e(window).width();
			h = e("#header").outerHeight();
			i = e("#header img").outerHeight();

		if (i > h) {
			e("#header .bgimg, #header .wp-post-image").css({
				top: -(h  / 2),
			});
		}

		if (w > 769) {
			e("#primary").css({
				 display: 'block'
			});
			e("#examples").css({
				 display: 'block'
			});
			
			e( "body" ).removeClass( "mobile" );
		} else {
			e("#primary").css({
				display: 'none'
			});
			e("#examples").css({
				 display: 'none'
			});
			e( "body" ).addClass( "mobile" );
		}

	});
	e(window).resize();

    e(".toggler").on("click", function(){
        e(this)
        .toggleClass("expander expanded")
        .next().slideToggle(400);
    });
    e(".more_photo").on("click", function(){
        e(this)
        .toggleClass("open dicht")
        .next().slideToggle(400);
    });


$(".tticon").click(function(){
	var  ob = $(this);
	$(".tooltipContent").removeClass("active");
	$(ob).next().hasClass("open")?true:$(ob).next().addClass("active").addClass("open");
	$(".tooltipContent").each(function(i,e){
		if(!$(e).hasClass("active"))$(e).removeClass("open");
	})
});
  
/* Settings gaan hier, zoals:

    e(window).resize(function() {
        var h = e(window).height(),
            w = e(window).width();
		
        e("section").height(h);
		e(".slide").height(h);
		e(".slide").width(w);
		
		e(".slideshow").height(h);
        e(".project-list .project").height(h - 180);
        e(".project-list .project").width(w / 4);
        e(".primary").css({
        	top: (e(window).height() - e(".primary").outerHeight()) / 2
        });
		// full screen image cropping
		e('.crop, .info-crop').css({width: w + 20, height: h});
		e('.crop img, .info-crop img').css({
			'max-width': 'none',
			'left': 0,
			'top': 0
		});
		e('.crop img, .info-crop img').imagefill();
		e('.crop, .info-crop').css({
			'position': 'absolute'
		});
		// full screen image cropping
		e('.info-crop').css({width: w + 20, height: '100%'});
    });
*/
	
});
/*

Double Tap To Go

	By Osvaldas Valutis, www.osvaldas.info
	Available for use under the MIT License
*/

;(function(e,t,n,r){e.fn.doubleTapToGo=function(r){if(!("ontouchstart"in t)&&!navigator.msMaxTouchPoints&&!navigator.userAgent.toLowerCase().match(/windows phone os 7/i))return false;this.each(function(){var t=false;e(this).on("click",function(n){var r=e(this);if(r[0]!=t[0]){n.preventDefault();t=r}});e(n).on("click touchstart MSPointerDown",function(n){var r=true,i=e(n.target).parents();for(var s=0;s<i.length;s++)if(i[s]==t[0])r=false;if(r)t=false})});return this}})(jQuery,window,document);