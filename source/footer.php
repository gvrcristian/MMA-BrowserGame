					<footer>

			<div class="copyright"><?php echo $lang['language']; ?>: <?php
							if ($handle = opendir('./languages')) {
								$l = 1;
								while (false !== ($file = readdir($handle)))
								{
									if ($file != "." && $file != ".." && strtolower(substr($file, strrpos($file, '.') + 1)) == 'php')
									{	
										$str = explode(".php",$file);
										$lang_name = $str[0];
										if($l == 1) {
										echo '<a href="./index.php?lang='.$lang_name.'">'.$lang_name.'</a>';
										} else {
										echo ', <a href="./index.php?lang='.$lang_name.'">'.$lang_name.'</a>';
										}
										$l++;
									} 
								}
								closedir($handle);
							}
						?></div>
			<div class="copyright">Copyright &copy; <a href="http://fightmma.net/" target="_blank">FightMMA</a></div>
		</div>

	  </footer>
        </section>