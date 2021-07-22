<?php 

include("header.php");

?>
<?php 
$sql = "select * from chat ORDER BY mid ASC;";
			$stmt = $x->prepare($sql);
   
    $stmt->execute();
    $result = $stmt->fetchall();


if($_SERVER['REQUEST_METHOD'] === 'POST') {
	if(isset($_POST['submit'])){
	
if(isset($_POST['message_box_beta'])){
if(isset($_POST['token'])){
$return = '<div class="alert-blue"><i class="alert-icon fa fa-exclamation-circle"></i>success</div>';
echo($return);
$sql = "INSERT INTO chat (uid, username, message, timestamp) VALUES (:uid, :username, :message, :time)";
                $stmt = $x->prepare($sql);
                $stmt->bindValue(':uid', $_SESSION['uid']);
                $stmt->bindValue(':username', $_SESSION['username']);
                $stmt->bindValue(':message', $_POST['message_box_beta']);
				$stmt->bindValue(':time', date('Y-m-d H:i:s'));
                 $stmt->execute();
}

}
}
}

?>

         <div class="container">
            <div class="section welcome">
               <h1>Chatroom</h1>
               <p>
                  Simple Chat application
               </p>
               <div id="chat" class="chat">
			   
			   <?php
			   foreach($result as $res) { 
			   if(isset($_SESSION["uid"])) { 
			   if($_SESSION["uid"] == $res['uid']){
				   ?>
				   
				
			   
                  <div data-from="<?php echo($res['username']); ?>" data-id="<?php echo($res['mid']); ?>">
                     <div class="messagecontainer self" style="--user-color: #234A65">	
                        
                        <span class="message"><?php echo($res['message']); ?></span>
                     </div>
                  </div>
				  
				  
				  
				  
				  
				  
			   <?php  } else { ?> 
			   
			   
			   <div data-from="<?php echo($res['username']); ?>" data-id="<?php echo($res['mid']); ?>">
                     <div class="messagecontainer" style="--user-color: #F4A651">
                        <span class="meta">
                        
                        <span class="user"><?php echo($res['username']); ?></span>
                        <i class="metaBG"></i>
                        </span>
                        <span class="message"><?php echo($res['message']); ?></span>
                     </div>
			   </div>


			   <?php } ?>  <?php } else {	 ?>
			   
			   
                  <div data-from="<?php echo($res['username']); ?>" data-id="<?php echo($res['mid']); ?>">
                     <div class="messagecontainer" style="--user-color: #F4A651">
                        <span class="meta">
                        
                        <span class="user"><?php echo($res['username']); ?></span>
                        <i class="metaBG"></i>
                        </span>
                        <span class="message"><?php echo($res['message']); ?></span>
                     </div>
			   </div> 
			   
			   <?php }  } ?>
			   
			   
               </div>
			<?php   if(isset($_SESSION["uid"])) { ?>
			   <div class="input">
			    <form action="index.php" method="post" style="display:contents">
         <i class="fa fa-camera"></i><i class="fa fa-camera"></i>
            <input placeholder="Type your message here!" type="text" id="message_box_beta" name="message_box_beta">
			 <input type="hidden" name="token" value="123123"/>
            <input type="submit" name="submit" value="submit"></button>
        </form>
</div> <?php } ?>
            </div>
         </div>
      </div>
 <?php 

include("footer.php");

?>
