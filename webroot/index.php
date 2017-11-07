<?php
require_once('vendor/autoload.php');
use \mls\ki\Security\Authenticator;
use \mls\ki\Widgets\LoginForm;
mls\ki\Ki::init();

echo mls\ki\MarkupGenerator::pageHeader();
echo 'Hello World';
echo mls\ki\MarkupGenerator::pageFooter();

?>