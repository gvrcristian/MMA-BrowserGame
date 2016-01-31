<?php
/**
* @author FightMMA
* @copyright 2015 FightMMA All rights reserved.
*/
if(!$_SESSION['usern']) { header("Location: ./"); }
?>
<html dir="ltr" lang="en-US" xmlns="http://www.w3.org/1999/xhtml">

	<script type="text/javascript" src="java/city/map.js"></script>
	<link rel="stylesheet" type="text/css" href="java/city/map.css" media="screen">
    <body>
	<a href="./"><div class="logo"></div></a>
			<?php if($web['ad_place']) { ?>
		<div class="banner">
			<?php echo $web['ad_place']; ?>
		</div>
		<?php } ?>
        <!-- Container -->
		
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
  <center>     <table  cellpadding="0" cellspacing="0" width="100%"><tr><td>

                <table id="menu0" class="cmenu" cellspacing="0">
					<tbody><tr><th colspan="4" class="title"> Shop </th></tr>
					<tr><th><a href="?m=shop&item_type=1"> Gloves</a></th></tr>
					<tr><th><a href="?m=shop&item_type=2"> Shorts</a></th></tr>
					<tr><th><a href="?m=item"> Your Items</a></th></tr>
					<tr><th><a href="?m=premium"> Premium</a></th></tr>
					</tr>
					</tbody></table>
					<table id="menu1" class="cmenu" cellspacing="0">
					<tbody><tr><th colspan="4" class="title"><center> Home </th></tr>
					<tr><th><a href="?m=profile"> Profile</a></th></tr>
					<tr><th><a href="?m=listmes"> Messages</a></th></tr>
					<tr><th><a href="?m=statistics">Statistics</a></th></tr>
					<tr><th><a href="?m=logout"> Log Out</a></th></tr>
					</tbody></table>
					<table id="menu2" class="cmenu" cellspacing="0">
					<tbody><tr><th colspan="4" class="title"></th></tr>
					</tbody></table>
					<table id="menu3" class="cmenu" cellspacing="0">
					<tbody><tr><th colspan="4" class="title"><center> Fight Club </th></tr>

				<tr><th><a href="?m=hall"> Hall</a></th></tr>
				<tr><th><a href="?m=fight">Fight</a></th></tr>
				<tr><th><a href="?m=tournaments">Tournaments</a></th></tr>

				</tbody></table>
				<table id="menu4" class="cmenu" cellspacing="0">
					<tbody><tr><th colspan="4" class="title"></th></tr>

					</tbody></table>
					<table id="menu5" class="cmenu" cellspacing="0">
					<tbody><tr><th colspan="4" class="title"><center> Under Construction Building </th></tr>

							<tr><th><a href="#">  Under Construction </a></th></tr>   
							<tr><th><a href="#">  Under Construction </a></th></tr>   
							<tr><th><a href="#">  Under Construction </a></th></tr>  

					</tbody></table>
					<table id="menu6" class="cmenu" cellspacing="0">
					<tbody><tr><th colspan="4" class="title"><center> Under Construction Building </th></tr>
					

							<tr><th><a href="#">  Under Construction </a></th></tr>   
							<tr><th><a href="#">  Under Construction </a></th></tr>   
							<tr><th><a href="#">  Under Construction </a></th></tr>   
                  
                    
				</tbody></table>
				<table id="menu7" class="cmenu" cellspacing="0">
					<tbody><tr><th colspan="4" class="title"></th></tr>
                    
				</tbody></table>
				<table id="menu8" class="cmenu" cellspacing="0">
					<tbody><tr><th colspan="4" class="title"><center>Hall of Fame </th></tr>

					<tr><th><a href="?m=rankings">Best Of</a></th></tr>
					<tr><th><a href="#">All Players</a></th></tr>

					</tbody></table>
							<table id="menu9" class="cmenu" cellspacing="0">
							<tbody><tr><th colspan="4" class="title"><center> Under Construction Building </th></tr>
                            

							<tr><th><a href="#">  Under Construction </a></th></tr>   
							<tr><th><a href="#">  Under Construction </a></th></tr>   
							<tr><th><a href="#">  Under Construction </a></th></tr>   


						</tbody></table>
							<table id="menu10" class="cmenu" cellspacing="0">
							<tbody><tr><th colspan="4" class="title"></th></tr>

						</tbody></table>
							<table id="menu11" class="cmenu" cellspacing="0">
							<tbody><tr><th colspan="4" class="title"><center> Under Construction Building </th></tr>
						
							<tr><th><a href="#">  Under Construction </a></th></tr>                          

						</tbody></table>
							<table id="menu12" class="cmenu" cellspacing="0">
							<tbody><tr><th colspan="4" class="title"><center>  Under Construction Building </th></tr>
							
                            <tr><th><a href="#">  Under Construction </a></th></tr>
							<tr><th><a href="#">  Under Construction </a></th></tr>

						</tbody></table>
						<table id="menu13" class="cmenu" cellspacing="0">
							<tbody><tr><th colspan="4" class="title"></th></tr>

						</tbody></table>
							<table id="menu14" class="cmenu" cellspacing="0">
							<tbody><tr><th colspan="4" class="title"><center> Under Construction Building </th></tr>


                            
						<tr><th><a href="#">  Under Construction </a></th></tr>  
						<tr><th><a href="#">  Under Construction </a></th></tr>  
						<tr><th><a href="#">  Under Construction </a></th></tr>  

						</tbody></table>
							<table id="menu15" class="cmenu" cellspacing="0">
							<tbody><tr><th colspan="4" class="title"><center> Under Construction Building </th></tr>
							

						                         
						 <tr><th><a href="#">  Under Construction </a></th></tr>    
						 <tr><th><a href="#">  Under Construction </a></th></tr>    

						</tbody></table>
						<table id="menu16" class="cmenu" cellspacing="0">
							<tbody><tr><th colspan="4" class="title"></th></tr>

							</tbody></table>
							<table id="menu17" class="cmenu" cellspacing="0">
							<tbody><tr><th colspan="4" class="title"><center>  Under Construction Building  </th></tr>

							 <tr><th><a href="#">  Under Construction </a></th></tr>    
                         
                            
						</tbody></table>
							<table id="menu18" class="cmenu" cellspacing="0">
							<tbody><tr><th colspan="4" class="title"><center> Under Construction Building </th></tr>
							
							 <tr><th><a href="#">  Under Construction </a></th></tr>   
							 <tr><th><a href="#">  Under Construction </a></th></tr>   
							 <tr><th><a href="#">  Under Construction </a></th></tr>   
            

						</tbody></table>
							<table id="menu19" class="cmenu" cellspacing="0">
							<tbody><tr><th colspan="4" class="title"><center> Under Construction</th></tr>
							<tr><th><a href="#">  Under Construction </a></th></tr>  
							<tr><th><a href="#">  Under Construction </a></th></tr>
						</tbody></table>
							<table id="menu20" class="cmenu" cellspacing="0">
							<tbody><tr><th colspan="4" class="title"></th></tr>

						</tbody></table></div>	

               
		<div class="private-map" id="map"><table class="map_head">
				<tbody><tr><td></td>
				
				</tr>
				</tbody></table>
                
                       <div m="0" class="spot0 watchmaker"><div class="obj_flag obj_city"></div></div>
                <div m="1" class="spot1 bakery"><div class="obj_flag obj_city"></div></div>
                
                
                <div m="2" class="spot2 clothing"><div class="obj_flag obj_city"></div></div>
                <div m="3" class="spot3 keymaker"><div class="obj_flag obj_city"></div></div>
                <div m="4" class="spot4 groceries_over"><div class="obj_flag obj_city"></div></div>
                <div m="5" class="spot5 newsshop"><div class="obj_flag obj_city"></div></div>
                <div m="6" class="spot6 butchery"><div class="obj_flag obj_city"></div></div>
                <div m="7" class="spot7 hairstyle"><div class="obj_flag obj_city"></div></div>
                <div m="8" class="spot8 pizza"><div class="obj_flag obj_city"></div></div>

                <div m="9"  class="spot skater"></div>
                <div m="10" class="spot girl"></div>
                <div m="11" class="spot newcar"></div>
           
                <div m="13" class="spot taxi"></div>

                <div m="16" class="spot garbage"></div>
                <div m="17" class="spot postman"></div>
       
                <div m="19" class="spot mycar"></div>
                <div m="20" class="spot cofemachine"></div>
                

    
		</a> </div><script type="text/javascript">mapInit(); mapTooltipInit();</script></div>	</div>
	</div>
	</center>

                </td>

</td></tr></table>

                </div>
    </td>
    </tr>

    </table>
    </td></center>
                     
                  </section>
				  

    </body>
</html>