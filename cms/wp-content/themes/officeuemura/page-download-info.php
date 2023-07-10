<?php get_header(); ?>
<!-- page.php -->
<div id="vi">
  <div class="pagetitle"><?php the_title(); ?></div>
</div>

<div id="mainContainer">
  <div id="contents">
    <!-- #contents -->
    <?php the_content(); ?>
    <?php if (is_user_logged_in()) : ?>
      <?php
      $page_id = get_page_by_path("download");
      ?>
      <?php if (have_rows('info', $page_id)) : ?>
        <secton id="info">
          <h2 class="title-b">法改正・行政資料等</h2>
          <div class="download">
            <?php while (have_rows('info', $page_id)) : the_row(); ?>
              <section>
                <h3><a href="<?php the_sub_field('file'); ?>" target="_blank"><?php the_sub_field('name'); ?><img src="/cms/wp-content/themes/officeuemura/img/icon_<?php the_sub_field('type'); ?>.png" class="icon" alt="<?php the_sub_field('type'); ?>"></a></h3>
                <p><?php the_sub_field('caption'); ?></p>
              </section>
            <?php endwhile; ?>
          </div>
        </secton>
      <?php endif; ?>
    <?php endif; ?>
  </div>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>