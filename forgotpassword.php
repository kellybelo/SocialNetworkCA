<?php

if($_POST){

    //$username = $_POST['username'];
    $newpassword = $_POST['newpassword'];	
	
	echo $newpassword;
}

//$id = $_GET['1'];

//echo $id;

 try {
        $host = '127.0.0.1';
        $dbname = 'test';
        $user = 'root';
        $pass = '';
        # MySQL with PDO_MYSQL
        $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    } catch(PDOException $e) {echo 'Error';}  

    $q = $DBH->prepare("select * from f_password where rand_num = :rand");
    $q->bindValue(':rand', $id);

    $q->execute();
    $check = $q->fetch(PDO::FETCH_ASSOC);
    
   
    if($check){
            $sql = "delete from f_password where rand_num = '$id'";
            $sth = $DBH->prepare($sql);
	
	
	
            $sth->execute();
        echo 'exists';
        echo 'Reset your password......';
    } else {
        
        die('sorry invalid link');
    }
    
  
?>
<form action="forgotpassword.php" method="post">

New Password:<br>
<input type="password" name="newpassword"/>
<input type="submit" value="Change"/><br>
