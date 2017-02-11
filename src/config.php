<?php
//CodeIgniter would also be implemented for other interesting purposes.
$connection_details=[
	
	'host'=>'localhost',
	'username'=>'root',
	'password'=>'',
	'database'=>'authtest',
	'users_table'=>'phpauthtest'

];
$connect= new mysqli($connection_details['host'],$connection_details['username'],$connection_details['password'],$connection_details['database']);

return [
		'connectsqli'=>$connect,
		'connection_details'=>$connection_details,
		'sql_connect_error'=>mysqli_connect_error(),
];
