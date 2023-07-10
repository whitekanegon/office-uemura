<!-- include_post.php -->
<h2 class="main_header">新着情報</h2>
<div class="news">
<?php
// initialize
$temp = $wp_query;
$wp_query = null;
$wp_query = new WP_Query();
// 数値のみ受け取る
$param = array(
  'posts_per_page' => 3,
  'post_type' => 'post',
  'orderby' => 'post_date',
  'order' => 'DESC',
);
$wp_query->query($param);
?>
<?php if ($wp_query->have_posts()) : ?>
	<div class="categoryHeader">
		<h3>お知らせ</h3>
		<div class="link"><a href="<?php echo get_post_type_archive_link('post'); ?>">一覧へ</a></div>
	</div>
	<ul class="newslist">
  <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
		<li>
			<dl>
			<dt><?php the_time('Y/m/d'); ?></dt>

			<dd><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></dd>
			</dl>
		</li>
    <?php endwhile; ?>
	</ul>
	<?php endif; ?>
<?php wp_reset_query(); ?>
<?php
// initialize
$temp = $wp_query;
$wp_query = null;
$wp_query = new WP_Query();
// 数値のみ受け取る
$param = array(
  'posts_per_page' => 3,
  'post_type' => 'blog',
  'orderby' => 'post_date',
  'order' => 'DESC',
);
$wp_query->query($param);
?>
<?php if ($wp_query->have_posts()) : ?>
	<div class="categoryHeader">
		<h3>ブログ</h3>
		<div class="link"><a href="<?php echo get_post_type_archive_link('blog'); ?>">一覧へ</a></div>
	</div>
	<ul class="bloglist">
  <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

		<li>
			<dl>
			<dt><?php the_time('Y/m/d'); ?></dt>
      <?php
			$post_terms = get_the_terms($post->ID, 'blog-cat');
			if($post_terms):
?>
			<dd class="category">
		<?php foreach($post_terms as $term):
			$term_id = $term->term_id;
			?>		
			<span style="background: <?php the_field('icon_color', 'blog-cat_'.$term_id);?>"><?php echo $term->name; ?></span>
			<?php endforeach; ?>
		</dd>
			<?php endif; ?>
			<dd class="blogtitle"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></dd>
			</dl>
		</li>
    <?php endwhile; ?>
	</ul>
</div>
<?php endif; ?>
<?php wp_reset_query(); ?>