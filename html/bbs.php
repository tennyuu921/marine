<?php

	//	OUTLINE
	//	データベースからのデータ表示
	//	データベースへの入力（コメント)
	//	データベースへの入力（新規投稿）

	//	TODO
	//	コメントのページネーション


	/************************ データベースへの表示処理 ************************/

		//クエリ作成・インサート
		require("../config/db-connect.php");

		$stmt = $dbh->prepare("
			SELECT * FROM `message`
			ORDER BY id DESC
		");

		$stmt->execute();

	    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	      $rows[] = $row; 
	    }


		//ページネーション用数値の設定	
		// $page : 現在のページ
		// $page_count : 一件あたりで表示する件数
		// $page_max : 全件取得時のページ数

		if(!empty($_GET['pagenation'])){
			$page = $_GET['pagenation'];
		}else{
			$page = 0;		
		}
		$page_count = 5;
		$page_max = floor(count($rows) / $page_count);



	/************************ データベースへの入力処理（新規コメント） ************************/

		/******** バリデーション  *********/

	    if (!empty($_POST) && ($_POST['type'] == "comment")) {

	        if ($_POST['comment_title'] == '' || $_POST['comment_comment'] == '' || $_POST['comment_editor'] == '') {
	        	$error['comment_input'] = "blank";
	        }else{
	        	$error['comment_input'] = "";        	
	        }

	        if (strlen($_POST['comment_title']) >= 90 || strlen($_POST['comment_editor']) >= 90) {
	        	$error['comment_length'] = "too much";
	        }else{
	        	$error['comment_length'] = "";        	
	        }

			/******** データベースへのインサート  *********/
			require("../config/db-connect.php");

			if($error['comment_input'] == "" && $error['comment_length'] == ""){

				//フォームから受け取った値の格納
				$queli_param[0] = $_POST['message_id'];
				$queli_param[1] = $_POST['comment_title'];
				$queli_param[2] = $_POST['comment_comment'];
				$queli_param[3] = $_POST['comment_editor'];

				var_dump($_POST);

				//クエリ作成・インサート
				$stmt = $dbh->prepare("
					INSERT INTO `comment`(
						`message_id`, 
						`title`, 
						`comment`, 
						`editor`, 
						`created`, 
						`modified`) 
					VALUES (
						?,
						?,
						?,
						?,
						NOW(),
						NOW()
					)
			 	");

				$stmt->execute($queli_param);

		        header('Location:bbs_success.html');
		        exit();

		}
	}

	/************************ コメントの表示処理 ************************/

		//クエリ作成・インサート
		require("../config/db-connect.php");

		$stmt = $dbh->prepare("
			SELECT * FROM `comment`
			ORDER BY id DESC
		");

		$stmt->execute();

	    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	      $comment_rows[] = $row; 
	    }


		//ページネーション用数値の設定	
		// $comment_page : 現在のページ
		// $comment_page_count : 一件あたりで表示する件数
		// $comment_page_max : 全件取得時のページ数

		if(!empty($_GET['comment_pagenation'])){
			$comment_page = $_GET['comment_pagenation'];
		}else{
			$comment_page = 0;
		}

		$comment_page_count = 5;
		$comment_page_max = floor(count($comment_rows) / $comment_page_count);



	/************************ データベースへの入力処理（新規投稿） ************************/

		/******** バリデーション  *********/

	    if (!empty($_POST) && ($_POST['type'] == "message")) {

	        if ($_POST['title'] == '' || $_POST['comment'] == '' || $_POST['editor'] == '') {
	        	$error['input'] = "blank";
	        }else{
	        	$error['input'] = "";        	
	        }

	        if (strlen($_POST['title']) >= 90 || strlen($_POST['editor']) >= 90) {
	        	$error['length'] = "too much";
	        }else{
	        	$error['length'] = "";        	
	        }

			/******** データベースへのインサート  *********/
			require("../config/db-connect.php");

			if($error['input'] == "" && $error['length'] == ""){

				//フォームから受け取った値の格納
				$queli_param[0] = $_POST['title'];
				$queli_param[1] = $_POST['comment'];
				$queli_param[2] = "addfile";

				//クエリ作成・インサート
				$stmt = $dbh->prepare("
					INSERT INTO `message`(
						`title`, 
						`comment`, 
						`editor`, 
						`created`, 
						`modified`) 
					VALUES (
						?,
						?,
						?,
						NOW(),
						NOW()
					)
			 	");

				$stmt->execute($queli_param);

		        header('Location:bbs_success.html');
		        exit();

		}
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>メンバー向け掲示板</title>
	<meta charset="UTF-8">
</head>
	<body>

	<!-- 投稿表示 -->
		<h3>投稿表示</h3>

		<?php if(isset($error)) : ?>
			<?php if($error['comment_length'] == "too much"): ?>
				<p style="color:red;">タイトル・投稿者は30文字以内で入力してください。</p>
			<?php endif; ?>
		<?php endif; ?>

		<?php if(isset($error)) : ?>
			<?php if($error['comment_input'] == "blank") : ?>
				<p style="color:red;">タイトル・投稿内容・投稿者を全て入力してください。</p>
			<?php endif; ?>
		<?php endif; ?>




		<?php 
			/* $page_max == $page と、$page_max != $page の２パターン
					＊ページネーションの最終ページだけ表示する個数が違う */

			if($page == $page_max): 
		?>

			<?php
				// $page をベースに、message テーブルのデータを出力
				for ($i = $page * $page_count; $i < count($rows) % $page_count + $page * $page_count ; $i++): 
			?>

				<p>投稿ID
				<?php echo $rows[$i]["id"]; ?>
				</p>

				<p>タイトル
				<?php echo $rows[$i]["title"]; ?>
				</p>

				<p>投稿内容
				<?php echo $rows[$i]["comment"]; ?>
				</p>

				<p>投稿日時
				<?php echo $rows[$i]["created"]; ?>
				</p>

				<form method="post">

					<input type="hidden" name="type" value="comment">

					<input type="hidden" name="message_id" value="<?php echo($rows[$i]["id"]); ?>">

					<p>タイトル（30文字以内）
						<br><input type="text" name="comment_title" size="40">
					</p>

					<p>コメント内容
						<br><textarea name="comment_comment" rows="4" cols="40"></textarea>
					</p>

					<p>投稿者
						<br><input type="text" name="comment_editor" size="10">
					</p>

					<p>
						<input type="submit" value="投稿"><input type="reset" value="リセット">
					</p>
					
				</form>

				<br>

			<?php endfor; ?>

		<?php else: ?>

			<?php for ($i = $page * $page_count; $i < $page_count + $page * $page_count ; $i++): ?>

				<p>投稿ID
				<?php echo $rows[$i]["id"]; ?>
				</p>

				<p>タイトル
				<?php echo $rows[$i]["title"]; ?>
				</p>

				<p>投稿内容
				<?php echo $rows[$i]["comment"]; ?>
				</p>

				<p>投稿日時
				<?php echo $rows[$i]["created"]; ?>
				</p>

				<form method="post">

					<input type="hidden" name="type" value="comment">

					<input type="hidden" name="message_id" value="<?php echo($rows[$i]["id"]); ?>">

					<p>タイトル（30文字以内）
						<br><input type="text" name="comment_title" size="40">
					</p>

					<p>コメント内容
						<br><textarea name="comment_comment" rows="4" cols="40"></textarea>
					</p>

					<p>投稿者
						<br><input type="text" name="comment_editor" size="10">
					</p>

					<p>
						<input type="submit" value="投稿"><input type="reset" value="リセット">
					</p>
					
				</form>

				<br>

			<?php endfor; ?>

		<?php endif; ?>


	<!-- ページネーション -->
		<?php if($page > 0): ?>
		<?php echo('<a href="?pagenation='. ($page - 1) . '">前へ</a>'); ?>
		<?php endif; ?>

		<?php if($page < $page_max): ?>
		<?php echo('<a href="?pagenation='. ($page + 1) . '">次へ</a>'); ?>
		<?php endif; ?>


	<!-- 新規投稿 -->
		<h3>新規投稿</h3>

		<form method="post">

			<input type="hidden" name="type" value="message">

			<p>タイトル（30文字以内）
				<br><input type="text" name="title" size="40">
			</p>

			<p>投稿内容
				<br><textarea name="comment" rows="8" cols="40"></textarea>
			</p>

			<p>投稿者
				<br><input type="text" name="editor" size="10">
			</p>

				<?php if(isset($error)) : ?>
					<?php if($error['length'] == "too much"): ?>
						<p style="color:red;">タイトル・投稿者は30文字以内で入力してください。</p>
					<?php endif; ?>
				<?php endif; ?>

				<?php if(isset($error)) : ?>
					<?php if($error['input'] == "blank") : ?>
						<p style="color:red;">タイトル・投稿内容・投稿者を全て入力してください。</p>
					<?php endif; ?>
				<?php endif; ?>

			<p>
				<input type="submit" value="投稿"><input type="reset" value="リセット">
			</p>
			
		</form>
	</body>
</html>