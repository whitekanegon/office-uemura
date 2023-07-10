<?php
/**
 * Template Name: コンテンツ見出しなし
 */
?>

<?php get_header(); ?>
<!-- page.php -->
<div id="vi">
  <div class="pagetitle"><?php the_title(); ?></div>
</div>

<div id="mainContainer">
  <div id="contents">
    <!-- #contents -->
    <?php the_content(); ?>
    </div>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
