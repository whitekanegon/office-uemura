<?php get_header(); ?>
<!-- page.php -->
<div id="vi">
  <div class="pagetitle"><?php the_title(); ?></div>
</div>

<div id="mainContainer">
  <div id="contents">
    <!-- #contents -->
    <?php the_content(); ?>
    <?php
    $page_id = get_the_ID();
    ?>
    <?php if (have_rows('shiryo', $page_id)) : ?>
      <secton id="shiryo">
        <h2 class="title-b">資料配布</h2>
        <div class="download">
          <?php while (have_rows('shiryo', $page_id)) : the_row(); ?>
            <section>
              <h3><a href="<?php the_sub_field('file'); ?>" target="_blank"><?php the_sub_field('name'); ?><img src="/cms/wp-content/themes/officeuemura/img/icon_<?php the_sub_field('type'); ?>.png" class="icon" alt="<?php the_sub_field('type'); ?>"></a></h3>
              <p><?php the_sub_field('caption'); ?></p>
            </section>
          <?php endwhile; ?>
        </div>
      </secton>
    <?php endif; ?>
    <?php if (have_rows('format', $page_id)) : ?>
      <secton id="shiryo">
        <h2 class="title-b">提出資料フォーマット</h2>
        <div class="download">
          <?php while (have_rows('format', $page_id)) : the_row(); ?>
            <section>
              <h3><a href="<?php the_sub_field('file'); ?>" target="_blank"><?php the_sub_field('name'); ?><img src="/cms/wp-content/themes/officeuemura/img/icon_<?php the_sub_field('type'); ?>.png" class="icon" alt="<?php the_sub_field('type'); ?>"></a></h3>
              <p><?php the_sub_field('caption'); ?></p>
            </section>
          <?php endwhile; ?>
        </div>
      </secton>
    <?php endif; ?>
    <?php if (have_rows('todokede', $page_id)) : ?>
      <secton id="shiryo">
        <h2 class="title-b">各種届出票</h2>
        <div class="download">
          <?php while (have_rows('todokede', $page_id)) : the_row(); ?>
            <section>
              <h3><a href="<?php the_sub_field('file'); ?>" target="_blank"><?php the_sub_field('name'); ?><img src="/cms/wp-content/themes/officeuemura/img/icon_<?php the_sub_field('type'); ?>.png" class="icon" alt="<?php the_sub_field('type'); ?>"></a></h3>
              <p><?php the_sub_field('caption'); ?></p>
            </section>
          <?php endwhile; ?>
        </div>
      </secton>
    <?php endif; ?>
  </div>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>