<?php
//External resources
require_once('../../vendor/autoload.php');
use \mls\ki\Ki;
use \mls\ki\MarkupGenerator;
use \mls\ki\Security\Authenticator;
use \mls\ki\Security\User;
use \mls\ki\Widgets\DataTable;
use \mls\ki\Widgets\DataTableField;
use \mls\ki\Widgets\LoginForm;
use \mls\ki\Database;
//App level resources
require_once('../../src/PageElements.php');

//Processing
Ki::init('site1');
Authenticator::checkLogin();
$db = Database::db();
$dtUsers = NULL;
processPage();

//Output
echo MarkupGenerator::pageHeader(PageElements::headContent());
echo PageElements::topBar();
echo body();
echo MarkupGenerator::pageFooter();

//Page level resources
function processPage()
{
	global $dtUsers;
	if(Authenticator::$user !== NULL)
	{
		$dtUsers = User::getUserAdmin();
		$dtUsers->handleParams();
	}
}

function body()
{
	global $dtUsers;
	$out = '';
	if(Authenticator::$user !== NULL)
	{
		$out .= $dtUsers->getHTML();
	}else{
		$out .= 'Hi, please login';
	}
	return $out;
}

?>