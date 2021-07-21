<?php 

include("header.php");

?>



         <div class="container">
            <div class="section welcome">
               <h1>Chatroom</h1>
               <p>
                  Simple Chat application
               </p>
               <div class="chat">
                  <div data-from="{from}" data-id="{messageId}">
                     <div class="messagecontainer" style="--user-color: #234A65">
                        <span class="meta">
                       
                        <span class="user">Neil</span>
                        <i class="metaBG"></i>
                        </span>
                        <span class="message">Hello world</span>
                     </div>
                  </div>
                  <div data-from="{from}" data-id="{messageId}">
                     <div class="messagecontainer" style="--user-color: #F4A651">
                        <span class="meta">
                        
                        <span class="user">some_user_not</span>
                        <i class="metaBG"></i>
                        </span>
                        <span class="message">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas porta malesuada ante vitae ultricies. Suspendisse sagittis, quam vitae ultricies ornare, elit nibh fermentum nisi, id feugiat libero turpis a lacus.</span>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
 <?php 

include("footer.php");

?>
