<!-- Kelly Domingues 2014243 -->
<?php
session_start();

 $comment_id = $_GET['id']; // the id of the comment to like
 $your_user_id = $_SESSION['id'];
    try {
        $host = '127.0.0.1';
        $dbname = 'test';
        $user = 'root';
        $pass = '';
        # MySQL with PDO_MYSQL
        $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		
		$sql = "INSERT INTO `likes` (`userid`, `commentid`) VALUES (?, ?);";
		$sth = $DBH->prepare($sql);
	
		$sth->bindParam(1, $your_user_id, PDO::PARAM_INT);
		$sth->bindParam(2, $comment_id, PDO::PARAM_INT);
	
		$sth->execute();
    
		echo 'recorded';
	
	
    } catch(PDOException $e) {echo $e;}  

   

?>

<script>
   window.history.back();

</script>