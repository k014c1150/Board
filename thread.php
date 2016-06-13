<?php
	$trash_icon = "<i class='fa fa-trash-o' aria-hidden='true'></i>";
	$dsn = 'mysql:dbname=thread;host=localhost';
	$user = 'root';
	$password = '';
	try{

		$dbh = new PDO($dsn,$user,$password);
	}catch(Exception $e){
		print('Connection failed:'.$e ->getMessage());
		die();
	}
		if(@$_POST['login']){
			$name = $_POST['name'];
		}	
		if(isset($_POST['add'])){
			$message = $_POST['message'];
			$message = htmlspecialchars($message,ENT_QUOTES);
			$name = $_POST['name'];
			$sql = 'INSERT INTO thread add(null,"name","message",cast( now() as date)) VALUES(:name,:message)';
			$stmt = $dbh -> prepare($sql);
			$stmt ->bindParam(':name',$name);
			$stmt ->bindParam(':message',$message);
			$stmt -> execute();
		}
		if(@$_POST['delete']){
			$id = $_POST['delete'];//削除するデータの特定

			$sql = 'DELETE FROM list WHERE id =:id ';
			$stmt = $dbh ->prepare($sql);
			$stmt ->bindParam(':id',$id);
			$stmt -> execute();

		}	

	$link = mysql_connect("localhost","root","");
	if (!$link) {
		    die('接続失敗です。'.mysql_error());
	}

		$db_selected = mysql_select_db('thread', $link);
	if (!$db_selected){
		    die('データベース選択失敗です。'.mysql_error());
	}

	$result = mysql_query('SELECT id FROM thread');
	mysql_close($link);

	if (!$result) {
	    die('クエリーが失敗しました。'.mysql_error());
	}




?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
		<title>Thread</title>

	</head>
	<body>

	<a href = "index.php" style="float:right;" name ="login">logout</a>
	<form method ="post" action ="thread.php" >
		Mr.<input type = "hidden"  name = "name" value = <?php $name ?>><?php
		echo $name;
		?></p>
	
		<input type = "text" name = "message">
		<input type = "submit" valye = "add" name = "add">
	</form>
	<?php
	while($posts = mysql_fetch_assoc($result))
		{
		echo "<form method = 'post' action = 'thread.php'background-color = '#bde9ba'>";
		echo $posts["name"];
		echo $posts["uptime"];
		$id = $posts["id"];
		echo "<button name = 'delete' value = '" . $id . "'>$trash_icon</button>";
		echo $posts["message"];
		echo "</form>";
		
		}
	?>
	<hr>
	

	
	</body>
</html>
