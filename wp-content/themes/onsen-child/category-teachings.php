
<?php
/**
 * Category Template: Teachings
 */

$childOfCat = get_queried_object();

while ($childOfCat->category_parent != 0) {
    $childOfCat = get_category( $childOfCat->category_parent );
}
?>
<?php get_header(); ?>
<div class="section section-blog teachings_category">
    <div class="blog-columns clearfix">
        <div class="inner-page-container right">
            <div class="gutter">
                <h1><?php echo the_category(' - ');?></h1>
                <?php get_template_part( 'content', 'teachings-posts' ); ?>
            </div>
        </div>
        <div class="sidebar-container left">
            <div class="teachings_cat_list">
            <ul>
                <?php echo wp_list_categories_teachings(array('title_li'=>'','child_of'=>$childOfCat->term_id,'show_count'=>1)); ?>
            </ul>
            </div>
        </div>
    </div>
</div> <!--  END section-blog  -->
<?php get_footer(); ?>

<script type="text/javascript">
    jQuery( document ).ready(function() {
        var expandOffHtml ='<div class="expandContainer"><div id="expand" class="expandOff"></div></div>';
        var expandOnHtml ='<div class="expandContainer"><div id="expand" class="expandOn"></div></div>';
       // jQuery( '.sidebar-container li').not('.current_page_item').not('.current-cat-parent').prepend(expandOffHtml);
       // jQuery( '.sidebar-container .current-cat-parent').prepend(expandOnHtml);

        if (jQuery( '.sidebar-container .current-cat').find('ul.children')) {
         //   jQuery( '.sidebar-container .current-cat').prepend(expandOnHtml);
        }

        jQuery( ".expandContainer" ).click(function() {
            var expand = jQuery(this).find('#expand');
            if (expand.hasClass('expandOff')) {
                expand.removeClass('expandOff');
                expand.addClass('expandOn');
                jQuery(this).parent().find('ul.children').show();
            } else if (expand.hasClass('expandOn')) {
                expand.removeClass('expandOn');
                expand.addClass('expandOff');
                jQuery(this).parent().find('ul.children').hide();
            }



        });

    });
</script>