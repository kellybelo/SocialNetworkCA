<!-- Kelly Domingues 2014243 -->

<html>
<title>MY FRIENDS</title>
<body>

<?php
session_start();

$user = $_SESSION ['username'];
$id = $_SESSION ['id'];

echo "<h3>Friends of <a href='profile.php?id=" . $id ."'>" . $user . "</a></h3>";

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
    
	$q = $DBH->prepare("select  id , username from users_table where id!=?");
	//$q = $DBH->prepare("select  id , username from users_table");
    $q->bindValue(1, $id);
	// running the SQL
    $q->execute();
    // pulling the data into a variable
    $rows = $q->fetchall(PDO::FETCH_ASSOC);
    // For loop with array getting the ID of the friend and its username, linking to its profile page.
    foreach($rows as $r){
		echo "<p><a href='profile.php?id=" . $r['id'] ."'>" . $r['username'] . "</a></p>";
		
	}


?>
<br></br>
