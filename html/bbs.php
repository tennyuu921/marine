<?php

	/******** データベースへのインサート  *********/
	require("../config/db-connect.php");

	if($error['input'] == "" && $error['length'] == ""){

		//フォームから受け取った値の格納
		$queli_param[0] = $_POST['title'];
		$queli_param[1] = $_POST['comment'];
		$queli_param[2] = $_POST['editor'];

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

//        header('Location:postNotice_successed.html');
//        exit();

	}

?>




<!DOCTYPE html>
<html>
<head>
	<title>メンバー向け掲示板</title>
	<meta charset="UTF-8">
</head>
<body>

<form method="post">

	<p>タイトル（30文字以内）
		<br><input type="text" name="title" size="40">
	</p>

	<p>投稿内容
		<br><textarea name="comment" rows="8" cols="40"></textarea>
	</p>

	<p>投稿者
		<br><textarea name="comment" rows="1" cols="10"></textarea>
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