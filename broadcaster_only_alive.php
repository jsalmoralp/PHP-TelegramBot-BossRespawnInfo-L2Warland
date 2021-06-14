<?php 

include('db.php');
include('bot_lib_infoBoss_l2warland.php');

$messages_all = bd_getData_chatBroadcast_l2warland_where_bradcasted_0_and_user_active($connect);
foreach ($messages_all as $message) {
	$chat_id = $message["chat_id"];
	$status = "";
	if ($message['state']==1) {
		$status= 'a REAPARECIDO';
	} else if ($message['state']==0) {
		$status= 'a MUERTO';
	}
	$message = "El [".$message['type']."] ".$message['name']." (Level ".$message['level'].") ".$status;
	$url = file_get_contents("https://api.telegram.org/bot917889051:AAGUfBjfnACMsl8hoPC3O9xDQIvsYs-vzJM/sendMessage?chat_id=".$chat_id."&text=".$message."&parse_mode=HTML");

}	

$query = "UPDATE infoBosses_l2warland set broadcasted=1";
$result = mysqli_query($connect, $query);
if (!$result){
	die(mysqli_error($connect));
}