<?php
use \mls\ki\Config;
use \mls\ki\Security\Authenticator;
use \mls\ki\Widgets\LoginForm;

class PageElements
{
	static function topBar()
	{
		$config = Config::get();
		$base = $config['general']['staticUrl'];
		$loginForm = new LoginForm();
		$loginForm->handleParams();
		$lfMarkup = $loginForm->getHTML();
		$icons = ['🏠' => '/index.php'];
		if(Authenticator::$user !== NULL)
		{
			$loggedInIcons = ['🔧' => '/admin.php'];
			$icons = array_merge($icons, $loggedInIcons);
		}
		$iconsHTML = '';
		foreach($icons as $link => $page)
		{
			$info = pathinfo($page);
			$title = ucwords($info['filename']);
			$iconsHTML .= '<a href="' . $page . '"'
				. (($page == $_SERVER['PHP_SELF']) ? ' class="selectedNav"' : '')
				. ' title="' . $title . '">' . $link . '</a>';
		}
		
		$out = <<<HTMLCONTENT
  <div id="header" class="clearfix">
   <a id="logo" href="/">
    <img src="$base/servo/gears.jpg"/>
   </a>
   $lfMarkup
   <span id="icons">
    $iconsHTML
   </span>
  </div>
HTMLCONTENT;
		return $out;
	}
	
	static function headContent()
	{
		$config = Config::get();
		$base = $config['general']['staticUrl'];
		$comp = $config['general']['staticDir'];
		
		$mt_main_css       = filemtime($comp . '/servo/main.css');
		
		$out = <<<HTMLCONTENT
  <link rel="stylesheet" href="$base/servo/main.css?ver=$mt_main_css"/>
HTMLCONTENT;
		return $out;
	}
}

?>