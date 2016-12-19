<!--ログイン画面　画面ID : WC101-->

<?php

	/*インクルード*/
	require('define.php');

?>

<html>
	<head>
		<title> Chat - Login </title>
	</head>
	
	<body>
	
		<form action="wc201.php">
	
			<!--Title Name-->
			<p><h1>Chat</h1></p>		
		
			<!--<p>-->
				<!-- 名前入力欄 -->
				<!--Your Name: 
				<!--<input type="text" name="name">			
			<!--</p>-->
			
			<p style="text-align: center;">
				<!-- ID -->
				Login ID: 
				<input type="text" name ="loginID" placeholder="IDを入力">
			</p>
			
			<p style="text-align: center;">
				<!-- Password -->
				Password: 
				<input type="password" name ="password" placeholder="パスワードを入力">
			</p>
		
			<!--ログインボタン-->
			<p style="text-align: right;"><input type="submit" value="Login"></p>		
			
			<!--送る引数-->
			<input type="hidden" name="state" value="<?php print STATE_LOGIN ?>" />	

		
		</form>
		
		

	</body>
	
</html>
