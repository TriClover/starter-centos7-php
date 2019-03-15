<?php
require_once('../../vendor/autoload.php');
use \mls\ki\Ki;
use \mls\ki\MarkupGenerator;
use \mls\ki\Security\Authenticator;
use \mls\ki\Setup\Setup;
use \mls\ki\Widgets\LoginForm;

//Setup page

$ansibleConfig = yaml_parse(file_get_contents('../../provision/ansibleConfig.yml'));
$production = $ansibleConfig['production'];
$kiSetupConfig = [];
$kiSetupConfig['general'] = [];
$kiSetupConfig['general']['staticDir'] = '../static';
$kiSetupConfig['general']['staticUrl'] = $production ? '' : 'https://localhost:8802';
$kiSetupConfig['general']['environment'] = $production ? '' : 'local';
$setup = new Setup('site1', [], $kiSetupConfig);
$setup->handleParams();
echo MarkupGenerator::pageHeader();
echo $setup->getHTML();
echo MarkupGenerator::pageFooter();


//Starter main page
/*require_once('../../src/PageElements.php');
Ki::init('site1');
Authenticator::checkLogin();
echo MarkupGenerator::pageHeader(PageElements::headContent());
echo PageElements::topBar();
echo authMessage();
echo MarkupGenerator::pageFooter();

function authMessage()
{
	if(Authenticator::$user !== NULL)
	{
		return 'Now browsing secure area';
	}else{
		return 'Hi, please login';
	}
}
*/
?>