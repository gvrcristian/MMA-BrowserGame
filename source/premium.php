<?php
/**
* @author FightMMA
* @copyright 2015 FightMMA All rights reserved.
*/
if(!$_SESSION['usern']) { header("Location: ./"); }
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
					<span style="font-size:15px;font-weight:bold;color:#1E7BBB ;"><?php echo $lang['menu_premium']; ?></span><br/>
					<br>
					<?php
					if($user['premium'] == 1) {
					$premium = mysql_fetch_array(mysql_query("SELECT * FROM premium_history WHERE user_id='$user[id]'"));
					?>
					Already using premium services.	Your premium account expire after <?php echo expire($premium['premium_expire']); ?>.
					<?php
					} else {
					?>
					<b>Use premium account and get our bonuses.<b><br/>
					+<?php echo $web['premium_bonus_force']; ?> force, +<?php echo $web['premium_bonus_agility']; ?> agility, +<?php echo $web['premium_bonus_endurance']; ?> endurance, +<?php echo $web['premium_bonus_fastness']; ?> fastness for each workout.<br/>
					+<?php echo $web['premium_bonus_points']; ?> points for each battle won. <br>
					<br>
					Only for $<?php echo $web['premium_bonus_price']; ?> per <?php if($web['premium_bonus_time'] == "2419200") { echo 'monthly'; } elseif($web['premium_bonus_time'] == "604800") { echo 'weekly'; } elseif($web['premium_bonus_time'] == "86400") { echo 'daily'; } else { echo 'weekly'; } ?><br><br>
					<a href="./?m=buy_premium" class="button transition">Buy via Paypal</a>
					<br><br>
					<?php
					}
					?>
					</td>
				</tr>
			</table>
                     
                  </section>
				  

    </body>
</html>