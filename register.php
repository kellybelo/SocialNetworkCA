<!-- Kelly Domingues 2014243 -->

<html>
	<title style='margin-left:500px'>REGISTER PAGE</title>
	<body style='background-color:grey'>
	
<?php

	if($_POST){
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];		
		$tel = $_POST['tel'];		
		$age = $_POST['age'];		
		$email = $_POST['email'];		
		$username = $_POST['username'];		
		$password = $_POST['password'];
		
		
		$error='';
		
		if($fname==''){
			
			$error.= 'You cannot have First Name blank<br>';
		}
		if($lname==''){
			
			$error.= 'You cannot have Last Name blank<br>';
		}
		if(!filter_var($tel, FILTER_VALIDATE_INT)){
			
			$error.= 'It is not a telephone number<br>';
		}
		if($age < 18){
			
		$error.= 'It is not a permited age<br>';
		
		}
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			
			$error.= 'It is not an email format<br>';
		}
		if($username==''){
			
			$error.= 'It is not a valid username format<br>';
		}
		if(strlen($password)<8){
			
			$error.= 'It is not a valid password format<br>';
		}
		if($error){
			
			echo $error;
		}
		else{	   
			try {
				$host = '127.0.0.1';
				$dbname = 'test';
				$user = 'root';
				$pass = '';
				$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user,$pass);
			} catch(PDOException $e) {echo 'Error';}  		
			
			$sql = "INSERT INTO users_table (`fname`, `lname`, `tel`, `age`, `email`, `username`, `password`) VALUES(?, ?, ?, ?, ?, ?, ?);";
			$sth = $DBH->prepare($sql);
			
			$sth->bindParam(1, $fname, PDO::PARAM_INT);
			$sth->bindParam(2, $lname, PDO::PARAM_INT);
			$sth->bindParam(3, $tel, PDO::PARAM_INT);
			$sth->bindParam(4, $age, PDO::PARAM_INT);
			$sth->bindParam(5, $email, PDO::PARAM_INT);
			$sth->bindParam(6, $username, PDO::PARAM_INT);
			$sth->bindParam(7, $password, PDO::PARAM_INT);
			
			$sth->execute();
			  echo 'You are now registered!';
		}
	}
?>
	<form action="register.php" method="post" style='margin-left:500px'>
		<h1> Register Now!</h1>

		  First name:<br>
		  <input type="text" name="fname"></input>
		  <br>
		  Last name:<br>
		  <input type="text" name="lname"></input>
		  <br>
		  Telephone:<br>
		  <input type="text" name="tel"></input>
		  <br>
		  Age:<br>
		  <input type="text" name="age"></input>
		  <br>
		  Email:<br>
		  <input type="email" name="email"></input>
		  <br>
		  Username:<br>
		  <input type="text" name="username"></input>
		  <br>
		  Password:<br>
		  <input type="text" name="password"></input>
		  <br>		 
		<input type="submit" value='Register' /><br>		
		<h3>Login <a href="index.php">Here</a></h3>

	</form>	
	</body>
<html>

