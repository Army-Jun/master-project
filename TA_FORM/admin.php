<?php
	//##8/13更新 全改為PHP方式撰寫，加入判定formACT是否有寫出密碼後進入表單，若否跳回此登入系統

	session_start();
	//設定造訪時間限制(1小時)
	$allowedDuration = 3600;
	
	// 檢查是否有訊息需要顯示
    $admin_message = isset($_SESSION["admin_message"]) ? $_SESSION["admin_message"] : "";
    unset($_SESSION["admin_message"]); // 清除已顯示的訊息
	
	
	// 設定密碼
	$expectedPassword = "2118800";
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$password = $_POST["user"];

		if ($password === $expectedPassword) {
			$_SESSION["admin_logged_in"] = true;
			$_SESSION["admin_login_time"] = time();
			header("Location: formACT.php");
			exit;
		}
		else {
			$errorMessage = "密碼錯誤，請重新輸入！";
		}
	}
	//判斷formACT是否有密碼登入
	if (isset($_SESSION["admin_logged_in"]) &&
		$_SESSION["admin_logged_in"] &&
		isset($_SESSION["admin_login_time"]) &&
		(time() - $_SESSION["admin_login_time"]) <= $allowedDuration) {
			header("Location: formACT.php");
			exit;
	}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="utf-8" />
        <title>AI學程助教 管理員登入系統</title>
    </head>
    <body>
		<?php if (isset($errorMessage)) { ?>
			<p style="color: red; text-align: center;"><?php echo $errorMessage; ?></p>
		<?php } ?>

		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" style="text-align: center; margin-top: 100px;">
			<label for="password" style="text-align: center; margin-top: 300px; font-size: 30px;">請輸入管理員密碼</label><br>
			<br>
			<input type="password" name="user" id="password" style="font-size:20px; height:20px; width:250px"><br>
			<input type="submit" value="確定" style="font-size:20px; height:2em; width:3em; margin-top: 15px;">
		</form>
	</body>
</html>

