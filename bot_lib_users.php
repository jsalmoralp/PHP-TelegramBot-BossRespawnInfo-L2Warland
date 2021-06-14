<?php 

function bd_addUser($p_connect, $p_username, $p_chat_id, $p_name, $p_old_id){
	$username = trim($p_username);
	$chat_id = trim($p_chat_id);
	$name = trim($p_name);
	if ($chat_id == $p_old_id){
		return false;
	}
	$t = "INSERT INTO users (username, chat_id, name) VALUES ('%s', %s, '%s')";
	$query = sprintf($t, $username, $chat_id, $name);
	$result = mysqli_query($p_connect, $query);
	if (!$result){
		die(mysqli_error($p_connect));
	}
	$t3 = "INSERT INTO chatBroadcast_servers (chat_id) VALUES (%s)";
	$query3 = sprintf($t3, $p_chat_id);
	$result3 = mysqli_query($p_connect, $query3);
	if (!$result3){
		die(mysqli_error($p_connect));
	}
	return true;
}

function bd_getUser($p_connect, $p_chat_id){
	$chat_id = trim($p_chat_id);
	$t = "SELECT * FROM users WHERE chat_id=%s";
	$query = sprintf($t, $chat_id);
	$result = mysqli_query($p_connect, $query);
	if (!$result){
		die(mysqli_error($p_connect));
	}
	$get_user = mysqli_fetch_assoc($result);
	return $get_user;
}


function bd_update_start_stop_messages_l2warland($p_connect, $p_chat_id, $p_startStop_l2warland){
	$t = 'UPDATE chatBroadcast_servers SET l2warland=%s WHERE chat_id=%s';
	$query = sprintf($t, $p_startStop_l2warland, $p_chat_id);
	$result = mysqli_query($p_connect, $query);
	if (!$result){
		die(mysqli_error($p_connect));
	}
}