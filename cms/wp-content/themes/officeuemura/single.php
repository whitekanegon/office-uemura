<?php get_header(); ?>
<!-- single.php -->
<?php
$term = get_current_term();
$post_type = get_post_type();
if ($post_type === 'post') {
	$post_label = 'お知らせ';
} else {
	$post_label = get_post_type_object($post_type)->label;
}
?>
<div id="vi">
	<div class="pagetitle"><?php echo $post_label; ?></div>
</div>


<div id="mainContainer">
	<div id="contents">
		<!-- #contents -->
		<h2 class="title-b"><?php echo $post_label; ?></h2>
		<h3 class="main_header"><?php the_title(); ?></h3>
		<?php if ($post_type === 'blog') : ?>
			<div class="article_header">
				<?php
				$post_terms = get_the_terms($post->ID, 'blog-cat');
				if ($post_terms) :
				?>
					<div class="category">
						<?php foreach ($post_terms as $term) :
							$term_id = $term->term_id;
						?>
							<span style="background: <?php the_field('icon_color', 'blog-cat_' . $term_id); ?>"><?php echo $term->name; ?></span>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
				<p class="article_date"><?php the_time('Y.m.d'); ?></p>
			</div>
		<?php else : ?>
			<p class="article_date"><?php the_time('Y.m.d'); ?></p>
		<?php endif; ?>

		<div id="article_body">
			<?php the_content(); ?>
		</div>

		<div class="back_index"><a href="<?php echo get_post_type_archive_link($post_type); ?>">一覧に戻る</a></div>

		<!-- /#contents -->
	</div>

	<?php get_sidebar(); ?>
</div>
<!-- メイン コンテンツ  -->
<?php get_footer(); ?>