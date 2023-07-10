<?php get_header(); ?>
<!-- index.php -->
<?php
$term = get_current_term();
$post_type = get_post_type();
if ($post_type === 'post') {
  $post_label = 'お知らせ';
  $class_label = 'news';
} else {
  $post_label = get_post_type_object($post_type)->label;
  $class_label = $post_type;
}
$year = get_query_var('year');
$monthnum = get_query_var('monthnum');

?>
<div id="vi">
  <div class="pagetitle"><a href="<?php echo get_post_type_archive_link($post_type); ?>"><?php echo $post_label; ?></a></div>
</div>


<div id="mainContainer">
  <div id="contents">
    <!-- #contents -->
    <h2 class="title-b">
      <?php
      echo $post_label;
      if (is_date()) {
        echo '：' . $year . '年';
      }
      if (is_tax()) {
        echo '：' . $term->name;
      }
      ?>
    </h2>
    <?php
    // initialize
    $temp = $wp_query;
    $wp_query = null;
    $wp_query = new WP_Query();
    // 数値のみ受け取る
    $paged = (preg_match("/^[0-9]+$/", htmlspecialchars($_GET['page']))) ? htmlspecialchars($_GET['page']) : 1;
    if ($term->taxonomy === 'blog-cat') {
      $tax_query = array(
        array(
          'taxonomy' => 'blog-cat',
          'field' => 'slug',
          'terms' => $term->slug,
        )
      );
    }
    $param = array(
      'year' => $year,
      'monthnum' => $monthnum,
      'posts_per_page' => 20,
      'paged' => $paged,
      'post_type' => $post_type,
      'orderby' => 'post_date',
      'order' => 'DESC',
      'tax_query' => $tax_query,
    );
    $wp_query->query($param);
    ?>
    <?php if ($wp_query->have_posts()) : ?>

      <div class="news">
        <ul class="<?php echo $class_label; ?>list">
          <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
            <li>
              <dl>
                <dt><?php the_time('Y.m.d'); ?></dt>
                <?php if ($post_type === 'blog') :
                  $post_terms = get_the_terms($post->ID, 'blog-cat');
                  if ($post_terms) :
                ?>
                    <dd class="category">
                      <?php foreach ($post_terms as $term) :
                        $term_id = $term->term_id;
                      ?>
                        <span style="background: <?php the_field('icon_color', 'blog-cat_' . $term_id); ?>"><?php echo $term->name; ?></span>
                      <?php endforeach; ?>
                    </dd>
                  <?php endif; ?>
                  <dd class="blogtitle"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></dd>
                <?php else : ?>
                  <dd><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></dd>
                <?php endif; ?>
              </dl>
            </li>
          <?php endwhile; ?>
        </ul>
      </div>
      <?php echo bmPageNavi(); ?>
    <?php endif; ?>
    <?php wp_reset_query(); ?>
    <!-- /#contents -->
  </div>
  <?php get_sidebar(); ?>
</div>
<!-- メイン コンテンツ  -->

<?php get_footer(); ?>