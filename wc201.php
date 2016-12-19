<?php

/*チャット画面　画面ID : WC201*/

	/*インクルード*/
	require('define.php');
	require('chatlog.php');

	/*ID, Passwardが入力されてるか？*/
	if($_REQUEST['loginID'] === NULL_ID || $_REQUEST['password'] === NULL_PASS){
		//ID,Passwardが未記入ならエラー画面へ
		header("Location: er001.php");
		exit(0);
	}
	if($_REQUEST['loginID'] != ID_NOTEXIST){
		header("Location: er002.php");
		exit(0);
	}
	if($_REQUEST['loginID'] === 'tom'){
		if($_REQUEST['password'] != 'nosushinolife'){
			header("Location: er003.php");
			exit(0);
		}
	}
	if($_REQUEST['loginID'] === 'mike'){
		if($_REQUEST['password'] != 'apple2016'){
			header("Location: er003.php");
			exit(0);
		}
	}
	if($_REQUEST['loginID'] === 'mary'){
		if($_REQUEST['password'] != 'c@ndyclash'){
			header("Location: er003.php");
			exit(0);
		}
	}
	
	//入力された値を代入
	$id 	   = $_REQUEST['loginID'];
	$password = $_REQUEST['password'];
	if($id === 'tom' && $password === 'nosushinolife'){
		$userName = "GOD";
	}
	if($id === 'mike' && $password === 'apple2016'){
		$userName = "Taro";
	}
	if($id === 'mary' && $password === 'c@ndyclash'){
		$userName = "Yoko";
	}
	
	$chatlog = new ChatLog();
	if($chatlog->Initialize() === false){
		exit(0);
	}
	
	$state = STATE_NONE;
	if(!empty($_REQUEST['state'])){
		$state = $_REQUEST['state'];
		
		if($state === STATE_LOGIN){
			$systemMessage = "$userName Login.";
			$chatlog->Add(SYSTEM_NAME, $systemMessage);
		}
		if($state === STATE_LOGOUT){
			$systemMessage = "$userName Logout.";
			$chatlog->Add(SYSTEM_NAME, $systemMessage);
			header("Location: index.php");
			exit(0);
		}
		
	}
	
	
	$message = '';
	//コメントが書き込まれているか？
	if(!empty($_REQUEST['message'])){
		$message = $_REQUEST['message'];
		$chatlog->Add($userName, $message);
	}
	

	
		
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Chat</title>
		
		<link rel="stylesheet" href="style.css" type="text/css">

	</head>

	<body>
		
		<!--コメントを書き込む-->
		<form action="wc201.php">
			<!--送る引数-->
			<input type="hidden" name="name" value="<?php print $userName ?>" />
			<!--名前-->
			<p><?php print $userName ?>
			<!--コメント入力欄-->
			<input type="text" name="message" size="30" maxlength="30">			
			<!--コメントを書き込む-->
			<input type="submit" value="Write"></p>
					
		</form>
		
		<!--横線-->
		<hr>	
		
		<!--更新-->
		<form action="wc201.php">
			<!--送る引数-->
			<input type="hidden" name="name" value="<?php print $userName ?>" />
			<!--更新-->
			<input type="submit" value="Refresh"></p>
		</form>	
		
		
		<!--コメント欄-->
		
		<div class="frame">
		
		<?php
			$log = $chatlog->GetLog();
			$length = count($log);
			$count = 0;
			
			if($length >= 1){
    			for($i=$length - 1; $i >= 0; $i--){
    				if($log[$i][LOG_NAME] === SYSTEM_NAME){ 
    				    	?>
    				   <a class="systemName"><?php print $log[$i][LOG_NAME] ?></a>
     				   <a class="systemMessage"><?php print $log[$i][LOG_MESSAGE] ?></a>
     				   <a class="date">  (<?php print $log[$i][LOG_DATE] ?>)</a>			  
    						<?php
    				}else{
    						?>
    				   <a class="userName"><?php print $log[$i][LOG_NAME] ?></a>
     				   <a class="userMessage"><?php print $log[$i][LOG_MESSAGE] ?></a>
     				   <a class="date">  (<?php print $log[$i][LOG_DATE] ?>)</a>	
    						<?php
    				}
    				
					//コメントの最大表示数を超えたか？
					if($count >= MAX_PRINT_MESSAGE - 1)
						break;
					
					$count++;
					
					   				 			
					//<!--横線-->
					print "<hr>";		
   				 }			

			}			
		?>
		
		</div>
			
		<!--横線-->
		<hr>	
		
		<!--過去ログ-->
		<a href="./wc301.php" target="_blank">History</a>

		
		<!--ログアウト-->		
		<form action="wc201.php">
			<!--ログアウト-->
			<input type="submit" value="Logout"></p>
			<!--送る引数-->
			<input type="hidden" name="name" value="<?php print $userName ?>" />
			<input type="hidden" name="state" value="<?php print STATE_LOGOUT ?>" />

		</form>
		


	</body>
</html>
