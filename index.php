<?php 

include("header.php");
$return = "Type your message here!";
if($_SERVER['REQUEST_METHOD'] === 'POST') {
	if(isset($_POST['submit'])){
		if($_POST['message_box_beta'] == null && empty($_FILES["image"]["name"])) {
			$return = 'Please enter a message !';
			
		}
		elseif($_POST['message_box_beta'] != null OR !empty($_FILES["image"]["name"])) {
 sendmessage($_SESSION["uid"], $_SESSION["username"], $_POST["message_box_beta"],$_POST["token"], $x);
		}
}}	


?>

         <div class="container">
            <div class="section welcome">
               <h1>Chatroom</h1>
               <p>
                  Simple Chat application
               </p>
               <div id="chatroom" class="chat">
			   
			   <?php
			   $result = getmessages($x);
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
				
         <label style="margin-bottom: 0rem !important" for="file-input"><i class="fa fa-camera"></label></i><input id="file-input" style="display:none" type="file"  accept="image/*" name="image">
            <input placeholder="<?php echo($return); ?>" type="text" id="message_box_beta" name="message_box_beta">
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
