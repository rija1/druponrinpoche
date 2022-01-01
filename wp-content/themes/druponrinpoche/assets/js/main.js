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

		jQuery('.mob-menu-icon').click(function(e){
			e.preventDefault();
			var isMobMenuHidden = jQuery('#menu-top-mob').is(":hidden");
			if (isMobMenuHidden) {
			jQuery('#menu-top-mob').slideDown();
			} else {
			jQuery('#menu-top-mob').slideUp();
			}
		});

		jQuery('.menu-arrow').click(function(e){
			e.preventDefault();
			var isMobSubmenuHidden = jQuery(this).parent().parent().children('.sub-menu').is(":hidden");
			if (isMobSubmenuHidden) {
				jQuery(this).parent().parent().children('.sub-menu').slideDown(200);
			} else {
				jQuery(this).parent().parent().children('.sub-menu').slideUp();
			}
		});

	}); // Final load
	
}); // Final ready

jQuery(document).ready(function(){

    // menu drop-down
    jQuery('a.expand_link').each(function(){
        jQuery(this).click(function(e) {
            var contentEl = jQuery(this).parent().find('p.expand_content');
            if(contentEl.css('display') == 'none') {
                contentEl.css('display','block');
                jQuery(this).html('Less');
            } else {
                contentEl.css('display','none');
                jQuery(this).html('More');
            }
        })
    });

    }); // Final ready
