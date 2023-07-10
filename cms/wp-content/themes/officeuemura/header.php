<!doctype html>
<html lang="ja">

<head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-R5MZR3Q46D"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-R5MZR3Q46D');
</script>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width">
  <meta name="format-detection" content="telephone=no">
  <?php
  if (get_field('description')) {
    $description = get_field('description');
  } else {
    $description = get_bloginfo('description');
  }
  ?>
  <meta name="description" content="<?php echo $description; ?>">
  <meta name="keywords" content="賃金制度,人事制度,評価制度,職能給,就業規則,社会保険労務士,社労士,是正勧告,給与計算,助成金,種類,法改正,労働基準法,総務,人事,コンサルタント,解雇,労使紛争,賃金,上村労務管理事務所">
  <meta property="og:type" content="blog">
  <meta property="og:title" content="<?php wp_title('｜', true, 'right'); ?><?php bloginfo('name'); ?>">
  <meta property="og:description" content="<?php echo $description; ?>">
  <meta property="og:url" content="<?php echo ("https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]); ?>">
  <?php
  $og_image_default = get_stylesheet_directory_uri() . "/img/cmn/ogp.png";
  global $post;
  if (isset($post)) {
    $str = $post->post_content;
  }
  $searchPattern = '/<img.*?src=(["\'])(.+?)\1.*?>/i';
  if (is_single()) {
    if (has_post_thumbnail()) {
      $image_id = get_post_thumbnail_id();
      $image = wp_get_attachment_image_src($image_id, 'full');
      $og_image = $image[0];
    } else if (preg_match($searchPattern, $str, $imgurl) && !is_archive()) {
      $og_image = $imgurl[2];
    } else {
      $og_image = $og_image_default;
    }
  } else {
    $og_image = $og_image_default;
  }
  ?>
  <meta property="og:image" content="<?php echo $og_image; ?>">
  <meta property="og:site_name" content="<?php bloginfo('name'); ?>">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:site" content="">
  <meta name="twitter:description" content="<?php echo $description; ?>">
  <link rel="contents" type="text/html" href="<?php echo home_url(); ?>/sitemap" title="サイトマップ">
  <link rel="shortcut icon" href="/favicon.ico">
  <link rel="apple-touch-icon-precomposed" href="/favicon.png">
  <link href="<?php echo get_stylesheet_directory_uri(); ?>/default.css" rel="stylesheet">
  <link href="<?php echo get_stylesheet_directory_uri(); ?>/user.css" rel="stylesheet">
  <link href="<?php echo get_stylesheet_directory_uri(); ?>/fade.css" rel="stylesheet">
  <link href="<?php echo get_stylesheet_directory_uri(); ?>/style.css" rel="stylesheet">
  <?php wp_head(); ?>
</head>

<body class="drawer drawer--left pageTop top" id="home">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v3.2&appId=243593409000469&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
  <div id="wrapper">
    <div id="head" class="clearfix">
      <div id="hdcontents">
        <h1>賃金制度・評価制度・就業規則・是正勧告・給与計算・労働保険・社会保険・助成金のことなら大阪市・淀川区にある上村労務管理事務所まで</h1>
        <div class="logo"><a href="/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo.png" alt="上村労務管理事務所｜大阪市・淀川区" /></a></div>
        <h2>～身近な人事労務の専門家 上村 和也（KAZUYA UEMURA）～</h2>
        <h3>〒532-0011 大阪市淀川区西中島1-14-17 アルバート新大阪ビル3階<a href="https://goo.gl/maps/rZuw5Ch4Xd72" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/map.png" alt="マップ｜上村労務管理事務所｜大阪市・淀川区" class="map-icon" /></a></h3>
        <div class="hed-inq pc"><a href="/contact.html"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/inq_off.png" alt="WEBお問い合わせ｜上村労務管理事務所｜大阪市・淀川区" /></a></div>
        <div class="hed-tel pc"><a href="tel:06-6195-9360"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/tel.png" alt="電話番号｜上村労務管理事務所｜大阪市・淀川区" /></a></div>
      </div>
    </div>

    <div class="nav-box pc">
      <div class="nav">
        <ul>
          <li><a href="/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/nav1_off.png" alt="HOME｜上村労務管理事務所｜大阪市・淀川区" /></a></li>
          <li><a href="/business.html"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/nav2_off.png" alt="事業所案内｜上村労務管理事務所｜大阪市・淀川区" /></a></li>
          <li><a href="/service.html"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/nav3_off.png" alt="サービス内容｜上村労務管理事務所｜大阪市・淀川区" /></a></li>
          <li><a href="/voice.html"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/nav4_off.png" alt="お客様の声｜上村労務管理事務所｜大阪市・淀川区" /></a></li>
          <li><a href="/price.html"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/nav5_off.png" alt="料金プラン｜上村労務管理事務所｜大阪市・淀川区" /></a></li>
          <li><a href="/access.html"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/nav6_off.png" alt="アクセス｜上村労務管理事務所｜大阪市・淀川区" /></a></li>
        </ul>
      </div>
    </div>