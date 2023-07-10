<?php get_header(); ?>
<!-- single.php -->
<?php
$term = get_current_term();
$post_type = get_post_type();
?>
<div id="vi">
	<div class="pagetitle">解説動画</div>
</div>


<div id="mainContainer">
	<div id="contents">
		<!-- #contents -->
		<div class="movie">
			<section>
				<h2 class="title-b"><?php the_title(); ?></h2>
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
				<?php if(get_field('youtube_id')) : ?>
				<div class="youtube">
					<iframe width="560" height="315" src="https://www.youtube.com/embed/<?php the_field('youtube_id'); ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
				</div>
				<?php endif; ?>
				<div class="detail">
					<?php the_content(); ?>
				</div>
			</section>
		</div>
		<div class="back_index"><a href="<?php echo get_post_type_archive_link($post_type); ?>">動画一覧に戻る</a></div>
		<!-- /#contents -->
	</div>

	<?php get_sidebar(); ?>
</div>
<!-- メイン コンテンツ  -->
<?php get_footer(); ?>