<?php

	//TODO

	// htmlspecialcharacterを追加

	/******** コードの概要  *********/
	// 1.バリデーション
	// 2.データベースへのインサート
	// 3.投稿フォーム



	/******** バリデーション  *********/

    if (!empty($_POST)) {

    	// titleが空欄＆全角30文字以上、commentが空欄　のエラーメッセージ

        if ($_POST['title'] == '' || $_POST['comment'] == '') {
        	$error['input'] = "blank";
        }else{
        	$error['input'] = "";        	
        }

        if (strlen($_POST['title']) >= 90) {
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
				INSERT INTO `notice`
					(`id`,
					 `title`, 
					 `comment`, 
					 `addfile`, 
					 `created`, 
					 `modified`) 
				 VALUES 
				 	(NULL,
				 	?,
				 	?,
				 	?,
				 	NOW(),
				 	NOW()
			 	)
		 	");

			$stmt->execute($queli_param);

	        header('Location:postNotice_successed.html');
	        exit();

		}
	}

?>



<!DOCTYPE html>
<html>
<head>
	<title>全体掲示板への投稿ページ</title>
	<meta charset="UTF-8">
</head>
<body>

<form method="post">

	<p>タイトル（30文字以内）
		<br><input type="text" name="title" size="40">
	</p>


		<?php if(isset($error)) : ?>
			<?php if($error['length'] == "too much"): ?>
				<p style="color:red;">タイトルは30文字以内で入力してください。</p>
			<?php endif; ?>
		<?php endif; ?>


	<p>投稿内容
		<br><textarea name="comment" rows="8" cols="40"></textarea>
	</p>

		
		<?php if(isset($error)) : ?>
			<?php if($error['input'] == "blank") : ?>
				<p style="color:red;">タイトルまたは投稿内容を入力してください。</p>
			<?php endif; ?>
		<?php endif; ?>


	<p>
		<input type="submit" value="送信"><input type="reset" value="リセット">
	</p>
	
</form>


</body>
</html>