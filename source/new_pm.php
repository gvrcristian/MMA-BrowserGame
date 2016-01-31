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
//We check if the user is logged
if(isset($_SESSION['usern']))
{


$form = true;
$otitle = '';
$orecip = '';
$omessage = '';
//We check if the form has been sent
if(isset($_POST['title'], $_POST['recip'], $_POST['message']))
{
	$otitle = $_POST['title'];
	$orecip = $_POST['recip'];
	$omessage = $_POST['message'];
	//We remove slashes depending on the configuration
	if(get_magic_quotes_gpc())
	{
		$otitle = stripslashes($otitle);
		$orecip = stripslashes($orecip);
		$omessage = stripslashes($omessage);
	}
	//We check if all the fields are filled
	if($_POST['title']!='' and $_POST['recip']!='' and $_POST['message']!='')
	{
		//We protect the variables
		$title = mysql_real_escape_string($otitle);
		$recip = mysql_real_escape_string($orecip);
		$message = mysql_real_escape_string(nl2br(htmlentities($omessage, ENT_QUOTES, 'UTF-8')));
		//We check if the recipient exists
		$dn1 = mysql_fetch_array(mysql_query('select count(id) as recip, id as recipid, (select count(*) from pm) as npm from users where usern="'.$recip.'"'));
		if($dn1['recip']==1)
		{
			//We check if the recipient is not the actual user
			if($dn1['recipid']!=$_SESSION['user_id'])
			{
				$id = $dn1['npm']+1;
				//We send the message
				if(mysql_query('insert into pm (id, id2, title, user1, user2, message, timestamp, user1read, user2read)values("'.$id.'", "1", "'.$title.'", "'.$_SESSION['user_id'].'", "'.$dn1['recipid'].'", "'.$message.'", "'.time().'", "yes", "no")'))
				{
?>
<div class="message">The message has successfully been sent.<br />
<a href="./?m=listmes">List of my personnal messages</a></div>
<?php
					$form = false;
				}
				else
				{
					//Otherwise, we say that an error occured
					$error = 'An error occurred while sending the message';
				}
			}
			else
			{
				//Otherwise, we say the user cannot send a message to himself
				$error = 'You cannot send a message to yourself.';
			}
		}
		else
		{
			//Otherwise, we say the recipient does not exists
			$error = 'The recipient does not exists.';
		}
	}
	else
	{
		//Otherwise, we say a field is empty
		$error = 'A field is empty. Please fill of the fields.';
	}
}
elseif(isset($_GET['recip']))
{
	//We get the username for the recipient if available
	$orecip = $_GET['recip'];
}
if($form)
{
//We display a message if necessary
if(isset($error))
{
	echo '<div class="message">'.$error.'</div>';
}
//We display the form
?>
			
<form action="./?m=mes" method="post">
<table border="0" cellspacing="2" cellpadding="2" class="trans" width="60%">
</tr>
<tr>
 <td valign="right">
<label for="title">Title</label><input type="text" value="<?php echo htmlentities($otitle, ENT_QUOTES, 'UTF-8'); ?>"class="input"  name="title" />
 </td>
</tr>
 
<tr>
 <td valign="top"">
   <label for="recip">Recipient</label><input type="text" value="<?php echo htmlentities($orecip, ENT_QUOTES, 'UTF-8'); ?>"class="input" name="recip" /><br />
 </td>
</tr>
<tr>
 <td valign="top">
   <label for="message">Message</label><textarea cols="40" rows="5" id="message" name="message"><?php echo htmlentities($omessage, ENT_QUOTES, 'UTF-8'); ?></textarea><br />
 </td>
 
</tr>

<tr>
 <td colspan="2" style="text-align:center">
         <input type="submit" class="button transition" value="Send" />
 </td>
</tr>
</table>
</form>
<?php
}
}
else
{
	echo '<div class="message">You must be logged to access this page.</div>';
}
?>
                     
                  </section>
				  

    </body>
</html>