<?php

// 投稿⇒お知らせに名前を変更
function change_post_menu_label()
{
  global $menu;
  global $submenu;
  $menu[5][0] = 'お知らせ';
  $submenu['edit.php'][5][0] = '投稿一覧';
  $submenu['edit.php'][10][0] = '新規追加';
}
function change_post_object_label()
{
  global $wp_post_types;
  $labels = &$wp_post_types['post']->labels;
  $labels->name = 'お知らせ';
  $labels->singular_name = 'お知らせ';
  $labels->add_new = _x('追加', 'お知らせ');
  $labels->add_new_item = 'お知らせの新規追加';
  $labels->edit_item = 'お知らせの編集';
  $labels->new_item = '新規お知らせ';
  $labels->view_item = 'お知らせを表示';
  $labels->search_items = 'お知らせを検索';
  $labels->not_found = '記事が見つかりませんでした';
  $labels->not_found_in_trash = 'ゴミ箱に記事は見つかりませんでした';
}
add_action('init', 'change_post_object_label');
add_action('admin_menu', 'change_post_menu_label');

//カスタム投稿
add_action('init', 'create_post_type');

function create_post_type()
{

  $cp_data = array(
    array(
      'name' => 'blog',
      'title' => 'ブログ',
      'slug' => 'blog',
      'category' => array(
        array(
          'cat_name' => 'blog-cat',
          'cat_title' => 'カテゴリー',
        ),
      ),
    ),
    array(
      'name' => 'movie',
      'title' => '解説動画',
      'slug' => 'movie',
      'category' => array(
        array(
          'cat_name' => 'movie-cat',
          'cat_title' => 'カテゴリー',
        ),
      ),
    ),
 );


  for ($i = 0; $i < count($cp_data); $i++) {
    register_post_type($cp_data[$i]['name'], array(
      "label" => __($cp_data[$i]['title'], ''),
      "labels" => array(
        "name" => __($cp_data[$i]['title'], ''),
        "singular_name" => __($cp_data[$i]['title'], ''),
        "menu_name" => __($cp_data[$i]['title'], ''),
        "all_items" => __('投稿一覧', ''),
        "add_new" => __('新規追加', ''),
        "add_new_item" => __($cp_data[$i]['title'] . ' 新規追加', ''),
        "edit_item" => __('編集', ''),
        "new_item" => __($cp_data[$i]['title'] . ' 編集', ''),
        "view_item" => __('表示', ''),
        "search_items" => __($cp_data[$i]['title'] . 'を検索', ''),
        "not_found" => __('見つかりません', ''),
        "not_found_in_trash" => __('ゴミ箱には見当たりません', ''),
        "parent" => __('親', ''),
      ),
      "description" => "",
      "public" => true,
      "show_ui" => true,
      "show_in_rest" => true,
      "rest_base" => "",
      "has_archive" => true, //falseで、スラッグのURLは固定ページが優先される
      "show_in_menu" => true,
      "exclude_from_search" => false,
      "capability_type" => "post",
      "map_meta_cap" => true,
      "hierarchical" => true,
      "rewrite" => array("slug" => $cp_data[$i]['slug'], "with_front" => false),
      "query_var" => true,
      "menu_position" => 5,
      "supports" => array("title", "editor", 'thumbnail'),
      'yarpp_support' => true,
      //'taxonomies' => $cp_data[$i]['tax'],
    ));

    tax_admin_order($cp_data[$i]['name']);

    if ($cp_data[$i]['category']) {
      for ($j = 0; $j < count($cp_data[$i]['category']); $j++) {
        register_taxonomy(
          $cp_data[$i]['category'][$j]['cat_name'],
          $cp_data[$i]['name'],
          array(
            'hierarchical' => true,
            'update_count_callback' => '_update_post_term_count',
            'label' => $cp_data[$i]['category'][$j]['cat_title'],
            'singular_label' => $cp_data[$i]['category'][$j]['cat_title'],
            'public' => true,
            'show_ui' => true,
            "show_in_rest" => true,
          )
        );
        tax_admin_column(
          $cp_data[$i]['name'],
          $cp_data[$i]['category'][$j]['cat_name'],
          $cp_data[$i]['category'][$j]['cat_title']
        );
      }
    }
  }

}

