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
$dtSessions = NULL;
processPage();

//Output
echo MarkupGenerator::pageHeader(PageElements::headContent());
echo PageElements::topBar();
echo body();
echo MarkupGenerator::pageFooter();

//Page level resources
function processPage()
{
	global $dtSessions;
	if(Authenticator::$user !== NULL)
	{
		$dtSessions = LoginForm::getSessionEditor();
		$dtSessions->handleParams();
	}
}

function body()
{
	global $dtSessions;
	$out = '';
	if(Authenticator::$user !== NULL)
	{
		$out .= 'This is a list of all currently logged in sessions for your account. Deleting one is the same as clicking Logout from that location.<br/><br/>';
		$out .= $dtSessions->getHTML();
	}else{
		$out .= 'Hi, please login';
	}
	return $out;
}

?>