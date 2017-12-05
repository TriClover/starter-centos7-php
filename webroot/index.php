<?php
require_once('vendor/autoload.php');
use \mls\ki\Ki;
use \mls\ki\MarkupGenerator;
use \mls\ki\Security\Authenticator;
use \mls\ki\Setup\Setup;
use \mls\ki\Widgets\LoginForm;

//Ki::init('site1');

$setup = new Setup('site1');
$setup->handleParams();

echo MarkupGenerator::pageHeader();
//echo 'Hello World';
echo $setup->getHTML();
echo MarkupGenerator::pageFooter();

?>