<!-- Kelly Domingues 2014243 -->

<html>
<head></head>
<body>


<?php
	if($_POST){
		session_start();
		$comment = $_POST['comment'];
		echo $comment;
		$id = $_POST['id'];
		echo $id ; 
		$comment_user = $_SESSION['id'];
		echo $comment_user;
		
		// making the connection to the database
		try {
			$host = '127.0.0.1';
			$dbname = 'test';
			$user = 'root';
			$pass = '';
			# MySQL with PDO_MYSQL
			$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		} catch(PDOException $e) {echo 'Error';}  
	
		$sql = "INSERT INTO comments(`comment`, `userid`, `comment_user` ) VALUES(?, ?, ?);";
		$sth = $DBH->prepare($sql);
	
		$sth->bindParam(1, $comment, PDO::PARAM_INT);
		$sth->bindParam(2, $id, PDO::PARAM_INT);
		$sth->bindParam(3, $comment_user, PDO::PARAM_INT);
		$sth->execute();
		
		echo'<script>window.location="profile.php?id=' . $id . '"; </script>';
	}
 
	
?>
		
	</body>
</html>