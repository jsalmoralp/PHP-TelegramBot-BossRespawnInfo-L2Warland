<?php 
echo 'El bot esta Trabajando ...';

include('vendor/autoload.php');

include_once('settings.php');
include('db.php');
include('bot_lib_users.php');
include('bot_lib_infoBoss_l2warland.php');

include('menu.php');

use Telegram\Bot\Api;

$telegram = new Api(API_TOKEN);
$updates = $telegram->getWebhookUpdates();

$chat_id = $updates["message"]["chat"]["id"];
$username = $updates["message"]["from"]["username"];
$first_name = $updates["message"]["from"]["first_name"];
$last_name = $updates["message"]["from"]["last_name"];

$get_user = bd_getUser($connect, $chat_id);
$old_id = 0;
if ($get_user['chat_id']){
	$old_id = $get_user['chat_id'];
}
$name = $first_name.' ' .$last_name;
$user_added = bd_addUser($connect, $username, $chat_id, $name, $old_id);


/*============================================================
=            Comandos introducidos por el usuario            =
============================================================*/
$command = $updates["message"]["text"];

switch ($command) {
	
	/*============================
	=            Menu            =
	============================*/
	case '/noticias':
		$response = "Menu: ";
		$response_markup = $telegram->replyKeyboardMarkup([
			'keyboard' => $menu_servers,
			'resize_keyboard' => true,
			'one_time_keyboard' => false
		]);
		$telegram->sendMessage([
			'chat_id' => $chat_id,
			'text' => $response,
			'reply_markup' => $response_markup
		]);
		break;

	/*----------  Servidor Warland  ----------*/
	case '/L2Warland':
		$response = "Opciones para Warland: ";
		$response_markup = $telegram->replyKeyboardMarkup([
			'keyboard' => $menu_l2warland,
			'resize_keyboard' => true,
			'one_time_keyboard' => false
		]);
		$telegram->sendMessage([
			'chat_id' => $chat_id,
			'text' => $response,
			'reply_markup' => $response_markup
		]);
		break;
	case '/start_l2wl':
		$response = "Van a empezar a llegarte mensajes de cuando MUEREN o REAPARECEN los Bosses!\nPara el servidor de Warland.";
		$telegram->sendMessage([
			'chat_id' => $chat_id,
			'text' => $response
		]);
		bd_update_start_stop_messages_l2warland($connect, $chat_id, 1);
		break;
	case '/stop_l2wl':
		$response = "Vas a parar de recibir info de los Bosses de Warland!";
		$response_markup = $telegram->replyKeyboardMarkup([
			'keyboard' => $menu_servers,
			'resize_keyboard' => true,
			'one_time_keyboard' => false
		]);
		$telegram->sendMessage([
			'chat_id' => $chat_id,
			'text' => $response,
			'reply_markup' => $response_markup
		]);
		bd_update_start_stop_messages_l2warland($connect, $chat_id, 0);
		break;
	case '/now_l2wl':
		exec("php /var/www/bots_jsalmoralp_es/html/scrapings/forBot-bossRespawn_l2warland/web_scraping-on_l2warland.php");
		exec("php /var/www/bots_jsalmoralp_es/html/bots/telegram_bossRespawn/broadcaster.php");
		$response = "Ya has revisado toda la lista!\nNO hagas spam porfavor!.";
		$telegram->sendMessage([
			'chat_id' => $chat_id,
			'text' => $response
		]);
		break;
	case '/alive_l2wl':
		exec("php /var/www/bots_jsalmoralp_es/html/scrapings/forBot-bossRespawn_l2warland/web_scraping-on_l2warland.php");
		exec("php /var/www/bots_jsalmoralp_es/html/bots/telegram_bossRespawn/broadcaster_only_alive.php");
		$response = "Ya has revisado toda la lista!\nNO hagas spam porfavor!.";
		$telegram->sendMessage([
			'chat_id' => $chat_id,
			'text' => $response
		]);
		break;
	/*=====  End of Menu  ======*/


	/*==============================
	=            Bromas            =
	==============================*/
	case '/cobra':
		$response = "La picadura de la cobra Gay! Si te pica te vuelves GAY!!!\nYa sabemos que quieres salir del armario!!\n".$name." eres un gay!!!";
		$telegram->sendMessage([
			'chat_id' => $chat_id,
			'text' => $response
		]);
		break;
	case '/help':
		$response = "Amigo aqui no te va ayudar ni el tato!!!\n".$name." eres un NOOOOOOB!!!";
		$telegram->sendMessage([
			'chat_id' => $chat_id,
			'text' => $response
		]);
		break;
	
	/*=====  End of Bromas  ======*/


	default:
		$response = "Sisisisisi!!!! Claro Como el agua!!!!";
		$telegram->sendMessage([
			'chat_id' => $chat_id,
			'text' => $response
		]);
		break;
}

/*=====  End of Comandos introducidos por el usuario  ======*/
