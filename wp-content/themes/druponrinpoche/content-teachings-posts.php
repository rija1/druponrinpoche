<?php
/**
 *
 * @package Onsen
 */
?>
<div class="section section-blog">
    <div class="posts-grid">
        <!--				<div class="gutter">-->
        <?php while (have_posts()) : the_post(); ?>
        <!-- <a class="category-post-title" href="<?php the_permalink() ?>"> -->
            <article class="article-blog">
                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <div class="article-text">
                        <?php
                        $readMore = get_post_meta(get_the_ID(), 'read_more', TRUE);
                        ?>
                        <div class="teaching_text <?php echo (!empty($readMore)) ? ' read-more' : '' ; echo (isPostTibetan()) ? ' tibetan' : '' ; ?>"><?php the_content(); ?></div>
                        <span class="teaching_title"><?php the_time( get_option( 'date_format' ) ); ?></span>
                        <?php if(get_the_post_thumbnail_url()): ?>
                        <a href="<?php echo get_the_post_thumbnail_url(null,array(600,800)); ?>" class="swipebox">
                            <img src="<?php echo get_the_post_thumbnail_url(); ?>" />
                        <!-- <?php echo get_the_post_thumbnail( null, array( 110, 110,true),array('class'=>'teaching-img')); ?> -->
                        </a>
                        <?php endif; ?>
                        <!--								<a class="button" href="--><?php //the_permalink() ?><!--">--><?php //_e( 'Learn More', 'dkr' ); ?><!--</a>-->
                    </div>

                </div>
            </article>
        <!-- </a> -->
        <?php endwhile; ?>
        <?php
            the_posts_pagination( array(
                'mid_size'  => 1,
                // 'show_all' => true,
                'prev_text' => json_decode('"\uF053"'),
                'next_text' => json_decode('"\uF054"'),
            ) );
            ?>
<!--            --><?php //if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
<!--                <span class="left button-gray">--><?php //next_posts_link(__('Previous Posts', 'dkr')) ?><!--</span>-->
<!--                <span class="right button-gray">--><?php //previous_posts_link(__('Next posts', 'dkr')) ?><!--</span>-->
<!--            --><?php //} ?>
        <!--				</div>-->
    </div>
</div> <!--  END section-blog  -->

<script type="text/javascript">
    (function (jQuery) {
        jQuery.fn.readmore = function (settings) {
    var defaults = {
      abridged_height: '8em',
      ellipses: '<div class="readm-continue">&#8230;</div>',
      more_link: '<a class="readm-more">全文</a>',
      inner_wrapper: '<div class="readm-inner" />',
      inner_clzz: 'readm-inner',
      more_clzz: 'readm-more',
      ellipse_clzz: 'readm-continue'
    };

    var opts = jQuery.extend({}, defaults, settings);

    this.each(function() {
      var $this = jQuery(this);
      $this
        .wrapInner(opts.inner_wrapper)
        .append(opts.ellipses)
        .append(opts.more_link);
      $this.find('.' + opts.inner_clzz)
        .css('overflow', 'hidden')
        .height(opts.abridged_height);
      
      $this.find('.' + opts.more_clzz).click(function() {
        slideDown($this.find('.' + opts.inner_clzz));
        $this.find('.' + opts.ellipse_clzz).hide();
        $this.find('.' + opts.more_clzz).hide();
      });
    });
      
    function slideDown(elem) {
      var old_height = elem.height();
      elem.height('auto');
      var new_height = elem.height();  
      elem.height(old_height);
      elem.animate({'height': new_height});
    }
    return this;
  };
})(jQuery);


jQuery('.read-more').readmore({abridged_height: '8em'});

</script>