<!-- Kelly Domingues 2014243 -->
<?php
session_start();

if($_POST){

    $username = $_POST['username'];
    $password = $_POST['password'];	
    
    try {
		$host = '127.0.0.1';
        $dbname = 'test';
        $user = 'root';
        $pass = '';
        # MySQL with PDO_MYSQL
        $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    } catch(PDOException $e) {echo 'Error';}      
   
    $q = $DBH->prepare("select * from users_table where username = :username and password = :password LIMIT 1");
    $q->bindValue(':username', $username);
    $q->bindValue(':password',  $password);
    $q->execute();
    $row = $q->fetch(PDO::FETCH_ASSOC);
 
    $message = '';
    if (!empty($row)){       
        
        $_SESSION['username'] = $row['username'];   
        
        $_SESSION['id'] = $row['id'];

        $id = $_SESSION['id'];
        
        //$message = 'Loggin in!';
		
		echo'<script>window.location="profile.php?id=' . $id . '"; </script>';
		//<script>window.history.bac(); ask somebody what is that
	} else {
			
         $message= 'Sorry your log in details are not correct';
		 
    }
    
}
?>
<html>
<title>LOGIN PAGE</title>
<body style='background-color:grey'>
<form action="index.php" method="post" style='margin-left:500px'>
<h2>Login</h2><br></br>
Username:<br>
 <input type="text" name="username"/></br>
Password:<br>
 <input type="text" name="password"/>
<input type="submit"/><br>
<a href="email.php">Forgot Password?</a>
<h3>New user click <a href="register.php">Here</a></h3>
<?php
    if(!empty($message)){
     echo '<br>';
     echo $message;
    }
 ?>
</form>
</html>