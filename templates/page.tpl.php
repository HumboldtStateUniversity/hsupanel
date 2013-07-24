<!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
		<div class="masthead">
			<div class="wrapper">
				<div><a href="http://humboldt.edu"><img src="<?php print $base_path . $directory ?>/img/hsu-wm@2x.png" alt="Humboldt State University" class="reflow"></a></div>
			</div><!--#wrapper-->
		</div><!--#masthead-->
		        <div class="header-container">
		            <header class="wrapper clearfix">
					<p class="site_name"><a href="<?php print $front_page ?>"><?php print $site_name; ?></a><span class="slogan"><?php print $site_slogan;?></span></p>

		            </header>
		        </div><!-- #header-container -->	
		        <div class="main-container">
		            <div class="wrapper clearfix">
						<div class="skip"><a href="#main">skip navigation</a></div>
		                <div class="nav-primary">
							<nav>
							<?php print render($main_menu_expanded);?>
							</nav>
						</div>		
					    <div class="main-content">
		                    <header>
								<div class="banner">
									<?php print render($page['banner_image']); ?>
								</div>
								<?php print $messages; ?>
								<?php print render($title_prefix); ?>
								<?php if ($title): ?><h1 class="title"><?php print $title; ?></h1><?php endif; ?>
								<?php print render($title_suffix); ?>
		
								<?php if ($tabs): ?><div id="tabs"><?php print render($tabs); ?></div><?php endif; ?>
								<?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
		
								<?php print render($page['content']); ?>
		                        
			            </div> <!-- #main-content -->
		                <div class="side">
							<?php if ($page['sidebar_first']): ?>
								<div class="side-panel">
									<?php print render($page['sidebar_first']); ?>
								</div>
							<?php endif; ?>
		                </div><!--#side-->
		        </div> <!-- #main-container -->
	 <div class="footer-container">
            <footer class="wrapper">
				<div class="grid">
					<article class="col-1-3 module">
						<?php print render($page['footer_firstcolumn']); ?>
					</article>
					<article class="col-1-3 module">
						<?php print render($page['footer_secondcolumn']); ?>
					</article>
					<article class="col-1-3 module">
							<?php print render($page['footer_thirdcolumn']); ?>
							<?php print render($page['footer_social']); ?>
					</article>
				</div>
            </footer>
        </div><!--#footer-container-->