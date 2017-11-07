<!-- Kelly Domingues 2014243 -->

<html>
<head></head>
<body>
<a href="logout.php" style='margin-left: 600'>Logout</a>
<?php

session_start();
$user = $_SESSION ['username'];
echo "<h1>Welcome $user  ! </h1>";

//include 'limit.php';

$id = $_GET['id'];
// making the connection to the database
    try {
        $host = '127.0.0.1';
        $dbname = 'test';
        $user = 'root';
        $pass = '';
        # MySQL with PDO_MYSQL
        $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    } catch(PDOException $e) {echo 'Error';}  

    // selecting the row from the database
    $q = $DBH->prepare("select * from users_table where id = :id");
	$q->bindValue(':id', $id);
	// running the SQL
    $q->execute();
    // pulling the data into a variable
    $check = $q->fetch(PDO::FETCH_ASSOC);
    // taking each individual piece
    $lname = $check['lname'];
	$fname = $check['fname'];
	$tel = $check['tel'];
	$age = $check['age'];
	$email = $check['email'];
	
	   
	echo "<h2>Profile: $fname $lname</h2>";
	echo '<br>';
	echo 'Phone: ' . $tel;
	echo '<br>';
	echo 'Age: ' . $age;
	echo '<br>';
	echo 'Email: ' . $email;
	
	
	
	// selecting the row from the database
    $w = $DBH->prepare("select * from comments where userid=:id");
	$w->bindValue(':id', $id);
    // running the SQL
    $w->execute();
    // pulling the data into a variable
    $rows = $w->fetchall(PDO::FETCH_ASSOC);
    
	//inner loop 
	foreach($rows as $r){
		echo "<p>comment:" . $r['comment'] . '  ';
		echo "<a href='like.php?id=" . $r['id'] ."'>like</a>  ";
		$w = $DBH->prepare("select count(commentid) from likes where commentid=:id");
		$w->bindValue(':id', $r['id']);
		$w->execute();
		$count = $w->fetch(PDO::FETCH_ASSOC);
		echo $count['count(commentid)'] . "</p>";
	}
	 
?>

<br></br>
	<h3> <a href="myfriends.php">My Friends</a></h3>
	<form action="comment.php" method="post">
		Leave a message:<br></br>
		<textarea style='background-color:lightblue' name="comment"></textarea><br>
		<!-- sending id of the friend's profile page with the POST to the other page 
			the type is hidden so that it is not displayed --> 
		<input type="hidden" name="id" value=<?= $id ?> />
		<input type="submit" value="Send"/><br>
	</form>

</body>
</html>