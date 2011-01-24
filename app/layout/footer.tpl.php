<?php

echo '<div id="footer-top">
	<div class="align-left">
		<h4>Sitemap</h4>
		<p><a href="'._LINK::href( 'video' ).'">Videos</a> | <a href="'._LINK::href( 'artiste' ).'">Artistes</a></p>
	</div>
	<div class="align-right">
		<h2><a href="#">FFT</a></h2>
	</div>
	<div class="clear"></div>
</div><!-- end of div#footer-top -->';

$load = microtime( true ) - $time_start;

echo '<div id="footer-bottom">
	<p>Temps de réponse '. $load .' secondes</p>
</div>';