	<div id="sidebar"><!-- ここから div#sidebar -->
	
	<!-- 本来はここにウィジット用のコードが入ります。ウィジットは非常に便利な機能なのですが、逆に、サイドバーのテンプレート構造を学ぶには、わかりにくくしている要因の一つだと思います。
	そこで、このManabiThemeの初級編では、ウィジット機能を実装しないサイドバーのテンプレートを採用し、分かりやすくしています。
	なお、最新版のWordPressでも問題なく機能しますが、管理画面のウィジットの設定ページを表示すると「ウィジェットは使用できません」と表示されます。試してみてください。 -->
	
	<!-- サイドバーに表示される情報の各「ブロック」のコードの構造に関して特に決まりはありません。ウィジットにした場合も、コードは指定できます。
	しかし、WordPressに付属するdefaultテーマも、ウィジットのディフォルト設定も、ulの入れ子になっていますので、ここではそれに従ったコーディングを行っています。
	div#sidebarの直下に1つの大きなulが存在します。各「情報のブロック」はこのulの子liとして存在しています。
	各liの中にはh2とulが存在しており、それぞれ、h2が「情報のブロック」の見出し、ulリストが「情報のブロック」の内容です。 -->

		<ul><!-- ここから、div#sidebar直下のulが始まります。 -->
		
			<li><h2>Pages</h2>
			<ul>
				<?php wp_list_pages('title_li='); ?>
				<!--　wp_list_pagesはPage（例えばAbout,Profile、等）へのリンクリストを表示します。ディフォルトではリストの見出しが表示されますが、ここではパラメータにtitle_liを指定して表示させないように設定しています。 -->
			</ul>
			</li>
			
			<li><h2>最近の投稿5件</h2>
			<ul>
				<?php wp_get_archives('type=postbypost&limit=5'); ?>
				<!-- wp_get_archivesは日付ベースのアーカイブリストを表示します。ここでは、月のリストではなく、最近投稿された5つの記事のタイトルのリストを表示するように、パラメータを設定しました。
				wp_get_archivesで表示される月や記事のリストは、リンク付きで、HTMLタグのliに囲まれて表示されます。なので、このwp_get_archivesテンプレートタグをHTMLタグのulで囲んでやります。 -->
			</ul>
			</li>
		
			<li><h2>カテゴリ</h2>
			<ul>
				<?php wp_list_categories('show_count=1&title_li='); ?>
				<!--　wp_list_categoriesはリンク付カテゴリのリストを表示します。パラメータでは各カテゴリの投稿数を表示するように指定してあります。ディフォルトではリストの見出しが表示されますが、ここではパラメータにtitle_liを指定して表示させないように設定しています。 -->
			</ul>
			</li>
		
			<li><h2>タグ</h2>
			<ul>
				<?php wp_tag_cloud('smallest=8&largest=14&orderby=count&order=DESC'); ?>
				<!-- wp_tag_cloudはタグ・クラウドを表示させる為のテンプレートタグです。このタグはパラメータが沢山あります。ここではパラメータの組み合わせで、使用頻度が多い順から表示させるようにしている他、フォントのサイズを最小8ptから最大14ptとしています。 -->
			</ul>
			</li>
		
			<li><h2>月別</h2>
			<ul>
				<?php wp_get_archives('type=monthly'); ?>
				<!-- 最近の投稿5件で使用したのと同じテンプレートタグwp_get_archivesです。ここではtype=monthlyとパラメータを指定し、記事が投稿された月のリストを全て表示するように設定してあります。 -->
			</ul>
			</li>
			
			<li><h2>ブログ内を検索</h2>
					<!-- ブログ内検索の検索フォームとボタンです。一般的には、この検索フォーム専用のテンプレートを作り、インクルードタグで呼び出せるようモジュール化するのがポピュラーなやり方ですが決まりはありません。 -->
					<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
						<label class="hidden" for="s">検索:</label>
						<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" />
						<input type="submit" id="searchsubmit" value="検索する" />
					</form>
			</li>
			
			<li><h2>RSSフィード</h2>
			<ul>
					<li><a href="<?php bloginfo('rss2_url') ?>" title="<?php echo wp_specialchars(get_bloginfo('name'), 1) ?>" rel="alternate" type="application/rss+xml">ブログ記事のRSSフィード</a></li>
					<li><a href="<?php bloginfo('comments_rss2_url') ?>" title="<?php echo wp_specialchars(bloginfo('name'), 1) ?>" rel="alternate" type="application/rss+xml">コメントのRSSフィード</a></li>
			</ul>
			</li>
			
			<li><h2>管理用</h2>
			<ul>
				<li><?php wp_loginout(); ?></li>
			</ul>
			<?php wp_meta(); ?>
			</li>
		
		<ul><!-- ここまでがdiv#sidebar直下のulです。 -->
	
	</div><!-- ここまで div#sidebar -->
