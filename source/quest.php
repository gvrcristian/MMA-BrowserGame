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

			<?php
			$reward1=100;
			$reward2=200;
			$reward3=300;
			$reward4=400;
			$reward5=500;
			$reward6=1000;
			$session_user=$_SESSION['usern'];
			
			
			$querry=mysql_query("SELECT * FROM users WHERE usern='$session_user'");
			$row_querry=mysql_fetch_array($querry);
			
			$id_user=$row_querry['id'];
			$query1=mysql_query("SELECT * FROM quest WHERE id_user='$id_user'");
			$row_querry1=mysql_fetch_array($query1);
			
			echo "<table border=0 cellspacing=2 cellpadding=2 class=trans width=100%><tr><td width=50%>";
			
			//10 winnings quest
			echo "Win 10 battles to receive a bonus of $reward1 money!<br>";
			if($row_querry['battles_won']>=10)
			{
				$query1=mysql_query("SELECT * FROM quest WHERE id_user='$id_user' AND quest_no=1");
				$row_querry1=mysql_fetch_array($query1);
				echo "<b>COMPLETED!</b><br>";
				if($row_querry1['quest_no']==FALSE)
				echo "<a href='{$_SERVER['REQUEST_URI']}&quest_no=1&prize=$reward1'><b>CLAIM THE PRIZE</b></a>";
				else echo "You already took the prize!";
			}
			else {echo "Quest not completed!";}
			echo "</td><td width=50%>";
			
			//20 winnings quest
			echo "Win 20 battles to receive a bonus of $reward2 money!<br>";
			if($row_querry['battles_won']>=20)
			{
				$query1=mysql_query("SELECT * FROM quest WHERE id_user='$id_user' AND quest_no=2");
				$row_querry1=mysql_fetch_array($query1);
				echo "<b>COMPLETED!</b><br>";
				if($row_querry1['quest_no']==FALSE)
				echo "<a href='{$_SERVER['REQUEST_URI']}&quest_no=2&prize=$reward2'><b>CLAIM THE PRIZE</b></a>";
				else echo "You already took the prize!";
			}
			else {echo "Quest not completed!";}
			echo "</td></tr><tr><td width=50%>";
			//buy premium
			echo "Activate a premium account to receive a bonus of $reward5 money!<br>";
			if($row_querry['premium']==1)
			{
				$query1=mysql_query("SELECT * FROM quest WHERE id_user='$id_user' AND quest_no=3");
				$row_querry1=mysql_fetch_array($query1);
				echo "<b>COMPLETED!</b><br>";
				if($row_querry1['quest_no']==FALSE)
				echo "<a href='{$_SERVER['REQUEST_URI']}&quest_no=3&prize=$reward5'><b>CLAIM THE PRIZE</b></a>";
				else echo "You already took the prize!";
			}
			else {echo "Quest not completed!";}
			echo "</td><td width=50%>";
			
			//10 lost games
			echo "Congratulations!!! You're a losser! You've lost 10 fights!<br> Here's $reward1 money to help you!<br>";
			if($row_querry['battles_lost']>=10)
			{
				$query1=mysql_query("SELECT * FROM quest WHERE id_user='$id_user' AND quest_no=4");
				$row_querry1=mysql_fetch_array($query1);
				echo "<b>COMPLETED!</b><br>";
				if($row_querry1['quest_no']==FALSE)
				echo "<a href='{$_SERVER['REQUEST_URI']}&quest_no=4&prize=$reward1'><b>CLAIM THE PRIZE</b></a>";
				else echo "You already took the prize!";
			}
			else {echo "Quest not completed!";}
			echo "</td></tr><tr><td width=50%>";
			
			//100 wins
			echo "Win 100 battles to receive a bonus of $reward6 money!<br>";
			if($row_querry['battles_lost']>=100)
			{
				$query1=mysql_query("SELECT * FROM quest WHERE id_user='$id_user' AND quest_no=5");
				$row_querry1=mysql_fetch_array($query1);
				echo "<b>COMPLETED!</b><br>";
				if($row_querry1['quest_no']==FALSE)
				echo "<a href='{$_SERVER['REQUEST_URI']}&quest_no=5&prize=$reward6'><b>CLAIM THE PRIZE</b></a>";
				else echo "You already took the prize!";
			}
			else {echo "Quest not completed!";}
			
			if(isset($_GET['quest_no']))
			{	
				$no_quest=$_GET['quest_no'];
				$prize=$_GET['prize'];
				$update_quest_table=mysql_query("INSERT quest (quest_no, id_user) VALUES ('$no_quest', '$id_user');");
				$update_money=mysql_query("UPDATE users SET money=money+'$prize' WHERE id='$id_user';");
				Header("Location: ./?m=quest");
			}
			?>
                     
                  </section>
				  

    </body>
</html>