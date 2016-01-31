<?php
/**
* @author FightMMA
* @copyright 2015 FightMMA All rights reserved.
*/
if(!$_SESSION['usern']) { header("Location: ./"); }
include("includes/paypal_class.php");
?>
<html dir="ltr" lang="en-US" xmlns="http://www.w3.org/1999/xhtml">


    <body>
		<a href="./"><div class="logo"></div></a>
        <section id="container">

            <!-- Content -->
            <section id="content" >

  <div id="play"> 
  <div id='cssmenu'>
<ul>
   <li class='active1'><a href="./?m=city" ><?php echo $lang['menu_city']; ?></a> </li>
   <li><a href="./?m=statistics" ><?php echo $lang['menu_statistics']; ?></a> </li>
   <li> <a href="./?m=hall" ><?php echo $lang['menu_hall']; ?></a> </li>
   <li> <a href="./?m=fight" ><?php echo $lang['menu_fight']; ?></a> </li>
   <li>	 <a href="./?m=tournaments" ><?php echo $lang['menu_tournaments']; ?></a> </li>
   <li><a href="./?m=rankings" ><?php echo $lang['menu_rankings']; ?></a> </li>
<li class='last'> <a href="./?m=listmes" ><?php echo $lang['menu_msg']; ?></a></td></li>
   
</ul>
</div>
			<br>

		
			
			<table border="0" width="100%" cellspacing="2" cellpadding="2" class="trans">
				<tr>
					<td width="100%">
					<span style="font-size:15px;font-weight:bold;">Redirecting to PayPal Payment system...</span><br><br>
					<?php
					$url = curPageURL();
					define('EMAIL_ADD', $web['paypal_email']); // For system notification.
					define('PAYPAL_EMAIL_ADD', $web['paypal_email']);

					// Setup class
					$p = new paypal_class( ); 				 // initiate an instance of the class.
					$p -> admin_mail = EMAIL_ADD; 
						$this_script = $url."/?m=check_payment";
						  
						$p->add_field('business', PAYPAL_EMAIL_ADD); //don't need add this item. if your set the $p -> paypal_mail.
						$p->add_field('return', $this_script.'&action=success');
						$p->add_field('cancel_return', $this_script.'&action=cancel');
						$p->add_field('notify_url', $this_script.'&action=ipn');
						$p->add_field('item_name', 'Premium services for '.$user[usern]);
						$p->add_field('item_number', '1');
						$p->add_field('amount', $web['premium_bonus_price']);
						$p->add_field('currency_code', 'USD');
						$p->add_field('cmd', '_xclick');
						$p->add_field('rm', '2');	// Return method = POST
					 
						 $p->submit_paypal_post(); // submit the fields to paypal
				
					?>
					</td>
				</tr>
			</table>
                     
                  </section>
				  

    </body>
</html>