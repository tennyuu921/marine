<?php 

	// TODO
	// - デザイン
	// - ページネーションの実装（数値を表示するところが未了）
	// - カレンダーを追加



	//ページネーション用数値の設定	
	if(!empty($_GET['pagenation'])){
		$page = $_GET['pagenation'];
	}else{
		$page = 0;		
	}

	require("../config/db-connect.php");

	//クエリ作成・インサート
	$stmt = $dbh->prepare("
		SELECT * FROM `notice`
		ORDER BY id DESC
	");

	$stmt->execute();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      $rows[] = $row; 
    }

?>

<!DOCTYPE html>
<html>
<head>
	<title>トップページ</title>
	<meta charset="UTF-8">
</head>
<body>

<?php for ($i = $page * 10; $i < 10 + $page * 10 ; $i++): ?>

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

	<br>

<?php endfor; ?>

</body>
</html>