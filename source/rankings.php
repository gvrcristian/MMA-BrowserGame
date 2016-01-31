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
        <!-- Container -->
        <section id="container">
        
    
                

            </header>
            <!-- /Header -->
           


			
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
	<br><br>
		<?php
			$i=1;
			$sql = mysql_query("SELECT * FROM users ORDER BY battles_won DESC, tournaments_won DESC LIMIT 9");
			if(mysql_num_rows($sql)>0) {
				while($row = mysql_fetch_array($sql)) {
					if($i == 1) { 
						echo '<div class="ranking"><div class="ranking_1"></div> <div class="ranking_info_top"><span style="font-size:18px;"><b>'.$row[usern].'</b></span><br><br>'.$lang[battles_won].': '.number_format($row[battles_won]).'<br/>'.$lang[won_tournaments].': '.number_format($row[tournaments_won]).'</div></div> ';
					} elseif($i == 2) {
						echo '<div class="ranking"><div class="ranking_2"></div> <div class="ranking_info_top"><span style="font-size:18px;"><b>'.$row[usern].'</b></span><br><br>'.$lang[battles_won].': '.number_format($row[battles_won]).'<br/>'.$lang[won_tournaments].': '.number_format($row[tournaments_won]).'</div></div> ';
					} elseif($i == 3) {
						echo '<div class="ranking"><div class="ranking_3"></div> <div class="ranking_info_top"><span style="font-size:18px;"><b>'.$row[usern].'</b></span><br><br>'.$lang[battles_won].': '.number_format($row[battles_won]).'<br/>'.$lang[won_tournaments].': '.number_format($row[tournaments_won]).'</div></div> ';
					} else {
						echo '<div class="ranking"><div class="ranking_info"><span style="font-size:18px;"><b>'.$row[usern].'</b></span><br><br>'.$lang[battles_won].': '.number_format($row[battles_won]).'<br/>'.$lang[won_tournaments].': '.number_format($row[tournaments_won]).'</div></div>';
					}
					$i++;
				}
			}
			?>
                  </section>
				  

    </body>
</html>