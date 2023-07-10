<div id="side">


	<div class="inqbtn"><a href="contact.html"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/right-1_off.png" alt="初回訪問相談は無料｜上村労務管理事務所｜大阪市・淀川区" class="ba-1" /></a></div>
	<?php if (!is_user_logged_in()) : ?>
	<div id="memberlogin">
			<a href="<?php echo home_url(); ?>/login"><img src="/cms/wp-content/themes/officeuemura/img/btn_memberlogin.png" alt="会員ログイン"/></a>
		</div>
	<?php endif; ?>
	<?php if (is_user_logged_in()) : ?>
		<div id="membermenu">
			<div class="name"><a href="#"><strong><?php global $current_user;
																						echo $current_user->display_name ?></strong></a>さま</div>
			<ul class="menu">
				<li class="cat-item"><a href="<?php echo home_url(); ?>/greeting">代表あいさつ</a>
				</li>
				<li class="cat-item"><a href="<?php echo home_url(); ?>/download">各種書式ダウンロード</a>
					<ul class="children">
						<li class="cat-item"><a href="<?php echo home_url(); ?>/download#renraku">各種連絡票</a></li>
						<li class="cat-item"><a href="<?php echo home_url(); ?>/download#info">法改正情報・行政パンフレット</a></li>
						<li class="cat-item"><a href="<?php echo home_url(); ?>/download#kyotei">各種協定書</a> </li>
					</ul>
				</li>
				<li class="cat-item"><a href="<?php echo home_url(); ?>/movie">解説動画</a></li>
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

	<div class="toolid">
		<ul>
			<li><a href="javascript:void(0);" onClick="window.open('https://www.psrn.jp/tool2/jyoseikin_toolid.php?mid=4938&mail=mail%40office-uemura.com&master=mail%40office-uemura.com','shindan','status=yes,scrollbars=yes,resizable=yes')">助成金診断</a></li>

			<li><a href="javascript:void(0);" onClick="window.open('https://www.psrn.jp/tool2/syugyokisoku_toolid.php?mid=4938&mail=mail%40office-uemura.com&master=mail%40office-uemura.com','shindan','status=yes,scrollbars=yes,resizable=yes')">就業規則診断</a></li>

			<li><a href="javascript:void(0);" onClick="window.open('https://www.psrn.jp/tool2/syugyokisoku_risk_toolid.php?mid=4938&mail=mail%40office-uemura.com&master=mail%40office-uemura.com','shindan','status=yes,scrollbars=yes,resizable=yes')">就業規則労務リスク診断</a></li>
		</ul>
	</div>

	<a href="<?php echo get_stylesheet_directory_uri(); ?>/pdf/book.pdf" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/right-2_off.png" alt="書籍紹介｜上村労務管理事務所｜大阪市・淀川区" class="ba-1 mb15" /></a>

	<div class="top-banner-box mb15">
		<ul>
			<li><a href="https://www.mhlw.go.jp/index.html" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/banner1.png" alt="厚生労働省" class="ba-1 mb10" /></a></li>
			<li><a href="https://www.nenkin.go.jp/" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/banner2.png" alt="日本年金機構" class="ba-1 mb10" /></a></li>
			<li><a href="https://www.kyoukaikenpo.or.jp/" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/banner3.png" alt="全国健康保険協会" class="ba-1 mb10" /></a></li>
			<li><a href="https://www.shakaihokenroumushi.jp/" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/banner4.png" alt="全国社会保険労務士会連合会" class="ba-1 mb10" /></a></li>
		</ul>
	</div>

	<div class="fb-page" data-href="https://www.facebook.com/office.uemura.sr/" data-tabs="timeline" data-width="230" data-height="200" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
		<blockquote cite="https://www.facebook.com/office.uemura.sr/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/office.uemura.sr/">上村労務管理事務所</a></blockquote>
	</div>

</div>