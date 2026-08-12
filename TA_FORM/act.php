<?php

	session_start();

	//##8/11更新 重整架構，判定有pdf檔案上傳成功，才能有data.txt生成去成功勾選radio
		
	
	//##8/10更新 路徑建立
	$recordsFolderPath = './records';
	
	
	//抓取form填寫的資料內容命名為data.txt
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$number = $_POST["number"];
		$name = $_POST["name"];
		$grade = $_POST["grade"];
		$phone = $_POST["phone"];
		$email = $_POST["mail"];
		$supervisor = $_POST["techer"];
		
		
		###8/9新增 寫入選取的助教類型/課程代號#####
		$classdata = trim($_POST['radio_group']);
		
		// 對數據進行額外處裡
		$classdata = preg_replace('/(碩A|碩B|大四B)/', '$1.', $classdata);
		
		
		###下面還有輸出#####
		
		
		// 對學號進行處理，刪除特殊字符並轉換為小寫
		$sanitizedNumber = preg_replace("/[^a-zA-Z0-9]/", "", $number);
		$folderName = strtoupper($sanitizedNumber);
		// 資料夾路徑
		$userFolderPath = $recordsFolderPath . "/" . $folderName . '/';
		// 建立使用者資料夾
		if (!file_exists($userFolderPath)) {
			mkdir($userFolderPath);
		}
		
		
		//申請表
		$targetDir = $userFolderPath;
		$fileToUpload = $_FILES["pdf"];
		$targetFilePath = $targetDir . 'applyform.pdf';
		$errA = 0;
		
		//申請表上傳是否成功
		if (isset($fileToUpload) && $fileToUpload['error'] === UPLOAD_ERR_OK) {
			//檔案名稱(舊名)
			$uploadedFileName = $fileToUpload['name'];
			// 判定是否為PDF檔案
			$ext = pathinfo($uploadedFileName, PATHINFO_EXTENSION);
			
			//判定是否上傳過且為PDF檔案
			if (strtolower($ext) === 'pdf') {
				// 若是PDF檔案且已經存在，覆蓋申請表
				if (file_exists($targetFilePath)) {
					move_uploaded_file($fileToUpload['tmp_name'], $targetFilePath);
					echo "已重新上傳申請表 <br>";
				}
				else{
					move_uploaded_file($fileToUpload['tmp_name'],$targetFilePath);
					echo "申請表上傳成功 <br>";
				}
			}
			else {
				//不接受此檔案上傳
				echo '!!申請表僅接受PDF格式!! <br>';
				$errA = 1;
			}
		}
		
		else {
			echo '!!申請表上傳失敗!! <br>';
			$errA = 1;
		}
		
		echo "<hr>";
		

		//##8/12更新 申請表上傳成功情況下，才可上傳附加檔案以及撰寫data.txt

		//最終判定回傳訊息，有申請表上傳才能寫data.txt
		if($errA == 1){
			echo "!!請重新填寫表單以及上傳相關資料後送出!! <br>";
			
		}
		else{
			//附件
			$attachmentCount = 0;
			$oldFileNames = array(); // 建立空陣列來存儲舊檔案名稱
			
			// 附件檔案上傳
			foreach ($_FILES['myFile']['tmp_name'] as $key => $tmp_name) {
				if (is_uploaded_file($tmp_name)) {
					// 如果有檔案上傳，附件數量加1
					$attachmentCount++;
				
					// 取得舊檔案名稱
					$oldFileName = $_FILES['myFile']['name'][$key];
					$oldFileNames[] = $oldFileName; // 將舊檔案名稱存入陣列
					
					$fileExt = pathinfo($oldFileName, PATHINFO_EXTENSION);
					$newFileName = "file" . ($key + 1) . "." . $fileExt;
					$destination = $targetDir . $newFileName;
					// 更改名稱
					move_uploaded_file($tmp_name, $destination);
				}
			}
			
			//顯示檔案傳送名稱和數量
			if($attachmentCount >= 1){
				foreach ($oldFileNames as $index => $oldFileName) {
					echo "附件{$oldFileName} 已上傳成功  <br>";
				}
				echo "<br>";
				echo "附件資料  共".$attachmentCount."件  已成功上傳<br>";
				
			}
			
			else{
				echo "無上傳任何附件資料";
				echo "<br>";
			}


			echo "<hr>";
			
			
			echo "檔案上傳完成";

			// 訊息資料寫入
			$data = "學號：$number\n";
			$data .= "姓名：$name\n";
			$data .= "年級：$grade\n";
			$data .= "手機：$phone\n";
			$data .= "E-mail：$email\n";
			$data .= "指導教授/導師：$supervisor\n";
			
			###8/9新增 寫入選取的助教類型/課程代號#####
			$data .="選取助教類型/課程代號：$classdata";
			###8/9更新 下面還有#####
			// 手動删除換行符號
			$classdata = str_replace("\n", "", $classdata);
			
			$desktopPath = $userFolderPath . 'data.txt';
			
			//覆寫舊資料
			file_put_contents($desktopPath, $data);
		}
	}
	//##8/12更新 申請表上傳成功情況下，才可上傳檔案以及撰寫data.txt
	
	
	//##8/11更新 重整架構，判定有pdf檔案上傳成功，才能有data.txt生成去成功勾選radio
	
	
?>

<!--按鈕-->
<br>
<button onclick="goBack()">返回表單</button>

<script>
	//##8/12更新 按下返回為新表單
	function goBack() {
		
		window.location.href = "./form.php";
	}
	
</script>