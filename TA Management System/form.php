<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="utf-8" />
        <title>111學年度第二學期資工系、AI學程助教工作申請表</title>
		<style>
			em {color:purple}
			mark {color:red}
		</style>
		
			<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
			<script src="https://unpkg.com/g-sheets-api"></script>
		
    </head>
    <body>
	<header>
			<h1 style="text-align: center;"><i><em>111學年度第二學期資工系、AI學程助教工作申請表</em></i><h1>
	</header>
	
		<style>
			input[name="number"],
			input[name="name"],
			select[name="grade"],
			input[name="phone"],
			input[name="mail"],
			input[name="techer"]{
				font-size:18px;
				border: none; 
				border-bottom: 1px solid;}
			
		
			/* 添加表格格线样式 */
			table{
				border-collapse: collapse;
				width: 100%;
			}
		
			th,td{
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
		
		
		
		<!--將連結action.php檔 -->
		<form input type="text" id="formT" action="act.php" method="post" enctype="multipart/form-data">
			<h3>學號: <input type="text" name="number" pattern="[A-Z]\d{7}" maxlength="8" style="width:150px" required><h3>
			<h3>姓名: <input type="text" name="name" style="width:150px" required><h3>
			<h3>年級: <select name="grade" style="width:80px" required><h3>
				<option value="大四">大四</option>
				<option value="碩一">碩一</option>
				<option value="碩二">碩二</option>
				<option value="碩三">碩三</option>
				<option value="碩四">碩四</option>
				<option value="博一">博一</option>
				<option value="博二">博二</option>
				<option value="博三">博三</option>
				<option value="博四">博四</option>
				<option value="博五">博五</option>
				<option value="博六">博六</option>
				<option value="博七">博七</option>
				<option value="博八">博八</option>
				<option value="博九">博九</option>
			</select>
			<h3>手機: <input type="text" name="phone" required><h3>
			<h3>E-mail: <input type="email" name="mail" style="width:200px" required><h3>
			<h3>指導教授/導師: <input type="text" name="techer" style="width:140px" required><h3><br>
			<script>
				
				$(document).ready(function() {
					$("#formT").submit(function(event) {
						//學號未寫
						if ($("#number").val() === "") {
							alert("你尚未填寫學號");
							$("#number").addClass("red-border");
							$("#number").focus();
							event.preventDefault();
						}
						else {
							$("#number").removeClass("red-border");
						}
						
						//姓名未寫
						if ($("#name").val() === "") {
							alert("你尚未填寫姓名");
							$("#name").addClass("red-border");
							$("#name").focus();
							event.preventDefault();
						}
						else {
							$("#name").removeClass("red-border");
						}
						
						//年級未寫
						if ($("#grade").val() === "") {
							alert("你尚未填寫年級");
							$("#grade").addClass("red-border");
							$("#grade").focus();
							event.preventDefault();
						}
						else {
							$("#grade").removeClass("red-border");
						}
						
						//E-mail未寫
						if ($("#mail").val() === "") {
							alert("你尚未填寫E-mail");
							$("#mail").addClass("red-border");
							$("#mail").focus();
							event.preventDefault();
						}
						else {
							$("#mail").removeClass("red-border");
						}
						
						//手機沒寫
						if ($("#phone").val() === "") {
							alert("你尚未填寫手機");
							$("#phone").addClass("red-border");
							$("#phone").focus();
							event.preventDefault();
						}
						else {
							$("#phone").removeClass("red-border");
						}
						
						//教授沒寫
						if ($("#techer").val() === "") {
							alert("你尚未填寫指導教授");
							$("#techer").addClass("red-border");
							$("#techer").focus();
							event.preventDefault();
						}
						else {
							$("#techer").removeClass("red-border");
						}
					});
					
					
			</script>
			
			
			<hr>
			
			<!--  ***連結google sheet*** -->
			<h2>申請之助教工作<h2>
			
			<!-- 表格元素來容納資料 -->
				<table id="data-table">
				<tr>
					<th style="width:80px; text-align: center;"><h3>請勾選<br> (若已有人申請則不能勾)</h3></th>
					<th style="width:400px; text-align: center; font-size: 20px;">課程/助教具備的技術背景或先修課程要求欄位留空</h3></th>
					<th style="width:50px; text-align: center;"><h3>統計至1/16 之修課人數</h3></th>
					<th style="width:50px; text-align: center;"><h3>工作督導教師</h3></th>
					<th style="width:50px; text-align: center;"><h3>人數/類別</h3></th>
					<th style="width:30px; text-align: center;"><h3>系所 /<br>用人單位代號</h3></th>
				</tr>
					
					
			<?php
				// 使用Google Sheets API獲取資料
				function getDataFromGoogleSheets() {
					
					// 設定API金鑰的路徑和範圍
					$url = "https://googlesheetAPI KEY";
					
					// 初始化 cURL 會話
					$ch = curl_init($url);
					// 設定選項
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					// 執行 cURL 請求
					$response = curl_exec($ch);
					// 關閉 cURL 會話
					curl_close($ch);
					// 解析 JSON 資料
					$data = json_decode($response, true);
					$values = $data['values'];

					
					// 抓取第 A 欄的資料 -課程名稱
					$columnA = array_column($values, 0); // 第 A 欄的索引為 0
					
					// 抓取第 B 欄的資料 -課程名稱
					$columnB = array_column($values, 1); // 第 B 欄的索引為 1
					
					//抓取第 C 欄的資料 -統計至1/16 之修課人數
					$columnC = array_column($values, 2); // 第 C 欄的索引為 2
					
					//抓取第 D 欄的資料 -授課老師
					$columnD = array_column($values, 3); // 第 D 欄的索引為 3
					
					// 抓取第 E 欄的資料 -TA要求
					$columnE = array_column($values, 4); // 第 E 欄的索引為 4
					
					// 抓取第 F 欄的資料 -TA要求
					$columnF = array_column($values, 5); // 第 F 欄的索引為 5
					
					// 抓取第 G 欄的資料 -TA要求
					$columnG = array_column($values, 6); // 第 F 欄的索引為 6
					
					
					//##8/9更新 生成records資料夾##
					$recordsFolderPath = 'records/';
					if (!file_exists($recordsFolderPath)) {
						mkdir($recordsFolderPath);
					}
					//##8/9更新 生成records資料夾##
					
					
					if (!empty($values)) {
						$rowCounter = 0;
						$radio_group = "radio_group"; // 聲明 $radio_group 變量
						foreach ($values as $row) {
							if ($rowCounter > 2) {
								if (!empty($row[0]) || !empty($row[1]) || !empty($row[2]) || !empty($row[3]) || !empty($row[4]) || !empty($row[5])) {
									echo "<tr>";
									
									//勾選欄
									echo "<td>";
									
									$data = $row[5];
									// 以A、B區分每筆資料
									// 以正則表達式匹配數量和文字
									preg_match_all('/(\d+ \D+)\/(\D+)/', $data, $matches, PREG_SET_ORDER);
									
									
									//##8/10更新 加入讀取指定列的方法，取得 助教類型+googleLedrive列數
									// 處理每筆資料
									foreach ($matches as $match) {
										$quantity = intval($match[1]); //人
										$text = $match[2]; //字
										
										//##8/12更新 發現第一列"碩B.3"字自動換行，對此除錯
										$text = preg_replace('/\s+/', '', $text);
										
										
										//濾遍所有內部資料夾判定data.txt檔案讀取
										$directories = scandir($recordsFolderPath);
										foreach($directories as $directory){
											//讀取學號Number資料夾
											if ($directory !== '.' && $directory !== '..' && is_dir($recordsFolderPath . $directory)) {
												$Read_dataF = $recordsFolderPath . $directory . '/data.txt';
												
												if (file_exists($Read_dataF)) {
													//如果存在，讀取data.txt
													$dataFileContents = file_get_contents($Read_dataF);
											
													//##8/10更新 加入讀取指定列的方法，取得 助教類型+googleLedrive列數
													// 找到 "選取助教類型/課程代號：" 的位置
													$searchString = "選取助教類型/課程代號：";
													$position = strpos($dataFileContents, $searchString);
													
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
															
															if ($googleLC == $rowCounter && $assistanceT == $text){
																//如果對應到相同列以及相同勾選文字，以文字顯示代表有人申請
																echo $assistanceT . ":" . $substring_N . "<br>";
																$quantity--;//有人申請，扣除人數1人
																
															}
														}
													}
												}
											}
										}
										//印出 radio 輸入
										for ($i = 0; $i < $quantity; $i++) {
											echo "<label><input type='radio' name='radio_group' value='" . $text . $rowCounter . "'" . (isset($_SESSION['radio_group']) && $_SESSION['radio_group'] === $text ? 'checked' : '') . (isset($_SESSION['form_submitted']) ? 'disabled' : '') . ">$text<span></span></label><br>";
										}
									}
									//##8/10更新 加入讀取指定列的方法，取得 助教類型+googleLedrive列數
									echo "</td>";
									
										
									
									//課程/TA
									if (!empty($row[4])) {
										echo "<td>" . $row[1] . "<br> TA:" . $row[4] . "</td>";
									} 
									else {
										echo "<td>" . $row[1] . "<br> TA: 無 </td>";
									}
									
									// 統計至1/16之修課人數欄位留空
									echo '<td style="text-align: center;">'. ($row[2] !== '' ? $row[2] : '0') . '</td>'; 
									
									// 工作督導教師欄位留空
									echo '<td style="text-align: center;">'. ($row[3] !== '' ? $row[3] : '無指導老師') . '</td>'; 

									// 人數/類別欄位留空
									if (!empty($row[5])) {
										echo '<td>'. str_replace(['A', 'B'], ['A<br>', 'B<br>'], $row[5]) . '</td>';
									} 
									else {
										echo '<td>不須人手</td>';
									}
									
									//##8/9更新 用人單位資料爬取##
									// 用人單位代號欄位
									echo '<td>' . ($row[0] !== '' ? $row[0] : '查無系所!!') . "/<br>" . ($row[6] !== '' ? $row[6] : '查無單位號!!') . '</td>'; 
									//##8/9更新 用人單位資料爬取##
									echo "</tr>";
									//echo $rowCounter;
								}
								
								//##更新8/13 直接扣除遇到的空列數(避免formACT抓資料後輸出錯誤)
								else{
									$rowCounter--;
								}
							}
							$rowCounter++;
						}
						
					}
					else {
						echo "<tr><td colspan='2'>No data found.</td></tr>";
					}
				}
				// 網頁載入後執行
				getDataFromGoogleSheets();
			
			?>

			</table>
			
			<hr>
		
			<h2>上傳檔案<h2>
			<h3>
				申請表格 (僅限PDF格式)
					<input type="file" id="pdfInput" name="pdf" accept="application/pdf" style="display: block; margin-bottom: 5px;">
				<br>
				附件 （可多檔案上傳）
					<input type="file" name="myFile[]" style="display: block;margin-bottom: 5px;">
					<input type="file" name="myFile[]" style="display: block;margin-bottom: 5px;">
					<input type="file" name="myFile[]" style="display: block;margin-bottom: 5px;">
					<input type="file" name="myFile[]" style="display: block;margin-bottom: 5px;">
			<hr>
			

				<div style= "width: 100%; text-align: center;">
					<input type="submit" style="font-size:20px; height: 2em; width: 5em;" value="送出">
				</div>
				
		</form>


		
		<script>
		//##8/13更新 判定是否有沒勾選申請類型
        $(document).ready(function () {
            $("#formT").submit(function (event) {
                if (!$("input[name='radio_group']").is(":checked")) {
                    alert("請勾選助教類型");
                    event.preventDefault();
                }
            });
        });
		</script>
		
	</body>

</html>
