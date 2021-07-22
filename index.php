<?php 

include("header.php");

?>
<?php 
$sql = "select * from chat ORDER BY mid ASC;";
			$stmt = $x->prepare($sql);
   
    $stmt->execute();
    $result = $stmt->fetchall();

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


			   <?php } } else {	 ?>
			   
			   
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
            </div>
         </div>
      </div>
 <?php 

include("footer.php");

?>
