<?php
// create random number
$id = rand(0,10000);

echo $id;

 // insert record into database 
    try {
        $host = '127.0.0.1';
        $dbname = 'test';
        $user = 'root';
        $pass = '';
        # MySQL with PDO_MYSQL
        $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    } catch(PDOException $e) {echo 'Error';}  

    $sql = "INSERT INTO `f_password` (`rand_num`, `uid`) VALUES (?, '1');";
    $sth = $DBH->prepare($sql);
	
	$sth->bindParam(1, $id, PDO::PARAM_INT);

	
	$sth->execute();
    
//= send email
//  mail()

     echo '<a href="forgotpassword.php?id='. $id . '  ">Link</a>    ';           






?>