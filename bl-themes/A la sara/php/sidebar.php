<!-- Intro -->
<section id="intro">
	<header>
		<h2><?php echo $Site->title() ?></h2>
		<p><?php echo $Site->slogan() ?></p>
	</header>
</section>

<?php Theme::plugins('siteSidebar') ?>

<!-- Footer -->
<section id="footer">
	<ul class="icons">
	<?php	
		// Custom for the tagcloud
		global $dbTags;
		global $Url;

		$db = $dbTags->db['postsIndex'];
		$filter = $Url->filters('tag');

		$tagArray = array();

		foreach($db as $tagKey=>$fields)
		{
		 $tagArray[] = array('tagKey'=>$tagKey, 'count'=>$dbTags->countPostsByTag($tagKey), 'name'=>$fields['name']);
		}

		usort($tagArray, function($a, $b) {
		 return $b['count'] - $a['count'];
		});

		foreach($tagArray as $tagKey=>$fields)
		{
		 // Print the parent
		 echo '<li><a href="'.HTML_PATH_ROOT.$filter.'/'.$fields['tagKey'].'">'.$fields['name'].' ('.$fields['count'].')</a></li>';
		}	  
		// Custom for the tagcloud
	  
		if($Site->twitter()) {
			echo '<li><a href="'.$Site->twitter().'" class="fa-twitter"><span class="label">Twitter</span></a></li>';
		}

		if($Site->facebook()) {
			echo '<li><a href="'.$Site->facebook().'" class="fa-facebook"><span class="label">Facebook</span></a></li>';
		}

		if($Site->instagram()) {
			echo '<li><a href="'.$Site->instagram().'" class="fa-instagram"><span class="label">Instagram</span></a></li>';
		}

		if($Site->github()) {
			echo '<li><a href="'.$Site->github().'" class="fa-github"><span class="label">Github</span></a></li>';
		}		

		if( $plugins['all']['pluginRSS']->installed() ) {
			echo '<section style="border-top: solid 1px rgba(160, 160, 160, 0.3); margin: 3em 0 0 0;    padding: 3em 0 0 0;   width: 100%;"></section>';
			echo '<li><a href="'.DOMAIN_BASE.'rss.xml'.'" class="fa-rss"><span class="label">RSS</span></a></li>';
		}

		if( $plugins['all']['pluginSitemap']->installed() ) {
			echo '<li><a href="'.DOMAIN_BASE.'sitemap.xml'.'" class="fa-sitemap"><span class="label">Sitemap</span></a></li>';
		}			
	?>	
	</ul>	
	
	<p class="copyright"><?php echo $Site->footer() ?> | <a href="http://www.bludit.com">BLUDIT</a></p>
</section>