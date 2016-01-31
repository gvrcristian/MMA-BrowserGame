<?php
/**
* @author FightMMA
* @copyright 2015 FightMMA All rights reserved.
*/
if(!$_SESSION['usern']) { header("Location: ./"); }
$j=1;
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
	

					<?php
							if($type==2)
							{	
								if($user['shorts']==0)
								{
									$update_equipment=mysql_query("UPDATE users SET shorts=1 WHERE id='$id_user'");
									$update_equip_table=mysql_query("INSERT items_equiped (id_item,id_user,type) VALUES ($id_item, $id_user,$type)");
									$update_stats=mysql_query("UPDATE users SET power=power+$new_power, fastness=fastness+$new_fastness, agility=agility+$new_agility, energy=energy+$new_energy, endurance=endurance+$new_endurance, money=money-$money WHERE id='$id_user'");
								}
							}
							?>
			
                     
                  </section>
				  

    </body>
</html>