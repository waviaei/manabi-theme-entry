<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>><!-- xmlns宣言です。langauge_attributesはWPの関数で、使用しているブログの設定言語が表示されます。 -->
<head profile="http://gmpg.org/xfn/11"><!-- ここから　head -->
	<title><?php wp_title('&laquo; ', 1, 'right'); ?><?php bloginfo('name'); ?></title>
	<!-- wp_titleは現在表示されているページのタイトルを表示します。括弧内のパラメータは区切り文字の指定と、その表示場所です。ここでは区切り文字に＜＜を、ブログ名の前に表示するように指定しています。bloginfoはパラメータにnameを指定して、ブログのタイトルを表示しています。 -->
	
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<!-- bloginfoはname以外にも様々なパラメータがあり、ここではhtml_typeがブログのcontenttypeを、charsetが文字コードを表示しています。 -->
	
	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url'); ?>" title="の最新記事" /><!-- ここではrss2_urlでRSS 2.0 形式のメインフィードURL -->
	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('comments_rss2_url'); ?>" title="の最新コメント" /><!-- ここではcomments_rss2_urlでRSS 2.0形式のコメントフィードURL -->
	<link rel="pingback" href="<?php bloginfo('pingback_url') ?>" /><!-- ここではpingback_urlでピンバック用URL -->
	
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" /><!-- ここではstylesheet_urlで使用中のメインCSSファイルのURLです -->
	
	<?php wp_head() ?>
	<!-- このwp_headというテンプレートタグは何かを表示するタグではありません。このテンプレートタグはHTMLのheadの目印となります。
	例えば、独自のCSSやJavaScriptを使用しているプラグインは、このwp_headが書かれている場所に、それらCSSやJavaScriptへのリンクを記述するよう設計されています。なので、このwp_headを削除してしまうと、一部のプラグインが動かないケースが考えられます。このwp_headタグは、/headの直前に記述したままで残しておいてください。 -->
</head><!-- ここまで　head -->

<body <?php body_class(); ?> ><!-- ここから body。 -->
<!-- body_classは、表示されているページの種類にしたがって、homeやarchiveやsingleといったクラス属性を表示します。 -->

	<div id="wrapper"><!-- ここから div#wrapperです -->
		<div id="header"><!-- ここから div#headerです -->
			<h1 id="blog-title"><a href="<?php bloginfo('url'); ?>/" title="<?php bloginfo('name'); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
			<!-- ここでもbloginfoテンプレートタグです。パラメータurlを使ってブログのURLを、そしてnameを使ってブログのタイトルを表示しています -->
			<p class="description"><?php bloginfo('description'); ?></p>
			<!-- descriptionは、ブログ管理画面の一般設定のキャッチフレーズに入力された内容が表示されます。 -->
		</div><!-- ここまで header -->