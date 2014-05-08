<!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
		<div class="masthead clearfix">
			<div class="wrapper">
				<div><a href="http://humboldt.edu"><img src="<?php print $base_path . $directory ?>/img/hsu-wm@2x.png" alt="Humboldt State University" class="reflow"></a>
					
				  </div> 
				</div>
			</div><!--#wrapper-->
		</div><!--#masthead-->
		        <header class="header-container clearfix">
		            <div class="wrapper">
					<p class="site_name"><a href="<?php print $front_page ?>"><?php print $site_name; ?></a>
						<?php if ($site_slogan): ?>
							<span class="slogan"><?php print $site_slogan;?></span>
						<?php endif; ?>	
						</p>
		            </div>
					<?php if ($page['horizontal_nav']): ?>
						<div class="nav-horizontal">
							<nav class="wrapper">
								<?php print render($page['horizontal_nav']); ?>
							</nav>
						</div>
					<?php endif;?>
		        </header><!-- #header-container -->	
		        <div class="main-container">

		            <div class="wrapper clearfix">
						<div class="skip"><a href="#main">skip navigation</a></div>
		                <section class="nav-primary">
							<?php if ($page['submenu']): ?>
									<nav>
									<?php print render($page['submenu']); ?>
								</nav>
							<?php endif; ?>
						</section>	 
					    <section class="main-content" id="main">

					    	<div class="maininner">
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
		                        </div>
			            </section> <!-- #main-content -->
		                <section class="side">
							<?php if ($page['sidebar_first']): ?>
								<div class="side-panel">
									<?php print render($page['sidebar_first']); ?>
								</div>
							<?php endif; ?>
		                </section><!--#side-->
		        </div> </div><!-- #main-container -->
	 <section class="footer-container">
			 <div class="circleh"></div>
            <footer class="wrapper">
				<div class="grid">
					<article class="col-1-4 module">
						<?php print render($page['footer_firstcolumn']); ?>
					</article>
					<article class="col-1-4 module">
						<?php print render($page['footer_secondcolumn']); ?>
					</article>
					<article class="col-1-4 module">
						<?php print render($page['footer_thirdcolumn']); ?>
					</article>
					<article class="col-1-4 module">
							<?php print render($page['footer_fourthcolumn']); ?>
							<?php print render($page['footer_social']); ?>


							<?php if ($include_social && $social_links): ?>
								<h2 class="element-invisible"><?php print t('Follow Us'); ?></h2>
			          <div class="social-links clearfix">
			              <?php print $social_links; ?>
			          </div>
		        	<?php endif; ?>
					</article>
					
				</div>
            </footer>
        </section><!--#footer-container-->
