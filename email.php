<!-- Kelly Domingues 2014243 -->

<?php
if($_POST){

  $email = $_POST['email'];
 
    
    try {
        $host = '127.0.0.1';
        $dbname = 'test';
        $user = 'root';
        $pass = '';
        # MySQL with PDO_MYSQL
        $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    } catch(PDOException $e) {echo 'Error';}  
  
    $q = $DBH->prepare("select * from users_table where email= :email");
    $q->bindValue(':email', $email);
    $q->execute();
    $check = $q->fetch(PDO::FETCH_ASSOC);
 
    $message = '';
    if (!empty($check)){
        $email = $check['email'];
        
        $message = 'Your new password was sent to your email!';
    } else {
         $message= 'Sorry your e-mail is not correct';
    }
 }
?>
<form action="email.php" method="post" style='margin:200px 0px 0px 500px'>
Forgot Password<br>
<br>
Insert email: <input type="email" name="email"/>
<input type="submit"/>
<?php
    if(!empty($message)){
     echo '<br>';
     echo $message;
    }
 ?>
</form>