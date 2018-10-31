jQuery(document).ready(function(){
	
	jQuery(window).load(function() {
		
		// menu drop-down
		jQuery('.menu-top li').hover(function(){
			jQuery(this).children('a').addClass('hover');
			jQuery(this).children('.sub-menu').stop().slideDown(200);
		}, function(){
			jQuery(this).children('a').removeClass('hover');
			jQuery(this).children('.sub-menu').stop().slideUp(200);
		});
		jQuery('.menu-top li').hover(function(){
			jQuery(this).children('a').addClass('hover');
			jQuery(this).children('.children').stop().slideDown(200);
		}, function(){
			jQuery(this).children('a').removeClass('hover');
			jQuery(this).children('.children').stop().slideUp(200);
		});		
		jQuery('.menu-top-mob-container .icon-menu').click(function(e) {
			e.preventDefault();
		}).toggle(function(){
			jQuery(this).parent('.menu-top-mob-container').children('.menu-top-mob').stop().slideDown(200);
		}, function(){
			jQuery(this).parent('.menu-top-mob-container').children('.menu-top-mob').stop().slideUp(200);
		});
		
		// owl-carousel
		jQuery(".welcome-carousel").owlCarousel({
			// Most important owl features
			itemsTabletSmall: true,
			singleItem : true,
			itemsScaleUp : true,
			//Basic Speeds
			paginationSpeed : 800,
			rewindSpeed : 1000,
			//Autoplay
			stopOnHover : true,
			// Navigation
			navigation : true,
			navigationText : ["",""],
			rewindNav : true,
			scrollPerPage : false,
			//Pagination
			pagination : true,
			paginationNumbers: false,
			// Responsive
			responsive: true,
			responsiveRefreshRate : 100,
			responsiveBaseWidth: window,
			// CSS Styles
			baseClass : "owl-carousel",
			theme : "owl-theme",
			//Lazy load
			lazyLoad : false,
			lazyFollow : true,
			lazyEffect : "fade",
			//Auto height
			autoHeight : true,
			//JSON
			jsonPath : false,
			jsonSuccess : false,
			//Mouse Events
			dragBeforeAnimFinish : true,
			mouseDrag : true,
			touchDrag : true,
			//Transitions
			transitionStyle : "fade", // "fade", "backSlide", "goDown" and "fadeUp"
			// Other
			addClassActive : true
		});
		
		// input focus
		jQuery(".searchform #s").focus(function(){
			var value = jQuery(this).attr("value");
			if (value == "")
			var attrfor = jQuery(this).attr('id');
			jQuery("label[for=" + attrfor + "]").css({"display":"none"});
		});
		jQuery(".searchform #s").blur(function(){
			var value = jQuery(this).attr("value");
			if (value == "")
			var attrfor = jQuery(this).attr('id');
			jQuery("label[for=" + attrfor + "]").css({"display":"block"});
		});
		
		// article-image hover
		jQuery('.article-image').hover(function(){
			jQuery(this).addClass('hover');
			jQuery(this).children('.overlay').stop().fadeIn(300);
		}, function(){
			jQuery(this).removeClass('hover');
			jQuery(this).children('.overlay').stop().fadeOut(300);
		});
		
		// some css fix
		jQuery('.top-bar li:first-child, .social li:first-child, .menu-top-container .menu-top li:first-child, .menu-top-mob li:first-child, .menu-filter li:first-child, .widget-blog li:first-child, .widget-contact li:first-child, .article-image .overlay .fa:first-child, .articles-columns .column-3-12:first-child, .articles-columns .column-4-12:first-child').addClass('first-child');
		jQuery('.top-bar li:last-child, .social li:last-child, .menu-top-container .menu-top li:last-child, .menu-top-mob li:last-child, .menu-filter li:last-child, .widget-blog li:last-child, .widget-contact li:last-child, .article-image .overlay .fa:last-child, .articles-columns .column-3-12:last-child, .articles-columns .column-4-12:last-child, .contact-widgets-container .contact-widget-block:last-child, .meta span:last-child, .widget-programs .article-prog:last-child, .widget-comments li:last-child, .sidebar-container .widget:last-child').addClass('last-child');
		jQuery('#searchsubmit').attr({"value":""});
		
	}); // Final load
	
}); // Final ready