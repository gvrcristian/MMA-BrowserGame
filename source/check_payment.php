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
					<?php
					// read the post from PayPal system and add 'cmd'
					$req = 'cmd=_notify-validate';

					foreach ($_POST as $key => $value) {
					$value = urlencode(stripslashes($value));
					$req .= "&$key=$value";
					}

					// post back to PayPal system to validate
					$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
					$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
					$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
					$fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);

					// assign posted variables to local variables
					$item_name = $_POST['item_name'];
					$item_number = $_POST['item_number'];
					$payment_status = $_POST['payment_status'];
					$payment_amount = $_POST['mc_gross'];
					$payment_currency = $_POST['mc_currency'];
					$txn_id = $_POST['txn_id'];
					$receiver_email = $_POST['receiver_email'];
					$payer_email = $_POST['payer_email'];
					$premium_expire = time()+$web['premium_bonus_time'];
					if (!$fp) {
					// HTTP ERROR
					} else {
					fputs ($fp, $header . $req);
					while (!feof($fp)) {
					$res = fgets ($fp, 1024);
					if (strcmp ($res, "VERIFIED") == 0) {

						if ($payment_status == 'Completed') {


								if ($receiver_email==$web['paypal_email']) {

									if ($payment_amount == $web['premium_bonus_price'] && $payment_currency == "USD") {

									?>
									<span style="font-size:15px;font-weight:bold;color:green;">Payment was successfully.<br/>Now you using our premium bonuses.</span><br><br>
									<?php
									$update = mysql_query("UPDATE users SET premium='1' WHERE id='$user[id]'");
									$insert = mysql_query("INSERT premium_history (user_id,premium_expire) VALUES ('$user[id]','$premium_expire')");
									}

								}

						}

					}

					else if (strcmp ($res, "INVALID") == 0) {
						?>
						<span style="font-size:15px;font-weight:bold;color:red;">Payment was failed.</span><br><br>
						<?php
					}
					}
					fclose ($fp);
					}  

				?>
					</td>
				</tr>
			</table>
                     
                  </section>
				  

    </body>
</html>