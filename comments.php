<?php // この冒頭の部分は、コメントテンプレートが正しく機能する為に必要な記述です。絶対に削除しないでください
	if (isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
	
	if ( post_password_required() ) { ?>
			<div class="nocomments">
				<p>この記事は保護されています。コメントを観覧するにはパスワードを入力してください。</p>
			</div>
	<?php
		return;
	}
?>

<!-- ここより下を自由に変更することができます。 -->
<!-- なお、WordPressでは基本的に「コメント＝コメント＋トラックバック（以下、TB）＋ピンバック（以下、PB）」とされています。これらを分けて表示したりする方法もありますが、ここではディフォルトのまま、全てをコメントとして扱います。 -->

<!-- まず、表示している記事に対して寄せられたコメントのリストを表示します。 -->
		<?php if ( have_comments() ) ://WPコメントループ -始まり- もしもコメントがあれば ?>
			
			<h3>現在のコメント数は<?php comments_number('0','1つ','%つ'); ?>です</h3>
			<!-- comments_numberはコメント数を表示します。パラメーターはそれぞれ数がゼロの場合、１の場合、1以上の場合、です。 -->
			<p>この記事への<a href="<?php echo get_post_comments_feed_link(); ?>" title="この記事へのコメントのRSSフィード" rel="alternate" type="application/rss+xml">コメントのRSSフィード</a></p>
			
			<!-- WordPressの管理画面の設定にて、コメント数が多い場合に複数のページに分けて表示することを設定できます。
			これはコメントページ用のナビゲーションリンクです。 -->
			<div class="navigation">
				<div class="alignleft"><?php previous_comments_link(); ?></div><!-- １つ前のコメントページ -->
				<div class="alignright"><?php next_comments_link(); ?></div><!-- １つ先のコメントページ -->
			</div>
			
			<!-- 次の3行でコメントリストを表示しています。
			テンプレートタグのwp_list_commmentsが、寄せられたコメント情報を全て取得し、表示してくれます。各コメントはそれぞれHTMLタグのliで囲まれて表示されます。
			その為、wp_list_commentsをHTMLタグのolで囲んでやります。
			なお、wp_list_commentsにて表示される内容やコーディングは全てカスタマイズをする事ができますが、この初級レベルではディフォルトのまま表示させることにします。
			デザインはCSSでカスタマイズができます。 -->
			<ol class="commentlist">
				<?php wp_list_comments();?><!-- 現在表示されている投稿に対しての全てのコメントを表示。 -->
			</ol>
			
			<!-- WordPressの管理画面の設定にて、コメント数が多い場合に複数のページに分けて表示することを設定できます。
			これはコメントページ用のナビゲーションリンクです。上部のコメント用ナビゲーションリンクと同じです。 -->
			<div class="navigation">
				<div class="alignleft"><?php previous_comments_link(); ?></div><!-- １つ前のコメントページ -->
				<div class="alignright"><?php next_comments_link(); ?></div><!-- １つ先のコメントページ -->
			</div>
			
		<?php else ://WPコメントループ - もしもコメントがまだ無ければ ?>
			
			<!-- WordPressの管理画面から、ブログ全体もしくは記事別にコメントの受付をしない設定をすることができます。ここでは、条件分岐を使って、コメントができるかどうかで違う内容を表示させます。 -->
			<?php if ( comments_open() ) ://条件分岐 -始まり- もしもコメントの投稿が許可されているのであれば ?>
				<h3>現在コメントはまだありません</h3>
			<?php else ://それ以外、つまり、もしもコメントの投稿が許可されていいないのであれば ?>
				<h3>現在のコメント数は<?php comments_number('0','1つ','%つ'); ?>です</h3>
				<p class="nocomments">この記事へのコメントの投稿の受付は終了しました。</p>
			<?php endif;//条件分岐 -終わり-  ?>
		
		<?php endif;//WPコメントループ -終わり- ?>
		
		
<!-- ここまでがコメントのリストです。次に、コメントを投稿するためのフォームを表示します。３つの条件分岐が入れ子になっているので、それぞれA、B、Cとしました。 -->
		<?php if ( comments_open() ) ://条件分岐A -始まり- もしもコメントの投稿が許可されているのであれば ?>
			<div id="respond"><!-- まず、必ず、div#respondで囲んでください。コメントをスレッド表示する場合は、このdiv#respondを目印にしてJavaScriptがスレッド処理を行います。 -->
				<h3><?php comment_form_title('コメントを投稿する','%s さんに対してコメントを投稿する'); ?></h3><!-- コメント投稿欄の見出しです。パラメータの1つめは、通常の表示を指定。パラメータの2つめは特定のコメントに対しての返信時の表示。 -->
				<div id="cancel-comment-reply"> 
					<small><?php cancel_comment_reply_link() ?></small><!-- cancel_comm...は返信ボタンをクリックした後にキャンセルしたいときに、キャンセルのリンクを表示するタグです。 -->
				</div> 
				
				<?php if ( get_option('comment_registration') && !is_user_logged_in() ) ://条件分岐２ -始まり- もしもコメントを投稿する人がログインしておらず、かつ、コメントするのにログインする必要があれば ?>
				<p><?php printf(('コメントを投稿するには<a href="%s">ログイン</a>する必要があります。'), wp_login_url( get_permalink() )); ?></p>
				<?php else ://条件分岐B それ以外、つまり、コメントするのにログインする必要なければ以下を表示 ?>
				
				<!-- ここからが投稿フォームの本体です -->
				<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform"><!-- HTMLタグのformは通常はこのまま。編集する必要はありません。 -->
					<?php if ( is_user_logged_in() ) ://条件分岐C -始まり- もしもログインしている場合は以下を表示 ?>
					<p><?php printf(('ユーザー名「<a href="%1$s">%2$s</a>」でログインしています。'), get_option('siteurl') . '/wp-admin/profile.php', $user_identity); ?> <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php echo"このアカウントからログアウトする。"; ?>"><?php echo "ログアウト &raquo;"; ?></a></p>
					<?php else ://条件分岐C - それ以外、つまりログインしているユーザー以外の場合は、以下を表示 ?>
					
					<!-- 名前、メール、ウェブサイトのURL、コメント入力欄、それぞれを表示する順番に決まりはありませんが、ここでは以下の順番としました。
					なお、inputのHTMLタグをpタグで囲むか、また、labelタグの中にsmallタグは必要か、は任意ですが、それ以外の内容は基本的にそのままで、変更の必要は特に生じません。 -->
					<!-- まず最初に名前。 -->
					<p><input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="50" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
<label for="author"><small>名前<?php if ($req) echo "（必須）"; ?></small></label></p>
					<!-- 続いてメール。 -->
					<p><input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="50" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
<label for="email"><small>メール<?php if ($req) echo "（必須）"; ?></small></label></p>
					<!-- 続いてウェブサイトのURL。 -->
					<p><input type="text" name="url" id="url" value="<?php echo  esc_attr($comment_author_url); ?>" size="50" tabindex="3" />
<label for="url"><small>ウェブサイトのURL</small></label></p>
					
					<?php endif;//条件分岐C -終わり- ここでログインしている、していない、の条件を終わります。 ?>
				
				<!-- 最後にコメント入力欄。 -->
				<p><textarea name="comment" id="comment" cols="58" rows="10" tabindex="4"></textarea></p>
				
				<!-- そして投稿用のボタン。 -->
				<p><input name="submit" type="submit" id="submit" tabindex="5" value="コメントを投稿する" /><?php comment_id_fields(); ?></p>
				
				<?php do_action('comment_form', $post->ID); //コメントが投稿された際にWordPressが処理を行う用のおまじないです！必須です！ ?>
				
				</form>
				<!-- コメント投稿フォームはここまで -->
				
				<?php endif; //条件分岐B -終わり- もしもコメントを投稿する人がログインしておらず、コメントするのにログインする必要があれば ?>
			</div><!-- div#respondの終わり -->
		
		<?php endif; //条件分岐A -終わり- もしもコメントの投稿が許可されているのであれば ?>
