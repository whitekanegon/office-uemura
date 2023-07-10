<div id="side">


	<div class="inqbtn"><a href="contact.html"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/right-1_off.png" alt="初回訪問相談は無料｜上村労務管理事務所｜大阪市・淀川区" class="ba-1" /></a></div>
	<?php if (!is_user_logged_in()) : ?>
		<div id="memberlogin">
			<a href="<?php echo home_url(); ?>/login"><img src="/cms/wp-content/themes/officeuemura/img/btn_memberlogin.png" alt="会員ログイン" /></a>
		</div>
	<?php endif; ?>
	<?php if (is_user_logged_in()) : ?>
		<div id="membermenu">
			<div class="name"><a href="#"><strong><?php global $current_user;
																						echo $current_user->display_name ?></strong></a>さま</div>
			<ul class="menu">
				<li class="cat-item"><a href="<?php echo home_url(); ?>/greeting">顧問先の皆様へ</a>
				</li>
				<li class="cat-item"><a href="<?php echo home_url(); ?>/download">各種書式ダウンロード</a>
					<ul class="children">
						<li class="cat-item"><a href="<?php echo home_url(); ?>/download-renraku">各種連絡票</a></li>
						<li class="cat-item"><a href="<?php echo home_url(); ?>/download-info">法改正・行政資料等</a></li>
						<li class="cat-item"><a href="<?php echo home_url(); ?>/download-kyotei">書式集</a> </li>
					</ul>
				</li>
				<?php
    // initialize
    $temp = $wp_query;
    $wp_query = null;
    $wp_query = new WP_Query();
    $param = array(
      'posts_per_page' => -1,
      'post_type' => 'movie',
    );
    $wp_query->query($param);
		if($wp_query->found_posts > 0):
    ?>

				<li class="cat-item"><a href="<?php echo home_url(); ?>/movie">解説動画</a>
				<?php 
		$movie_terms = get_terms('movie-cat');
		if ($movie_terms) :
	?>
	<ul class="children">
		<?php foreach($movie_terms as $movie_term) : ?>
			<li class="cat-item"><a href="<?php echo get_term_link($movie_term, 'movie-cat'); ?>"><?php echo $movie_term->name; ?></a></li>
			<?php endforeach; ?>
		</ul>
		<?php endif; ?>
			</li>
			<?php endif; ?>
				<?php // 管理者のみ
				global $user_level;
				get_currentuserinfo();
				if (10 <= $user_level) { ?>
					<li><a href="<?php echo get_admin_url(); ?>users.php">会員管理</a></li>
				<?php } ?>
			</ul>
			<div class="logout"><a href="<?php echo home_url(); ?>/login/?a=logout">ログアウト</a></div>
		</div>
	<?php endif; ?>
	<!-- 診断  -->
	<?php
	$post_type = get_post_type();
	if ($post_type === 'post' || $post_type === 'blog') :
	?>
		<div id="archiveList">
			<h2>Archive</h2>
			<ul>
				<?php
				$show_post_count = true;
				$args = array(
					'post_type' => $post_type, // 投稿タイプ名
					'type' => 'yearly',
					'show_post_count' => $show_post_count, // 記事件数を表示する
					'echo' => 0,
				);
				$monthlylist = wp_get_archives($args);
				if ($show_post_count) {
					$monthlylist = preg_replace('/([0-9]+?)\s/', '$1年 ', $monthlylist);
				} else {
					$monthlylist = preg_replace('/([0-9]+?)<\/a>/', '$1年</a>', $monthlylist);
				}

				if ($post_type === 'blog') {
					$monthlylist = str_replace('/blog/', '/blog/date/', $monthlylist);
				}
				echo $monthlylist;
				?>
			</ul>
		</div>
	<?php endif; ?>
	<?php if ($post_type === 'blog') :
		$terms = get_terms('blog-cat');
		if ($terms) :
	?>

			<div id="categoryList">
				<h2>Category</h2>
				<ul>
					<?php foreach ($terms as $term) : ?>
						<li><a href="<?php echo get_term_link($term, 'blog-cat'); ?>"><span style="background: <?php the_field('icon_color', 'blog-cat_' . $term->term_id); ?>"></span><?php echo $term->name; ?> (<?php echo $term->count; ?>)</a></li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endif; ?>
	<?php endif; ?>
	<div class="toolid">
		<ul>
			<li><a href="javascript:void(0);" onClick="window.open('https://www.psrn.jp/tool2/jyoseikin_toolid.php?mid=4938&mail=mail%40office-uemura.com&master=mail%40office-uemura.com','shindan','status=yes,scrollbars=yes,resizable=yes')">助成金診断</a></li>

			<li><a href="javascript:void(0);" onClick="window.open('https://www.psrn.jp/tool2/syugyokisoku_toolid.php?mid=4938&mail=mail%40office-uemura.com&master=mail%40office-uemura.com','shindan','status=yes,scrollbars=yes,resizable=yes')">就業規則診断</a></li>

			<li><a href="javascript:void(0);" onClick="window.open('https://www.psrn.jp/tool2/syugyokisoku_risk_toolid.php?mid=4938&mail=mail%40office-uemura.com&master=mail%40office-uemura.com','shindan','status=yes,scrollbars=yes,resizable=yes')">就業規則労務リスク診断</a></li>
		</ul>
	</div>
	<?php if (!is_user_logged_in()) : ?>
		
<a href="/cms/wp-content/themes/officeuemura/pdf/book.pdf" target="_blank"><img src="/cms/wp-content/themes/officeuemura/img/right-2_off.png" alt="書籍紹介｜上村労務管理事務所｜大阪市・淀川区" class="ba-1 mb15" /></a>
	
<div class="top-banner-box mb15">
<ul>
<li><a href="https://www.mhlw.go.jp/index.html" target="_blank"><img src="/cms/wp-content/themes/officeuemura/img/banner1.png" alt="厚生労働省" class="ba-1 mb10" /></a></li>
<li><a href="https://www.nenkin.go.jp/" target="_blank"><img src="/cms/wp-content/themes/officeuemura/img/banner2.png" alt="日本年金機構" class="ba-1 mb10" /></a></li>
<li><a href="https://www.kyoukaikenpo.or.jp/" target="_blank"><img src="/cms/wp-content/themes/officeuemura/img/banner3.png" alt="全国健康保険協会" class="ba-1 mb10" /></a></li>
<li><a href="https://www.shakaihokenroumushi.jp/" target="_blank"><img src="/cms/wp-content/themes/officeuemura/img/banner4.png" alt="全国社会保険労務士会連合会" class="ba-1 mb10" /></a></li>
</ul>
</div>
	
<div class="fb-page" data-href="https://www.facebook.com/office.uemura.sr/" data-tabs="timeline" data-width="230" data-height="200" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/office.uemura.sr/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/office.uemura.sr/">上村労務管理事務所</a></blockquote></div>

	
	<?php endif; ?>	
</div>