//タクソノミーを管理画面の列に表示
function tax_admin_column($post_name, $taxonomy, $tax_label)
{
  add_filter('manage_edit-' . $post_name . '_columns', function ($columns) use ($post_name, $taxonomy, $tax_label) {
    $columns[$taxonomy] = $tax_label;
    return $columns;
  });
  add_action('manage_' . $post_name . '_posts_custom_column', function ($column_name, $post_id) use ($post_name, $taxonomy, $tax_label) {
    if ($column_name == $taxonomy) {
      $tax = wp_get_object_terms($post_id, $taxonomy);
      $stitle = $tax[0]->name;
    }
    if (isset($stitle) && $stitle) {
      echo esc_attr($stitle);
    }
  }, 10, 2);
  add_action('restrict_manage_posts', function () use ($post_name, $taxonomy, $tax_label) {
    global $post_type;
    if ($post_type == $post_name) {
?>
      <select name="<?php echo $taxonomy; ?>">
        <option value="">カテゴリー指定なし</option>
        <?php $terms = get_terms($taxonomy);
        foreach ($terms as $term) : ?>
          <option value="<?php echo $term->slug; ?>" <?php if ($_GET[$taxonomy] == $term->slug) {
                                                        print 'selected';
                                                      } ?>><?php echo $term->name; ?></option>
        <?php endforeach; ?>
      </select>
  <?php
    }
  });
}

//カスタム投稿を日付順に表示
function tax_admin_order($post_name)
{
  add_filter('pre_get_posts', function ($wp_query) use ($post_name) {
    if (is_admin()) {
      if ($wp_query->query['post_type'] == $post_name) {
        $wp_query->set('orderby', 'date');
        $wp_query->set('order', 'DESC');
      }
    }
  });
}



// アイキャッチを有効化
add_theme_support('post-thumbnails');

// 記事内の画像を取得
function catch_that_image()
{
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all("/<img[^>]+src=[\"'](s?https?:\/\/[\-_\.!~\*'()a-z0-9;\/\?:@&=\+\$,%#]+\.(jpg|jpeg|png|gif))[\"'][^>]+>/i", $post->post_content, $matches);
  $first_img = $matches[1][0];
  return $first_img;
}

//パーマリンクカテゴリ削除
add_filter('user_trailingslashit', 'remcat_function');
function remcat_function($link)
{
  return str_replace("/category/", "/", $link);
}
add_action('init', 'remcat_flush_rules');
function remcat_flush_rules()
{
  global $wp_rewrite;
  $wp_rewrite->flush_rules();
}
add_filter('generate_rewrite_rules', 'remcat_rewrite');
function remcat_rewrite($wp_rewrite)
{
  $new_rules = array('(.+)/page/(.+)/?' => 'index.php?category_name=' . $wp_rewrite->preg_index(1) . '&paged=' . $wp_rewrite->preg_index(2));
  $wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
}


//固定ページのみ、ビジュアルエディタ禁止
add_filter('user_can_richedit', 'my_default_editor');
function my_default_editor($r)
{
  $url = $_SERVER['REQUEST_URI'];
  if ('page' == get_current_screen()->id && !strstr($url, 'post=112')) {
    return false;
  } else {
    return $r;
  }
}


// ショートコード
function Include_my_php($params = array())
{
  extract(shortcode_atts(array(
    'file' => 'default'
  ), $params));
  ob_start();
  include(STYLESHEETPATH . "/$file");
  return ob_get_clean();
}
add_shortcode('myphp', 'Include_my_php');

//URLショートコード
add_shortcode('home_url', 'shortcode_hurl');
function shortcode_hurl()
{
  return home_url();
}

add_shortcode('theme_url', 'shortcod_gsdu');
function shortcod_gsdu()
{
  return get_stylesheet_directory_uri();
}

