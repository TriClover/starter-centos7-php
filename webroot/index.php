<?php
require_once('vendor/mls/ki/ki.php');
header(ki\htmlHeaders());
ki\init();

$fields = array();
$fields[] = new ki\widgets\DataTableField('id');
$fields[] = new ki\widgets\DataTableField('name', NULL, 'nomini', true, true, true, array('pattern'=>'^[a-zA-Z]*$'));
$fields[] = new ki\widgets\DataTableField('enabled', NULL, NULL, true, true, 1);
$fields[] = new ki\widgets\DataTableField('age', NULL, NULL, true, false, true, NULL);
$fields[] = new ki\widgets\DataTableField('altname');
$users = new ki\widgets\DataTable('users', 'ki_users', $fields, true, true, false, 3, false, false, false, false, NULL, array('Reset Password'=>'testCallback'));
$users->handleParams();

echo ki\pageHeader();
echo $users->getHTML();
echo ki\pageFooter();

function testCallback($pk)
{
	echo "Test callback\n";
	var_dump($pk);
}

?>