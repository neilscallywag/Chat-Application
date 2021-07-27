<?php

include ("header.php");
$return = "Type your message here!";
$type = (int)$_GET['type'];
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if (isset($_POST['submit']))
    {
		//if(!isset($_FILES['img'])) { die(); }
        if ($_POST['message_box_beta'] == "" && empty($_FILES["img"]['tmp_name']))
        {
            $return = 'Please enter a message !';

        }
        elseif ($_POST['message_box_beta'] != "" or !empty($_FILES["img"]['tmp_name']))
        {

            //$maxsize = 10000;
            //$finfo = finfo_open(FILEINFO_MIME_TYPE);
//$mimetype = finfo_file($finfo, $_FILES['img']['tmp_name']);
//if ($mimetype == 'image/jpg' || $mimetype == 'image/jpeg' || $mimetype == 'image/gif' || $mimetype == 'image/png') {
           
               // if ($_FILES['img']['error'] == UPLOAD_ERR_OK)
              //  {

                 //   if (is_uploaded_file($_FILES['img']['tmp_name']))
                  //  {

                    //    if ($_FILES['img']['size'] < $maxsize)
                     //   {
                       //     $img = addslashes(file_get_contents($_FILES['img']['tmp_name']));
                       //     $name = $_FILES["img"]["name"];

                       // }
                       // else
                      //  {
                         //   $return = "Image size too big";
                       // }
                    //}
          //      }
          //  }
          //  else
          //  {
          //      $return = "Please upload a valid image type";
          //  }
            sendmessage($_SESSION["uid"], $_SESSION["username"], $_POST["message_box_beta"], $_POST["token"], NULL, NULL, $x);
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
               <div id="chatroom" class="chat">
			  <?php  switch ($type) {
	case '1': ?>
			   
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
			    <form action="index.php" method="post" id="sendmsg" style="display:contents">
				
         <label style="margin-bottom: 0rem !important" for="file-input"><i class="fa fa-camera"></label></i><input id="file-input" style="display:none" type="file"  accept="image/*" name="image">
            <input placeholder="<?php echo($return); ?>" type="text" id="message_box_beta" name="message_box_beta">
			 <input type="hidden" name="token" value="<?php echo generatetoken(); ?>"/>
            <input type="submit" name="submit" value="submit"></button>
        </form>
</div> <?php } 	break; 	

case '2': ?>

<?php 

			  $result = getprivatemsg($_SESSION['uid'],$_GET['uid'],$x);
			  $res = count($result);
			  echo($res);
			  if($res > 0) {
			   foreach($result as $r) {  
                                if($r['f'] == $_SESSION['uid']) { ?>  
								
								
								<div>
								<div class="messagecontainer self" style="--user-color: #F4A651">
                        
                        <span class="message"><?php echo($r['message']); ?></span>
                     </div> </div>



					 <?php } else {			   ?>
			   
			  <div>
                     <div class="messagecontainer" style="--user-color: #F4A651">
                        <span class="meta">
                        
                        <span class="user"><?php echo(uidToname($_GET['uid'],$x)); ?></span>
                        <i class="metaBG"></i>
                        </span>
                        <span class="message"><?php echo($r['message']); ?></span>
                     </div> </div>
			   
			   <?php
			   
			  }
			  }
			  }
			  else { echo('<div class="alert-yellow"><i class="alert-icon fa fa-exclamation-circle"></i>There is no conversation yet!</div>'); }

?>





















			   <div class="input">
			    <form action="index.php" method="post" id="sendmsg" style="display:contents">
				
         <label style="margin-bottom: 0rem !important" for="file-input"><i class="fa fa-camera"></label></i><input id="file-input" style="display:none" type="file"  accept="image/*" name="img">
            <input placeholder="<?php echo($return); ?>" type="text" id="message_box_beta" name="message_box_beta">
			 <input type="hidden" name="token" value="<?php echo generatetoken(); ?>"/>
            <input type="submit" name="submit" value="submit"></button>
        </form>
</div> <?php  	break; 	
default:
		redirect('index.php?type=1');
			   }?>
            </div>
         </div>
      </div>
 <?php 

include("footer.php");

?>
