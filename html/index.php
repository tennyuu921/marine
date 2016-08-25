<?php 

	// TODO
	// - デザイン
	// - ページネーションの実装（数値を表示するところが未了）
	// - カレンダーを追加

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

?>

<!DOCTYPE html>
<html>
<head>
	<title>トップページ</title>
	<meta charset="UTF-8">
</head>
<body>

<?php if($page == $page_max): ?>

	<?php for ($i = $page * $page_count; $i < count($rows) % $page_count + $page * $page_count ; $i++): ?>

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

		<br>

	<?php endfor; ?>


<?php endif; ?>

<?php if($page > 0): ?>
<?php echo('<a href="?pagenation='. ($page - 1) . '">前へ</a>'); ?>
<?php endif; ?>

<?php if($page < $page_max): ?>
<?php echo('<a href="?pagenation='. ($page + 1) . '">次へ</a>'); ?>
<?php endif; ?>

</body>
</html>