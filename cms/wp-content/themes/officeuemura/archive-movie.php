<?php get_header(); ?>
<!-- archive-column.php -->
<?php
$term = get_current_term();
$post_type = 'movie';
$youtube_thumb_types = [
  'maxresdefault.jpg',
  'sddefault.jpg',
  'hqdefault.jpg',
  'mqdefault.jpg',
  'default.jpg',
];

?>
<div id="vi">
  <div class="pagetitle">解説動画</div>
</div>

<div id="mainContainer">
  <div id="contents">
    <!-- #contents -->
    <?php
    // initialize
    $temp = $wp_query;
    $wp_query = null;
    $wp_query = new WP_Query();
    // 数値のみ受け取る
    $paged = (preg_match("/^[0-9]+$/", htmlspecialchars($_GET['page']))) ? htmlspecialchars($_GET['page']) : 1;
    $param = array(
      'posts_per_page' => 24,
      'post_type' => $post_type,
      'paged' => $paged,
      'orderby' => 'post_date',
      'order' => 'DESC',
    );
    $wp_query->query($param);
    ?>
    <?php if ($wp_query->have_posts()) : ?>
      <h2 class="title-b">解説動画</h2>
      <ul class="movie_list">
        <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
          <li>
            <a href="<?php the_permalink(); ?>">
              <?php
              if (get_field('youtube_id')) {
                foreach ($youtube_thumb_types as $type) {
                  $vi_image = 'https://img.youtube.com/vi/' . get_field('youtube_id') . '/' . $type;
                  $size = getimagesize($vi_image);
                  if ($size > 120) {
                    break;
                  }
                }
              } else {
                $vi_image = get_stylesheet_directory_uri() . '/img/video_dummy.png';
              }
              ?>
              <div class="thumb"><img src="<?php echo $vi_image; ?>" /></div>
              <?php
              $post_terms = get_the_terms($post->ID, 'movie-cat');
              if ($post_terms) :
              ?>
                <div class="movie_cat">
                  <?php foreach ($post_terms as $term) :
                    $term_id = $term->term_id;
                  ?>
                    <span style="background: <?php the_field('icon_color', 'movie-cat_' . $term_id); ?>"><?php echo $term->name; ?></span>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>
              <p><?php the_title(); ?></p>
            </a>
          </li>
        <?php endwhile; ?>
      </ul>
      <?php echo bmPageNavi(); ?>
    <?php endif; ?>
    <?php wp_reset_query(); ?>
    <!-- /#contents -->
  </div>

  <?php get_sidebar(); ?>
</div>
<!-- メイン コンテンツ  -->

<?php get_footer(); ?>