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

        <!-- Container -->
        <section id="container">
        
            <!-- Header -->
			<header> 
            	<!-- Logo -->
        
                <!-- /Logo -->
                

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
			<br>
		<table width="100%" border="0" cellspacing="2" cellpadding="2" class="mod_list">
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td width="130px"><b>Username</b></td>
			<td align="center">&nbsp;</td>
			<td width="110px"><b>Power</b></td>
			<td align="center">&nbsp;</td>
			<td><b>Family</b></td>
			<td align="center">&nbsp;</td>
			<td><b>City</b></td>
			<td align="center"><b>SL</b></td>
			<td align="center"><b>PM</b></td>
		</tr>
</table>
		
<?php
// find out how many rows are in the table 
$sql = "SELECT COUNT(*) FROM users";
$result = mysql_query($sql) or trigger_error("SQL", E_USER_ERROR);
$r = mysql_fetch_row($result);
$numrows = $r[0];

// number of rows to show per page
$rowsperpage = 5;
// find out total pages
$totalpages = ceil($numrows / $rowsperpage);

// get the current page or set a default
if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
   // cast var as int
   $currentpage = (int) $_GET['currentpage'];
} else {
   // default page num
   $currentpage = 1;
} // end if

// if current page is greater than total pages...
if ($currentpage > $totalpages) {
   // set current page to last page
   $currentpage = $totalpages;
} // end if
// if current page is less than first page...
if ($currentpage < 1) {
   // set current page to first page
   $currentpage = 1;
} // end if

// the offset of the list, based on current page 
$offset = ($currentpage - 1) * $rowsperpage;

// get the info from the db 
$sql = "SELECT * FROM users ORDER BY battles_won-battles_lost DESC, usern LIMIT $offset, $rowsperpage";
$result = mysql_query($sql) or trigger_error("SQL", E_USER_ERROR);

// while there are rows to be fetched...
while ($list = mysql_fetch_assoc($result)) {
   // echo data
   		echo '<div class="player_list"><span style="font-size:18px;"><b>'.$j++.' '.$list['usern'].'    </b></span>'.$lang['battles_won'].': '.number_format($list['battles_won'])."    ".$lang['battles_lost'].': '.number_format($list['battles_lost'])."    ".$lang['won_tournaments'].': '.number_format($list['tournaments_won']).'</div><br><br> ';
} // end while

/******  build the pagination links ******/
// range of num links to show
$range = 3;

// if not on page 1, don't show back links
if ($currentpage > 1) {
   // show << link to go back to page 1
   echo " <a href='./?m=stat&currentpage=1'><<</a> ";
   // get previous page num
   $prevpage = $currentpage - 1;
   // show < link to go back to 1 page
   echo " <a href='./?m=stat&currentpage=$prevpage'><</a> ";
} // end if 

// loop to show links to range of pages around current page
for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
   // if it's a valid page number...
   if (($x > 0) && ($x <= $totalpages)) {
      // if we're on current page...
      if ($x == $currentpage) {
         // 'highlight' it but don't make a link
         echo " [<b>$x</b>] ";
      // if not current page...
      } else {
         // make it a link
         echo " <a href='./?m=stat&currentpage=$x'>$x</a> "; //request_uri->am încercat și cu asta...
      } // end else
   } // end if 
} // end for
                 
// if not on last page, show forward and last page links        
if ($currentpage != $totalpages) {
   // get next page
   $nextpage = $currentpage + 1;
    // echo forward link for next page 
   echo " <a href='./?m=stat}&currentpage=$nextpage'>></a> ";
   // echo forward link for lastpage
   echo " <a href='./?m=stat&currentpage=$totalpages'>>></a> ";
} // end if
/****** end build pagination links ******/
			?>
			

                     
                  </section>
				  

    </body>
</html>