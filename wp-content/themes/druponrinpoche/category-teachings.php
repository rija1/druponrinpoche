
<?php
/**
 * Category Template: Teachings
 */

$childOfCat = get_queried_object();

while ($childOfCat->category_parent != 0) {
    $childOfCat = get_category( $childOfCat->category_parent );
}

$parentCat = get_category( get_queried_object()->category_parent );

$grandparentCatId = (!empty($parentCat->category_parent)) ? $parentCat->category_parent : 0 ;

$parentCatName = (!empty($parentCat->name)) ? $parentCat->name : '' ;
?>
<?php get_header(); ?>
<div class="section section-blog teachings_category">
    <div class="blog-columns clearfix">
        <div class="inner-page-container right">
            <h1><?php echo ($grandparentCatId!=0) ? $parentCat->name.' > ' : '' ;?><?php echo get_queried_object()->name;?></h1>
            <?php echo get_queried_object()->description;?>
            <?php get_template_part( 'content', 'teachings-posts' ); ?>
        </div>
        <div class="sidebar-container left">
        <!-- <div class="teachings-cat">Categories</div> -->
            <div class="teachings_cat_list">
            <ul>
                <?php echo wp_list_categories_teachings(array('title_li'=>'','child_of'=>$childOfCat->term_id)); ?>
            </ul>
            </div>
        </div>
    </div>
</div> <!--  END section-blog  -->
<?php get_footer(); ?>