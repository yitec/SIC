<?

  


$salida=shell_exec ("C:\AppServ\MySQL\bin\mysqldump  -h 163.178.170.160 bd_sic   > C:\\Users\SID\backup_".date("Y_m_d_H_i_s").".sql -u root -p1q2w3e");
//$salida=shell_exec ("C:\AppServ\MySQL\bin\mysqldump -h 192.168.1.101 bd_sic   > C:\\Respaldos_SIC\backup_".date("Y_m_d_H_i_s").".sql -u root -p1q2w3e");

echo "entro";

  
 

?>