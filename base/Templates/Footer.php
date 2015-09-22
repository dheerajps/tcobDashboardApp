    </div>
    <?php if ( strpos( $_SERVER['REQUEST_URI'], 'login' ) === false ) { ?>
    <div id="logout"><a href="<?php echo APP_PAGES_PATH ;?>logout.php" >Logout</a></div>
    <?php } ?>
    
    <div id="app-logo">
	    <img alt="Professional Development Program, Trulaske College of Business, University of Missouri logo" src="<?php echo APP_RESOURCE_PATH ;?>/images/MIZ_BIZ_PDP.svg">
    </div>
</div>
<div style="clear:both"></div>
<div id="footer">&copy; Copyright <?php echo date('Y'); ?> Curators of the University of Missouri. All rights reserved. <a href="http://missouri.edu/dmca/" target="_blank">DMCA</a> and other <a href="http://missouri.edu/copyright/" target="_blank">copyright information</a>.</div>
</body>
</html>