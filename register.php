<?php

include ("header.php");
if (isset($_SESSION["uid"]))
{
    redirect('index.php?type=1');	
}
$return = '<div class="alert-blue"><i class="alert-icon fa fa-exclamation-circle"></i>Enter the following details in order to register</div>';
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if (isset($_POST['register']))
    {
		if ($_SESSION['token']==$_POST['token']) {
		

        if (empty($_POST['username']))
        {
            $return = '<div class="alert-red"><i class="alert-icon fa fa-exclamation-circle"></i>Please enter an username</div>';
        }
        elseif (empty($_POST['password']))
        {
            $return = '<div class="alert-red"><i class="alert-icon fa fa-exclamation-circle"></i>Please enter a password</div>';
        }
        elseif (empty($_POST['email']))
        {
            $return = '<div class="alert-red"><i class="alert-icon fa fa-exclamation-circle"></i>Please enter an email</div>';
        }
        else
        {
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            $sql = "SELECT COUNT(username) AS num FROM users WHERE username = :username";
            $stmt = $x->prepare($sql);
            $stmt->bindValue(':username', $username);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $sql = "SELECT COUNT(email) AS num FROM users WHERE email = :email";
            $stmt = $x->prepare($sql);
            $stmt->bindValue(':email', $email);
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row['num'] > 0)
            {
                $return = '<div class="alert-red"><i class="alert-icon fa fa-exclamation-circle"></i>That username already exists!</div>';
            }
            elseif (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $username))
            {
                $return = '<div class="alert-red"><i class="alert-icon fa fa-exclamation-circle"></i>Do not use special characters in your username</div>';

            }
            elseif ($res['num'] > 0)
            {
                $return = '<div class="alert-red"><i class="alert-icon fa fa-exclamation-circle"></i>That email already exists!</div>';
            }
            elseif (filter_var($email, FILTER_VALIDATE_EMAIL) == false)
            {
                $return = '<div class="alert-red"><i class="alert-icon fa fa-exclamation-circle"></i>Please enter a valid email!</div>';
            }
            else
            {
                $passwordHash = md5(sha1(trim($password)));
                $sql = "INSERT INTO users (username, password, email) VALUES (:username, :password, :email)";
                $stmt = $x->prepare($sql);
                $stmt->bindValue(':username', $username);
                $stmt->bindValue(':password', $passwordHash);
                $stmt->bindValue(':email', $email);
                $result = $stmt->execute();
                if ($result)
                {
                    $return = '<div class="alert-green"><i class="alert-icon fa fa-exclamation-circle"></i>Resgistered successfully!</div>';
                }

            }
        }
		unset($_SESSION['token']);
	}
	else { $return = '<div class="alert-red"><i class="alert-icon fa fa-exclamation-circle"></i>Invalid Session Token!</div>'; }
    }
}

?>


         <div class="container">
            <div class="section welcome">
               <h1>Registeration</h1>
               <p>
                  Register an account in order to use the chatroom
               </p>
               <div id="chat" class="chat">
                
				<?php echo ($return); ?>
				<form action="register.php" method="post">
            <label for="username">Username</label>
            <input type="text" id="username" name="username"><br>
            <label for="password">Password</label>
            <input type="password" id="password" name="password"><br>
			<label for="email">Email</label>
            <input type="text" id="email" name="email"><br>
			<input type="hidden" name="token" value="<?php echo generatetoken(); ?>"/>
            <input type="submit" name="register" value="Register"></button>
        </form>
               </div>
            </div>
         </div>
      </div>
 <?php

include ("footer.php");

?>
