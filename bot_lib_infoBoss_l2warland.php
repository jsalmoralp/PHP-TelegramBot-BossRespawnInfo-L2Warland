<?php 

function bd_getData_infoBosses_l2warland_where_bradcasted_0($p_connect){
	$t = "SELECT * FROM infoBosses_l2warland WHERE bradcasted=0";
	$query = sprintf($t, $bossName);
	$result = mysqli_query($p_connect, $query);
	if (!$result){
		die(mysqli_error($p_connect));
	}
	$get_data = mysqli_fetch_assoc($result);
	return $get_data;
}

function bd_updateData_for_chatBroadcast_l2warland($p_connect){
	$updated_bosses = bd_getData_infoBosses_l2warland_where_bradcasted_0($p_connect);
	while ($updated_boss = mysqli_fetch_array($updated_bosses)) {
		$t = 'UPDATE chatBroadcast_l2warland, infoBosses_l2warland SET chatBroadcast_l2warland.broadcasted=0, infoBosses_l2warland.broadcasted=1 WHERE chatBroadcast_l2warland.boss_id=%s AND  infoBosses_l2warland.id=%s';
		$query = sprintf($t, $updated_boss["id"]);
		$result = mysqli_query($p_connect, $query);
		if (!$result){
			die(mysqli_error($p_connect));
		}
	}
	return true;
}

function bd_getData_chatBroadcast_l2warland_where_bradcasted_0_and_user_active($p_connect){
	$query = 'SELECT chatBroadcast_servers.chat_id, infoBosses_l2warland.* FROM chatBroadcast_servers, infoBosses_l2warland WHERE chatBroadcast_servers.l2warland=1 AND infoBosses_l2warland.broadcasted=0';
	$result = mysqli_query($p_connect, $query);
	if (!$result){
		die(mysqli_error($p_connect));
	}
	$n = mysqli_num_rows($result);
	$messages_all = array();
	for ($i= 0; $i<$n; $i++){
		$row = mysqli_fetch_assoc($result);
		$messages_all[] = $row;
	}
	return $messages_all;
}

function bd_getData_chatBroadcast_l2warland_where_boss_alive($p_connect){
	$query = 'SELECT chatBroadcast_servers.chat_id, infoBosses_l2warland.* FROM chatBroadcast_servers, infoBosses_l2warland WHERE chatBroadcast_servers.l2warland=1 AND infoBosses_l2warland.state=1';
	$result = mysqli_query($p_connect, $query);
	if (!$result){
		die(mysqli_error($p_connect));
	}
	$n = mysqli_num_rows($result);
	$messages_all = array();
	for ($i= 0; $i<$n; $i++){
		$row = mysqli_fetch_assoc($result);
		$messages_all[] = $row;
	}
	return $messages_all;
}
