<?php get_header();//ヘッダーテンプレート（header.php）を読み込む ?>
<!-- あるテンプレートファイルの中で他のテンプレートファイルを実行することを容易にするテンプレートインクルードタグというテンプレートタグが存在します。その内、テーマに通常含まれるテンプレートに関しては、専用のテンプレートインクルードタグが用意されています。get_headerはheader.phpを読み込む為のインクルードタグです。 -->

		<div id="contents"><!-- ここから div#contentsです -->
			
			<!-- ここからWordPressループです。 -->
			<!-- 「WordPressループ」とは、投稿されたブログ記事を表示させるために使うPHPコードのセットのことです。WordPressはこの「ループ」を使って、現在のページに表示される各記事を処理したり、ループタグ内で指定された基準にそって記事の形式を整えたりします。 -->
			<!-- 例えば、ブログのトップページに最新の記事を５つ表示させる設定をしているとします。WordPressはその設定にしたがい、このループにて最新の記事5つをデータベースから取得し、このループにて記述されたコードに従ってその内容を表示します。 -->
			<!-- 記事1つ（記事、ページ等）であろうが、複数（カテゴリ別アーカイブ等）であろうが、ブログに投稿された記事を表示させるにはこのWordPressループが必ず必要と覚えておいてください。 -->
			
			<?php if (have_posts()) ://WPループ -始まり- もしも該当する記事があれば ?>
			
				<!-- ここでは、WordPressのテンプレートの条件分岐を用いて、アーカイブ表示の時は、「Archive」タイトルとそのカテゴリ名もしくはタグ名もしくは年月を表示することにします。また、検索結果を表示する時は「検索結果」タイトルを表示することにします。 -->
				<?php if (is_category()) {//条件分岐 -始まり- もしもこのページがカテゴリのアーカイブであれば以下を表示 ?>
					<h2 id="archive-title">Archive</h2>
					<p><strong>カテゴリ： <?php single_cat_title(); ?></strong></p>
				<?php } elseif (is_tag()) {//条件分岐 もしもこのページがタグのアーカイブであれば以下を表示 ?>
					<h2 id="archive-title">Archive</h2>
					<p><strong>タグ： <?php single_tag_title(); ?></strong></p>
				<?php } elseif (is_month()) {//条件分岐 もしもこのページが月のアーカイブであれば以下を表示 ?>
					<h2 id="archive-title">Archive</h2>
					<p><strong><?php the_time('Y年n月'); ?></strong></p>
				<?php } elseif (is_archive()) {//条件分岐 それら以外のアーカイブであれば以下を表示 ?>
					<h2 id="archive-title">Archive</h2>
				<?php }//条件分岐 -終わり- ?>
				<?php if (is_search()) {//条件分岐 -始まり- もしもこのページが検索結果であれば以下を表示 ?>
					<h2 id="archive-title">検索結果</h2>
				<?php }//条件分岐 -終わり- ?>
			
				<!-- 一般的にページの上部に表示される、１つ古い記事やページ、１つ新しい記事やページ、へのナビゲーションリンクです。
				個別記事のページ用と、それ以外のページ用ではテンプレートタグが違うので、条件分岐を用いて、ページに合わせたタグを使っています。 -->
				<div class="navigation">
				<?php if (is_single()) {//条件分岐 -始まり- もしも個別記事のページであれば以下を表示 ?>
					<div class="alignleft"><?php previous_post_link('&laquo; %link');　?></div>
					<div class="alignright"><?php next_post_link('%link &raquo;'); ?></div>
					<!-- previous...は１つ前の記事へのリンク。next...は１つ前への記事へのリンクです。各パラメータの%linkは、該当する投稿の記事タイトルをリンク付きで表示してくれます。 -->
				<?php } else {//条件分岐 - そのページ、つまり個別記事のページ、以外であれば以下を表示 ?>
					<div class="alignleft"><?php next_posts_link('&laquo; 古い投稿'); ?></div>
					<div class="alignright"><?php previous_posts_link('新しい投稿 &raquo;'); ?></div>
					<!-- previous...は１つ前の記事へのリンク。next...は１つ前への記事へのリンクです。 -->
				<?php } //条件分岐 -終わり-  ?>
				</div>
			
				<?php while (have_posts()) : the_post();//WPループ - それら該当記事を以下のコードの従って表示する ?>
					<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> ><!-- ここから div#post-IDです。 -->
					<!-- the_IDは、その記事のIDを表示します。このテンプレートタグをid属性の表示に使うことで、各記事には#post-[各記事のID]というID属性がつきます。post_classはこのpost、つまり記事ですが、その内容に応じてpostやカテゴリ名やタグID等の情報をクラス属性として表示します。 -->
						<div class="entry-head">
							<h2 class="entry-title"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>" rel="bookmark"><?php the_title() ?></a></h2>
							<!-- the_titleは記事のタイトルです。the_permalinkは記事のパーマリンクです。the_title_attributeも記事のタイトルを表示しますが、タイトルからHTMLが取り除かれる他、一部の文字が実態参照に変換されます。これらテンプレートタグはWPループの中でしか使えません。 -->
							<?php if ( !is_page()) {//条件分岐 -始まり- もしもPage以外のページであれば以下を表示する。　（Pageの記事では普通コメント数やカテゴリ、タグ等は不要の為、ここではPage以外のページでひゅうじするようにしました。）  ?>
							<p class="entry-meta">投稿日：<?php the_time('Y-m-d'); ?> | コメント数：<?php comments_popup_link('0','1','%'); ?> | カテゴリ：<?php the_category(', '); ?> | タグ：<?php the_tags('' , ', ' , ''); ?><?php edit_post_link('| <strong>この記事を編集する</strong>'); ?></p>
							<!-- the_timeで投稿日を表示します。記法はPHPのそれに従っています。comments_popup_linkは、この記事に寄せられたコメント数をコメントリストへのリンクとして表示します。the_categoryとthe_tagsはそれぞれカテゴリとタグを表示。edit_post_linkはログインしているユーザーにのみ表示され、リンクをクリックすると、管理画面の投稿編集ページへ移動します。これらテンプレートタグはWPループの中でしか使えません。 -->
							<?php } //条件分岐 -終わり- ?>
						</div>
						<div class="entry-body">
							<?php the_content('&raquo; 続きを読む'); ?>
							<!-- このthe_contentテンプレートタグで、投稿された記事の本文を表示します。パラメータで指定しているのは、本文の記事の続きを表示させるリンクの文字を設定しています。 -->
						</div>
					</div><!-- ここまで div#post-IDです -->
					
					<!-- 個別記事を表示する場合は、ここでコメントやピンバック、トラックバックのリスト及びコメントフォームを表示させます。
					まず条件分岐を用いて「個別記事のみ」と指定してやります。WordPressのテーマにはコメント欄及び投稿フォーム専用のテンプレートファイルが用意されています。
					テンプレートインクルートタグを使って、コメント用テンプレートファイルを呼び出します。 -->
					<?php if (is_single()) {//条件分岐 -始まり- もしも個別記事のページであれば以下を表示 ?>
						<?php comments_template();//コメントテンプレート（comments.php）を読み込む ?>
					<?php } //条件分岐 -終わり- ?>
					
				<?php endwhile;//WPループ - 該当する記事を表示し終えたら以下を表示する ?>
				
				<!-- ページの下部に表示される、１つ古い記事やページ、１つ新しい記事やページ、へのナビゲーションリンクです。コーディングの内容や用いていいるテンプレートタグは、ページ上部のものと全く同じです。 -->
				<div class="navigation">
				<?php if (is_single()) {//条件分岐 -始まり- もしも個別記事のページであれば以下を表示 ?>
					<div class="alignleft"><?php previous_post_link('&laquo; %link');　?></div>
					<div class="alignright"><?php next_post_link('%link &raquo;'); ?></div>
				<?php } else {//条件分岐 - そのページ（ここでは個別記事のページ）以外であれば以下を表示 ?>
					<div class="alignleft"><?php next_posts_link('&laquo; 古い投稿'); ?></div>
					<div class="alignright"><?php previous_posts_link('新しい投稿 &raquo;'); ?></div>
				<?php } //条件分岐 -終わり- ?>
				</div>
			
			<?php else ://WPループ - もしも該当する記事が無ければ以下を表示する ?>
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
					<div class="entry-head">
						<h2 class="entry-title"><strong>エラーです！！</strong></h2>
					</div>
					<div class="entry-body">
						<p><strong>該当する記事が見つからないか、存在しません。もしくは、何か不具合が発生した可能性があります。</strong></p>
					</div>
				</div>
			
			<?php endif;//WPループ -終わり-  ?>
			<!-- ここまでがWordPressループです。 -->
		
		</div>
		
		<?php get_sidebar();//サイドバーテンプレート（sidebar.php）を読み込む ?>
		<!-- テンプレートインクルードタグです。get_sidebarはsidebar.phpを読み込む為のインクルードタグです。 -->
	
	<?php get_footer();//フッターテンプレート（footer.php）を読み込む ?>
	<!-- これもテンプレートインクルードタグです。get_footerはfooter.phpを読み込む為のインクルードタグです。 -->