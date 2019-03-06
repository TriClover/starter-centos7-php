<?php
//External resources
require_once('../vendor/autoload.php');
use \mls\ki\Ki;
use \mls\ki\MarkupGenerator;
use \mls\ki\Security\Authenticator;
use \mls\ki\Widgets\DataTable;
use \mls\ki\Widgets\DataTableField;
use \mls\ki\Widgets\LoginForm;
use \mls\ki\Database;
//App level resources
require_once('PageElements.php');

//Processing
Ki::init('site1');
Authenticator::checkLogin();
$db = Database::db();
$dtPassword = NULL;
$dtEmail = NULL;
processPage();

//Output
echo MarkupGenerator::pageHeader(PageElements::headContent());
echo PageElements::topBar();
echo body();
echo MarkupGenerator::pageFooter();

//Page level resources
function processPage()
{
	global $dtPassword;
	global $dtEmail;
	if(Authenticator::$user !== NULL)
	{
		$dtPassword = LoginForm::getPasswordEditor();
		$dtPassword->handleParams();
		$dtEmail = LoginForm::getEmailEditor();
		$dtEmail->handleParams();
	}
}

function body()
{
	global $dtPassword;
	global $dtEmail;
	$out = '';
	if(Authenticator::$user !== NULL)
	{
		$out .= $dtPassword->getHTML() . '<br/><br/>';
		$out .= $dtEmail->getHTML();
	}else{
		$out .= 'Hi, please login';
	}
	return $out;
}

?>