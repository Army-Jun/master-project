<?php
	$recordsFolderPath = './records';
	$datatxtPath = $recordsFolderPath . "/" . $_GET['studentID'] . "/" . $_GET['fileItem'];
	echo "<object data = '" . $datatxtPath . "'>Not supported </object>";
?>