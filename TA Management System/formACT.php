<?php
	//##8/13更新 新增判定，必須經過admin登入才可觀看此表單
	
	//檢查是否已登入過管理員密碼，若否則跳回admin
	session_start();
	//設定造訪時間限制(1小時)
	$allowedDuration = 3600;
	
	if (!isset($_SESSION["admin_logged_in"]) ||!$_SESSION["admin_logged_in"] || !isset($_SESSION["admin_login_time"]) ||
	(time() - $_SESSION["admin_login_time"]) > $allowedDuration) {
		header("Location: admin.php");
		exit;
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>111學年度第二學期資工系、AI學程助教工作申請表</title>
	<style>
		em {color: purple}
		mark {color: red}
	</style>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://unpkg.com/g-sheets-api"></script>
</head>
<body>
	<header>
		<h1 style="text-align: center;"><i><em>111學年度第二學期資工系、AI學程助教工作申請表<br>申請之助教工作一覽表</em></i></h1>
	</header>

	<style>
		/* 添加表格格线样式 */
		table {
			border-collapse: collapse;
			width: 100%;
		}

		th, td {
			border: 2px solid black;
			padding: 8px;
			text-align: left;
		}
		/* 设置表头背景色和文字样式 */
		th {
			background-color: #f2f2f2;
			font-size: 16px;
		}

		/* 设置表格内容文字样式 */
		td {
			font-size: 16px;
		}
	</style>

	<?php	
		function curl_get($url) {
			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

			$output = curl_exec($ch);
			curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');

			curl_close($ch);

			return $output;
		}
		
		//##8/12更新 修改路徑
		ob_start();
		require "./form.php";
		$html = ob_get_clean();

		$dom = new DOMDocument();
		@$dom->loadHTML($html);
		//##8/12更新 修改路徑		
		
		//##8/11更新 路徑除錯
		$recordsFolderPath = './records/';
		
		$rows = $dom->getElementsByTagName('tr');

		echo '<table id="ACTdata-table">';
		echo '<tr>';
		echo '<th style="font-size:18px; width:50px; text-align: center;"><h3>工作督導教師</h3></th>';
		echo '<th style="font-size:18px; width:300px; text-align: center; font-size: 20px;">課程/助教具備的技術背景或先修課程要求欄位留空</th>';
		echo '<th style="font-size:18px; width:50px; text-align: center;"><h3>統計至1/16 之<br>修課人數</h3></th>';
		echo '<th style="font-size:18px; width:70px; text-align: center;"><h3>申請人 /<br>上傳文件連結</h3></th>';
		echo '<th style="font-size:18px; width:35px; text-align: center;"><h3>人數/類別</h3></th>';
		echo '<th style="font-size:18px; width:40px; text-align: center;"><h3>系所 /<br>用人單位代號</h3></th>';
		echo '</tr>';

		$counter = 3;
		
		foreach ($rows as $row) {
			$cols = $row->getElementsByTagName('td');
			if ($cols->length === 6) {
				$technical_background = trim($cols->item(1)->nodeValue);
				$supervising_teacher = trim($cols->item(3)->textContent);
				$number_category = trim($cols->item(2)->textContent);
				$course_population = trim($cols->item(4)->nodeValue);
				$department_code = trim($cols->item(5)->nodeValue);

				echo '<tr>';
				echo '<td style="font-size:18px; text-align: center;">' . $supervising_teacher . '</td>';
				$technical_background = str_replace("TA", "<br>TA", $technical_background);
				echo '<td style="font-size:18px;">' . $technical_background . '</td>';
				echo '<td style="text-align: center;">' . $number_category . '</td>';
				echo '<td>';
				

				//##8/10更新 改變方法
					//.records相對路徑
					if (is_dir($recordsFolderPath)) {
						//讀取學號儲存在directories
						$directories = scandir($recordsFolderPath);
						$recordsFolder = opendir($recordsFolderPath);
						foreach($directories as $directory){
							if ($directory !== '.' && $directory !== '..' && is_dir($recordsFolderPath . $directory)) {
								//得到data.txt路徑
								$Read_dataF = $recordsFolderPath . $directory . '/data.txt';
								//如果存在，讀取data.txt
								if (file_exists($Read_dataF)) {
									$dataFileContents = file_get_contents($Read_dataF);
									
									// 找到 "選取助教類型/課程代號：" 的位置
									$searchString = "選取助教類型/課程代號：";
									$position = strpos($dataFileContents, $searchString);
									//取得姓名
									$searchName = "姓名：";
									$position_N = strpos($dataFileContents, $searchName);
									
									if ($position !== false && $position_N !==false) {
										// 取得助教類型和課程代號之後的字串
										$substring = substr($dataFileContents, $position + strlen($searchString));
										// 移除字串中的換行符號和空白
										$substring = trim($substring);
										//將substring以"."字符分割資料，取得(助教類型 . googleLedrive列數)資料
										$splitdata = explode('.', $substring);
										
										//取得姓名
										$substring_N = substr($dataFileContents, $position_N + strlen($searchName));
										//找到換行位置
										$newlinePosition = strpos($substring_N, "\n");
										
										if ($newlinePosition !== false) {
											// 取得 "姓名：" 後方到換行符號前的字串
											$substring_N = substr($substring_N, 0, $newlinePosition);
										}
										// 移除字串中的換行符號和空白
										$substring_N = trim($substring_N);
										
										if (count($splitdata) >= 2){
											//確定有2筆資料
											$assistanceT = trim($splitdata[0]);//得到助教類型
											$googleLC = trim($splitdata[1]);//得到googleLedrive列數
											
											//配對到對應列數才輸出
											if ($googleLC == $counter){
												//取得學號路徑
												$recordFilePath = $recordsFolderPath . $directory ;
												$studentFolder = opendir($recordFilePath);
												
												//建立傳送檔案清單
												$fileList = array();
												while (($fileInStudentFolder = readdir($studentFolder)) !== false) {
													if (!in_array($fileInStudentFolder, array('.', '..'))) {
														$fileList[] = $fileInStudentFolder;
													}
												}
												closedir($studentFolder);
												sort($fileList);
								
												//顯示助教類型：姓名
												echo $assistanceT . "：" .$substring_N ."<br>";
												//將資料列出並建立清單
												echo "<ul>";
												foreach ($fileList as $fileItem) {
													//如果為data.txt檔案，另外處理
													if(!strcmp($fileItem , "data.txt")){
														echo "<li><a href='./dataRead_show.php?studentID=". $directory ."&fileItem=" .$fileItem. "' target='_blank'>". $fileItem ."</a></li>";
													}
													else{
														echo "<li><a href='" . $recordFilePath. "/" . $fileItem . "' target='_blank'>" . $fileItem . "</a></li>";
													}
												}
												echo "</ul>";
												echo "<hr>";
											}
										}
									}
								}
							}
						}
						closedir($recordsFolder);
					}
				echo '</td>';
				//##8/10更新 改變方法
				
				
				$course_population = str_replace("碩A", "碩A<br>", $course_population);
				$course_population = str_replace("碩B", "碩B<br>", $course_population);
				$course_population = str_replace("大四B", "大四B<br>", $course_population);
				echo '<td>' . $course_population . '</td>';
				$department_code = str_replace("/", "/<br>", $department_code);
				echo '<td>' . $department_code . '</td>';
				echo '</tr>';
				$counter++;
			}
		}
		echo '</table>';
	?>
</body>
</html>
