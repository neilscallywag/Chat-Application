<?php 

include("header.php");


if(isset($_SESSION["uid"])){
	header("location: index.php");
}
$return = '<div class="alert-blue"><i class="alert-icon fa fa-exclamation-circle"></i>Do Not share your password with anyone</div>';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
if(isset($_POST['login'])){
	if ($_SESSION['token']==$_POST['token']) {
		
	
	
	$u = trim($_POST['username']);
	$p =  md5(sha1(trim($_POST['password'])));
	if(empty($u)){
		$return = '<div class="alert-red"><i class="alert-icon fa fa-exclamation-circle"></i>Please enter username</div>';
	
	
	}
	elseif(empty($p)){
		$return = '<div class="alert-red"><i class="alert-icon fa fa-exclamation-circle"></i>Please enter a password</div>';
		
		
	}
	else {

		$sql = "SELECT COUNT(username) AS num FROM users WHERE username = :username AND password = :password";
    $stmt = $x->prepare($sql);
    $stmt->bindValue(':username', $u);
	$stmt->bindValue(':password', $p);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
	if($row['num'] == 1){
       		$sql = "select * from users WHERE username = :username ";
			$stmt = $x->prepare($sql);
    $stmt->bindValue(':username', $u);
    $stmt->execute();
    $sid = $stmt->fetch(PDO::FETCH_ASSOC);
	if(!empty($sid['uid'])){
	         $_SESSION["uid"] = $sid['uid'];
			 $_SESSION["username"] = $sid['username'];
			$return= '<div class="alert-yellow"><i class="alert-icon fa fa-exclamation-circle"></i>Welcome: '.$sid['username'].'! You will be redirected in 5 seconds.</div>';
				header( "refresh:2;url=index.php" );
	}
	else { $return= '<div class="alert-red"><i class="alert-icon fa fa-exclamation-circle"></i>Please enter a password</div>';

	}
					
    }
	else {
		$return = '<div class="alert-red"><i class="alert-icon fa fa-exclamation-circle"></i>Incorrect Username or Password.</div>';
		
		
	}
	}
	unset($_SESSION['token']);
}

else {
	
	$return = '<div class="alert-red"><i class="alert-icon fa fa-exclamation-circle"></i>Invalid Session.</div>';
	
}
unset($_POST);
}
else { $return = '<div class="alert-red"><i class="alert-icon fa fa-exclamation-circle"></i>Is Not set Login</div>';
}
}




?>


         <div class="container">
            <div class="section welcome">
               <h1>Login</h1>
               
               <div id="chat" class="chat">
                
				<?php echo($return); ?>
				<form action="login.php" method="post">
            <label for="username">Username</label>
            <input type="text" id="username" name="username"><br>
            <label for="password">Password</label>
            <input type="password" id="password" name="password"><br>
			<input type="hidden" name="token" value="<?php echo generatetoken(); ?>"/>
            <input type="submit" name="login" value="login"></button>
        </form>
               </div>
            </div>
         </div>
      </div>
 <?php 

include("footer.php");

?>
