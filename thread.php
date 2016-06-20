<?php
	$trash_icon = "<i class='fa fa-trash-o' aria-hidden='true'></i>";
	$dsn = 'mysql:dbname=Board;host=localhost';
	$user = 'root';
	$password = '';
	$name = '';

	if(!isset($_POST['name']))
	{
		print('<script type="text/javascript">
		location.replace("./");
		</script>');
	}

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
			$sql = "INSERT INTO thread (name,message,uptime) VALUES(:name,:message,:uptime)";
			$stmt = $dbh -> prepare($sql);
			$stmt ->bindValue(':name',$name);
			$stmt ->bindValue(':message',$message);
			$stmt ->bindValue(':uptime',date("Y-m-d H:i:s"));
			$stmt -> execute();
		}
		if(@$_POST['delete']){
			$id = $_POST['delete'];//削除するデータの特定
			$name = $_POST['name'];
			$sql = 'DELETE FROM thread WHERE id=:id';
			$stmt = $dbh ->prepare($sql);
			$stmt ->bindParam(':id',$id);
			$stmt -> execute();

		}

?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Thread</title>

	</head>
	<body>

	<a href = "index.php" style="float:right;" name ="login">logout</a>
	<form method ="post" action ="thread.php" >
		<input type = "hidden"  name = "name" value = <?php print($name); ?>>
		Mr.<?php echo $name;?>

		<input type = "text" name = "message">
		<input type = "submit" value = "add" name = "add">
	</form>
	<?php
	$stt = $dbh->prepare('SELECT * FROM thread ORDER BY uptime DESC');
	$stt->execute();
	while($row = $stt->fetch()){

		echo "<form method = 'post' action = 'thread.php' background-color = '#bde9ba'>";
		echo $row["name"];
		echo $row["uptime"];
		$id = $row["id"];
		echo "<button name = 'delete' value = '" . $id . "'>x</button>";
		echo "<input type = 'hidden' name = 'name' value = '".$name."'>";
		echo $row["message"];
		echo "</form>";

		}
	?>
	<hr>



	</body>
</html>
