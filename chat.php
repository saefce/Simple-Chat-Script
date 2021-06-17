<?php
session_start();

if(isset($_POST['ajaxsend']) && $_POST['ajaxsend']==true){
	$chat = fopen("chatdata.txt", "a");
	$data="<b>".$_SESSION['username'].':</b> '.$_POST['chat']."<br>";
	fwrite($chat,$data);
	fclose($chat);

	$chat = fopen("chatdata.txt", "r");
	echo fread($chat,filesize("chatdata.txt"));
	fclose($chat);
} else if(isset($_POST['ajaxget']) && $_POST['ajaxget']==true){
	$chat = fopen("chatdata.txt", "r");
	echo fread($chat,filesize("chatdata.txt"));
	fclose($chat);
} else if(isset($_POST['ajaxclear']) && $_POST['ajaxclear']==true){
	$chat = fopen("chatdata.txt", "w");
	$data="<b>".$_SESSION['username'].'</b> Sohbet silindi<br>';
	fwrite($chat,$data);
	fclose($chat);
}