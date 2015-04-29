<!DOCTYPE html>
<html>
<head>
<title><?php echo Configure::read('site_title');?> - <?php echo $title_for_layout; ?></title>
<?php echo $this->Html->charset(); ?>
<?php 
$metadescription = $this->fetch('metadescription');
$metakeywords = $this->fetch('metakeywords');
if (!empty($metadescription)) {
	echo $this->Html->meta('description', $this->fetch('metadescription'));
} else {
	echo '<meta name="description" content="'.Configure::read('metadescription').'" />';
}
if (!empty($metakeywords)) {
	echo $this->Html->meta('keywords', $this->fetch('metakeywords'));
} else {
	echo '<meta name="keywords" content="'.Configure::read('metakeywords').'" />';
}
?>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php
	echo $this->Html->meta('icon');
	echo $this->Html->css(''.Configure::read('cakeblog_theme').'.styles');
	echo $this->Html->css('flexslider');
	echo $this->Html->script('jquery');
	echo $this->Html->script('flexslider');
	echo $this->Html->script('prettify');
	echo $this->Html->script('default');
	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');
?>
<link rel="stylesheet" media="screen and (min-width: 0px) and (max-width: 1095px)" href="<?php echo Configure::read('BASE_URL');?>/css/mobile.css" />
</head>
<body>
	<div id="header_nav_container">
        <div class="center_container">
        <header id="header">
	<h1><a href="<?php echo Configure::read('BASE_URL');?>"><?php echo Configure::read('site_title');?></a></h1>
        <h2><?php echo Configure::read('sub_title');?></h2>
	</header>
        <nav id="nav">
        <div class="center_container">
        <ul>
        <?php 
		foreach($main_navigation as $nav_item): ?>
		<li><a href="<?php echo eval("?>".$nav_item->url."");?>" <?php if(!empty($nav_item->target)) { echo 'target="'.$nav_item->target.'"'; } ?>><?php echo $nav_item->title;?></a></li>
		<?php endforeach;?>
        </ul>
        </div>
        </nav>
        <nav id="mobile_nav">
        <div class="center_container">
        <ul><li><a href="#">&equiv;</a>
    	<ul>
        <?php 
		foreach($main_navigation as $nav_item): ?>
		<li><a href="<?php echo eval("?>".$nav_item->url."");?>" <?php if(!empty($nav_item->target)) { echo 'target="'.$nav_item->target.'"'; } ?>><?php echo $nav_item->title;?></a></li>
		<?php endforeach;?>
        </ul>
    	</li>
		</ul>
        </div>
        </nav>
        </div>
        </div>
       
        <div id="content_background">
        <div class="center_container">
        <?php if ($this->request->params['action'] == 'home') { ?>     
		<div id="slider">
		<script type="text/javascript">
		$(window).load(function() {
  		$('.flexslider').flexslider({
        easing: "swing",  
        animation: "fade",
        slideshowSpeed: 4000,
        animationSpeed: 600,
        startAt: 0,
        initDelay: 0,
        controlNav: true,
        directionNav: true,
        pausePlay: false,
        pauseText: 'Pause',
        playText: 'Play'
  		});
		});
		</script>
		<div class="flexslider">
  		<ul class="slides">
  		<?php foreach ($slider_articles as $slider_article) { ?>
  		<?php 
		$body = substr($slider_article->body,0,300);
		echo '<li><a href="'.Configure::read('BASE_URL').'/'.$slider_article->id.'/'.$slider_article->slug.'"><img src="'.Configure::read('BASE_URL').'/img/articles/featured/'.$slider_article->featured.'" alt="'.$slider_article->title.'"><div class="flex-caption"><h2>'.$slider_article->title.'</h2><p>'.strip_tags($body, '<br>').'...</p></div></a></li>'; ?>
  		<?php } ?>
  		</ul>
		</div>
		</div>
		<?php } ?>
		<section id="content">
		<?php echo $this->Flash->render(); ?>
       		<?php echo $this->fetch('content'); ?>
		</section>

        <aside id="sidebar">
        <div id="sidebar_padding">
        <?php 
		foreach($main_sidebar as $sidebar_item):
		echo '<div class="sidebar_item">';
		echo '<h2>'.$sidebar_item->title.'</h2>';
		echo eval("?>".$sidebar_item->body);
		echo '</div>';
		endforeach;?>
        </div>
        </aside>

        </div>
        </div>
	<footer id="footer">
        <div class="center_container">
	<p class="copyright"><a href="http://cakeblog.georgewhitcher.com" target="_blank">CakeBlog</a>: <?php echo Configure::read('cakeblog_version');?> <a href="http://cakephp.org" target="_blank">CakePHP</a>: <?php echo Configure::version(); ?></p>
	</div>
	</footer>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-26049269-1', 'auto');
  ga('send', 'pageview');
</script>
</body>
</html>