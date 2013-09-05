<?
error_reporting(1);
define('BACKUPDIR', '/back_upDb/');
echo $filename=date('dMY_H.i.s').".sql";
$dbarg = $backupall ? '-A' : bd_sic;
 	// formamos el comando a ejecutar 
//$command = "mysqldump bd_sic -u root -p1q2w3e -r ".BACKUPDIR.$filename. "2>&1";
$command = "mysqldump bd_sic -u root -p1q2w3e  -r C:\Users\SID\Downloads\Db_sic2.sql ";
echo $command;
system($command);
system('bzip2 "'.BACKUPDIR.$_POST['filename'].'"'); 	
?>