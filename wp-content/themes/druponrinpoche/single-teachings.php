<?php
/**
 * Category Template: Teachings
 */
$author = get_post_meta(get_the_ID(), 'Post Author', true);
$childOfCat = get_the_category();

$parentId = $childOfCat[0]->parent;
while ($parentId != 0) {
    $parentCat = get_category( $parentId );
    $parentId = $parentCat->parent;
}
?>

<?php get_header(); ?>
    <div class="section section-blog teachings_category">
        <div class="blog-columns clearfix">
            <div class="inner-page-container right">
                <div class="gutter">
                    <article class="single-post">
                        <div class="article-text">
                            <!--                            <a href="--><?php //?><!--">< Back</a>-->
                            <h2><?php the_title(); ?></h2>
                            <div class="post-info">
                                <?php if (!empty($author)): ?>
                                    <div class="post-author"><?php echo pll_e('By').' '.$author; ?></div>
                                <?php endif; ?>
                                <!--                            <p class="meta"><span class="meta-auth">--><?php //the_author(); ?><!--</span> <span class="meta-categ">--><?php //the_category(', '); ?><!--</span></p>-->
<!--                                <div class="post_date">--><?php //the_date(); ?><!--</div>-->
                                <div class="teaching_info"><?php echo get_post_meta(get_the_ID(), 'teaching_info', true); ?></div>
                            </div>

                            <?php the_content(); ?>

                            <!--                            <p class="tags">--><?php //the_tags(); ?><!--</p>-->
                        </div>

                        <?php

                        the_post_navigation( array(
                            'in_same_term'       => true,
//                            'next_text' =>  'Next Excerpt (%title)',
                            'next_text' =>  'Next',
//                            'prev_text' =>  'Previous Excerpt (%title)',
                            'prev_text' =>  'Previous',
                        ) );

                        ?>

                        <div class="padinate-page"><?php wp_link_pages(); ?></div>
                        <div class="comments">
                            <?php comments_template(); ?>
                        </div>
                    </article>
                </div>
            </div>
            <div class="sidebar-container left">
                <div class="teachings_cat_list">
                    <ul>
                        <?php echo wp_list_categories_teachings(array('title_li'=>'','child_of'=>$parentCat->term_id,'show_count'=>1)); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div> <!--  END section-blog  -->
<?php get_footer(); ?>