add_shortcode('archive_url', 'shortcode_acurl');
function shortcode_acurl($atts)
{
  return get_post_type_archive_link($atts['type']);
}

add_shortcode('term_url', 'shortcode_termurl');
function shortcode_termurl($atts)
{
  return get_term_link($atts['term'], $atts['tax']);
}


// 自動pタグ生成をやめる
add_filter('the_content', 'wpautop_filter', 9);
function wpautop_filter($content)
{
  global $post;
  $remove_filter = false;
  $arr_types = array('page');
  $post_type = get_post_type($post->ID);
  if (in_array($post_type, $arr_types)) $remove_filter = true;
  if ($remove_filter) {
    remove_filter('the_content', 'wpautop');
    remove_filter('the_excerpt', 'wpautop');
  }
  return $content;
}

//TinyMCE導入時の追加設定
//add_filter( 'tiny_mce_before_init', 'tinymce_init', 100);
function tinymce_init($init)
{
  $init['wpautop'] = false;
  $init['apply_source_formatting'] = ture;
  return $init;
}

// タイトル生成

add_theme_support('title-tag');
function change_title_separator($sep)
{
  $sep = '｜';
  return $sep;
}
add_filter('document_title_separator', 'change_title_separator');

// ページタイトルを取得
function get_page_title()
{
  $page_title = wp_get_document_title();

  return $page_title;
}
function change_title_tag($title)
{

  //条件分岐タグ等を使ってページにより $title を変更する処理
  $urlall =  (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
  if (preg_match("/xxxx/", $urlall)) {
    $title = 'ｘｘｘｘ';
  }

  return $title;
}
//add_filter('pre_get_document_title', 'change_title_tag');

// ページネーション

function bmPageNavi()
{
  global $wp_rewrite;
  global $wp_query;
  global $paged;

  $paginate_base = get_pagenum_link(1);
  if (strpos($paginate_base, '?') || !$wp_rewrite->using_permalinks()) {
    $paginate_format = '';
    $paginate_base = add_query_arg('page', '%#%');
  } else {
    $paginate_format = (substr($paginate_base, -1, 1) == '/' ? '' : '/') .
      untrailingslashit('?page=%#%', 'paged');;
    $paginate_base .= '%_%';
  }

  $result = paginate_links(array(
    'base' => $paginate_base,
    'format' => $paginate_format,
    'total' => $wp_query->max_num_pages,
    'mid_size' => 5,
    'current' => ($paged ? $paged : 1),
    'type'  => 'array',
    'prev_text' => '&lt;&lt;',
    'next_text' => '&gt;&gt;'
  ));

  if (is_array($result)) {
    $paged = (get_query_var('paged') == 0) ? 1 : get_query_var('paged');
    echo '<ul class="pager">';
    //echo '<li><span>'. $paged . ' of ' . $wp_query->max_num_pages .'</span></li>';
    foreach ($result as $page) {
      echo "<li>$page</li>\n";
    }
    echo '</ul>';
  }
}

/* 【出力カスタマイズ】未来の日付の投稿を表示する */
function stop_post_status_future_func($data, $postarr)
{
  if ($data['post_status'] == 'future' && $postarr['post_status'] == 'publish') {
    $data['post_status'] = 'publish';
  }
  return $data;
};
//add_filter('wp_insert_post_data', 'stop_post_status_future_func', 10, 2);

//画像を投稿に挿入する際のタグの変更（Gutenbergでは認識されない）
function give_linked_images_class($html, $id, $caption, $title, $align, $url, $size)
{
  $str_a = '<a href';
  if (strstr($html, $str_a)) {
    $str_a_class = '<a class="pop" href';
    $html = str_replace($str_a, $str_a_class, $html);
    /* //画像にもクラスを追加する場合
    $str_img = '" /></a>';
    $str_img_class = ' bbb" /></a>';
    $html = str_replace($str_img, $str_img_class, $html);
				*/
  }
  return $html;
}

add_action('image_send_to_editor', 'give_linked_images_class', 10, 8);

//カスタム投稿のデフォルトタクソノミーを指定
function default_taxonomy_select()
{
  ?>
  <script type="text/javascript">
    jQuery(function($) {
      //$('#categorychecklist li:first-child input[type="checkbox"]').prop('checked', true);
      $('#member-catchecklist li:first-child input[type="checkbox"]').prop('checked', true);
    });
  </script>
  <?php
}
add_action('admin_head-post-new.php', 'default_taxonomy_select');

//カテゴリの記事数をリンクに含める
add_filter('wp_list_categories', 'my_list_categories', 10, 2);
function my_list_categories($output, $args)
{
  $output = preg_replace('/<\/a>\s*\((\d+)\)/', ' ($1)</a>', $output);
  return $output;
}

//アーカイブの記事数をリンクに含める
add_filter('get_archives_link', 'my_archives_link');
function my_archives_link($output)
{
  $output = preg_replace('/<\/a>\s*(&nbsp;)\((\d+)\)/', ' ($2)</a>', $output);
  return $output;
}

//管理画面】投稿編集画面で不要な項目を非表示にする
function my_remove_post_support()
{
  remove_post_type_support('kouhoushi', 'editor');
  remove_post_type_support('format', 'editor');
}
add_action('init', 'my_remove_post_support');

//srcsetを出力しない
add_filter('wp_calculate_image_srcset_meta', '__return_null');

//投稿一覧のカラムにカスタムフィールドを追加
function add_posts_columns($columns)
{
  //$columns['field_name'] = 'フィールド名';
  unset($columns['comments']);
  unset($columns['tags']);
  return $columns;
}
function custom_posts_column($column_name, $post_id)
{
  if ($column_name == 'field_name') {
    $field_name = get_post_meta($post_id, 'field_name', true);
    echo ($field_name) ? $field_name : '－';
  }
}
add_filter('manage_post_posts_columns', 'add_posts_columns');
//add_action( 'manage_post_posts_custom_column', 'custom_posts_column', 10, 2 );

//?pageを勝手に転送しない
add_filter('redirect_canonical', 'my_disable_redirect_canonical');
function my_disable_redirect_canonical($redirect_url)
{

  if (is_page()) {
    $subject = $redirect_url;
    $pattern = '/\?page/'; // URLに「?page」があるかチェック
    preg_match($pattern, $subject, $matches);

    if ($matches) {
      //リクエストURLに「?page」があれば、リダイレクトしない。
      $redirect_url = false;
      return $redirect_url;
    }
  }
}

//投稿本文を任意の文字数で取得
function get_the_custom_excerpt($content, $length)
{
  $length = ($length ? $length : 70);
  $content =  preg_replace('/<!--more-->.+/is', "", $content);
  $content =  strip_shortcodes($content);
  $content =  strip_tags($content);
  $content =  str_replace(" ", "", $content);
  $content =  mb_substr($content, 0, $length);
  return $content;
}

//自動wpファビコン　オフ
add_action('do_faviconico', 'wp_favicon_remover');
function wp_favicon_remover()
{
  exit;
}

//アーカイブページで現在のカテゴリー・タグ・タームを取得する
function get_current_term()
{

  $id;
  $tax_slug;

  if (is_category()) {
    $tax_slug = "category";
    $id = get_query_var('cat');
  } else if (is_tag()) {
    $tax_slug = "post_tag";
    $id = get_query_var('tag_id');
  } else if (is_tax()) {
    $tax_slug = get_query_var('taxonomy');
    $term_slug = get_query_var('term');
    $term = get_term_by("slug", $term_slug, $tax_slug);
    $id = $term->term_id;
  }

  return get_term($id, $tax_slug);
}

//5.5移行のページネーションエラーを回避
function pre_handle_404($preempt, $wp_query)
{
  if (isset($wp_query->query['page']) && $wp_query->query['page']) {
    return true;
  }

  return $preempt;
}
add_filter('pre_handle_404', 'pre_handle_404', 10, 2);

add_editor_style();

//MW WP Form カスタムバリデーション（いずれか一つ必須）
if (class_exists('MW_WP_Form_Abstract_Validation_Rule')) {
  class MW_WP_Form_Validation_Rule_AnyRequired extends MW_WP_Form_Abstract_Validation_Rule
  {
    protected $name = 'anyrequired';

    public function rule($key, array $options = array())
    {
      $value = $this->Data->get($key);

      if (empty($this->Data->gets())) {
        return;
      }

      $targets = array_map('trim', explode(',', $options['target']));
      array_unshift($targets, $key);

      $count = 0;
      foreach ($targets as $target) {
        $target_value = $this->Data->get($target);
        if (!empty($target_value) || !MWF_Functions::is_empty($target_value)) {
          $count++;
        }
      }
      if ($count == 0) {
        $defaults = array(
          'target' => null,
          'message' => sprintf('%s のいずれも未入力です。', implode(', ', $targets))
        );
        $options = array_merge($defaults, $options);
        return $options['message'];
      }
    }

    public function admin($key, $value)
    {
      $target = '';
      if (is_array($value[$this->get_name()]) && isset($value[$this->get_name()]['target'])) {
        $target = $value[$this->get_name()]['target'];
      }
  ?>
      <table>
        <tr>
          <td>いずれか必須項目</td>
          <td>
            <input type="text" value="<?php echo esc_attr($target); ?>" name="<?php echo MWF_Config::NAME; ?>[validation][<?php echo $key; ?>][<?php echo esc_attr($this->get_name()); ?>][target]" />
            <span class="mwf_note">（カンマ区切り）</span>
          </td>
        </tr>
      </table>
<?php
    }
  }

  function mwform_validation_rule_anyrequired($validation_rules)
  {
    $instance = new MW_WP_Form_Validation_Rule_AnyRequired();
    $validation_rules[$instance->get_name()] = $instance;
    return $validation_rules;
  }

  add_filter('mwform_validation_rules', 'mwform_validation_rule_anyrequired');
}

// post_thumbnail_htmlのloading="lazyをloading="eager"に置換
//add_filter('post_thumbnail_html', 'my_thumbnail_image_html', 10, 3);

function my_thumbnail_image_html($html)
{
  $html = str_replace(' loading="lazy"', ' loading="eager"', $html);
  return $html;
}

//グーテンベルク対応
function my_guten()
{
  wp_enqueue_style(
    'my-guten',
    get_template_directory_uri() . '/style.css'
  );
}
add_action('enqueue_block_editor_assets', 'my_guten');
//add_action( 'wp_head', 'my_guten' );

//管理画面用css
function my_admin_style()
{
  wp_enqueue_style('my_admin_style', get_template_directory_uri() . '/my_admin_style.css');
}
add_action('admin_head-post.php', 'my_admin_style');

//Basic認証
function basic_auth($auth_list, $realm = "Restricted Area", $failed_text = "認証に失敗しました")
{
  if (isset($_SERVER['PHP_AUTH_USER']) and isset($auth_list[$_SERVER['PHP_AUTH_USER']])) {
    if ($auth_list[$_SERVER['PHP_AUTH_USER']] == $_SERVER['PHP_AUTH_PW']) {
      return $_SERVER['PHP_AUTH_USER'];
    }
  }
  header('WWW-Authenticate: Basic realm="' . $realm . '"');
  header('HTTP/1.0 401 Unauthorized');
  header('Content-type: text/html; charset=' . mb_internal_encoding());
  die($failed_text);
}

//wp-member redirect
add_filter( 'wpmem_logout_redirect', 'my_logout_redirect' );
function my_logout_redirect(){
	return '/login';
}

//非ログイン時に、カスタム投稿movieの一覧ページにアクセスしたら、ログインページを表示
function archive_movie_page_redirect() {
	if( ! is_user_logged_in()  && is_post_type_archive( 'movie' ) ) {
		wp_redirect( '/login' );
		exit();
	}
}
add_action( 'template_redirect','archive_movie_page_redirect');

function single_movie_page_redirect() {
	if( ! is_user_logged_in()  && is_singular('movie') ) {
		wp_redirect( '/login' );
		exit();
	}
}
add_action( 'template_redirect','single_movie_page_redirect');

?>