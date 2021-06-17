<?php
session_start();
if(isset($_POST['username'])){
	$_SESSION['username']=$_POST['username'];
}
if(isset($_GET['logout'])){
	unset($_SESSION['username']);
	header('Location:index.php');
}
?>
<html>
<head>
	<title>Simple Chat Room</title>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,400,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/style.css" />
	<script type="text/javascript" src="js/jquery-1.10.2.min.js" ></script>
</head>
<body>
<div class='header'>
	<h1>
		Basit Mesaj Odasi
		<?php   ?>
		<?php if(isset($_SESSION['username'])) { ?>
			<a class='logout' href="?logout">Cikis</a>
		<?php } ?>
	</h1>

</div>

<div class='main'>
<?php ?>
<?php if(isset($_SESSION['username'])) { ?>
<div id='result'></div>
<div class='chatcontrols'>
	<form method="post" onsubmit="return submitchat();">
	<input type='text' name='chat' id='chatbox' autocomplete="off" placeholder="..." />
	<input type='submit' name='send' id='send' class='btn btn-send' value='Send' />
	<input type='button' name='clear' class='btn btn-clear' id='clear' value='X' title="Mesajlari sil" />
</form>
<script>
function submitchat(){
		if($('#chat').val()=='' || $('#chatbox').val()==' ') return false;
		$.ajax({
			url:'chat.php',
			data:{chat:$('#chatbox').val(),ajaxsend:true},
			method:'post',
			success:function(data){
				$('#result').html(data); 
				$('#chatbox').val(''); 
				document.getElementById('result').scrollTop=document.getElementById('result').scrollHeight; 
			}
		})
		return false;
};
setInterval(function(){
	$.ajax({
			url:'chat.php',
			data:{ajaxget:true},
			method:'post',
			success:function(data){
				$('#result').html(data);
			}
	})
},1000);
$(document).ready(function(){
	$('#clear').click(function(){
		if(!confirm('Mesajları silmek istediğine emin misin?'))
			return false;
		$.ajax({
			url:'chat.php',
			data:{username:"<?php echo $_SESSION['username'] ?>",ajaxclear:true},
			method:'post',
			success:function(data){
				$('#result').html(data);
			}
		})
	})
})
</script>
<?php } else { ?>
<div class='userscreen'>
	<form method="post">
		<input type='text' class='input-user' placeholder="Buraya ismini gir" name='username' />
		<input type='submit' class='btn btn-user' value='Baslat' />
	</form>
</div>
<?php } ?>

</div>
</body>
</html>
<?php
$ipadres = $_SERVER["REMOTE_ADDR"]; 
$ipkayit = fopen("ipkayit.txt", "a");
fwrite($ipkayit,"$ipadres<br>");
?>