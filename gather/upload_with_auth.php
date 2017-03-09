<?php
session_cache_limiter('private, must-revalidate');
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
</head>
<body>

	<?php




	if (isset($_GET['logout'])) {
		if ($_GET['logout'] == '1') {
			$_SESSION = array();
			session_destroy();
		}
	}

	if (isset($_POST['foo'])) {
		if ($_POST['foo'] == '11') {
			$_SESSION['is_in'] = 'yes';
			list_files();
			die();
		}
	}
	else if(isset($_SESSION['is_in'])){
		if ($_SESSION['is_in'] == 'yes') {
			list_files();
			die();
		}
	}
	

	?>


	<form action="./" method="post">
		<input type="text" name="foo" required>
		<input type="submit" value=" ">
	</form>

</body>
</html>

<?php





function list_files(){
	if (isset($_FILES['file'])) {
		save_file();
	}

	echo 'U R in. &nbsp; <a href="index.php?logout=1">Logout</a> <a href="./">Refresh</a> <br> ';
	echo '<hr>'; 
	echo_upload();
	echo '<hr>';
	$filesnames = scandir(dirname(__FILE__));

	foreach ($filesnames as $name) {

		$url= '<a href="'.$name.'" download="'.$name.'">Download</a> <a href="'.$name.'">'.$name.'</a>';

		echo $url . "<br/>";

	}

}

function echo_upload(){
	echo '<form action="./" method="post"
	enctype="multipart/form-data">
	<label for="file">Filename:</label>
	<input type="file" name="file" id="file" style="width:400;height:100px;background:#888;"/> 
	<br />
	<input type="submit" name="submit" value="Submit" />
</form>';
}

function save_file(){

// 	if ((($_FILES["file"]["type"] == "image/gif")
// || ($_FILES["file"]["type"] == "image/jpeg")
// || ($_FILES["file"]["type"] == "image/pjpeg"))
// && ($_FILES["file"]["size"] < 20000))
	if(1)
	{
		if ($_FILES["file"]["error"] > 0)
		{
			echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
		}
		else
		{
			echo "Upload: " . $_FILES["file"]["name"] . "<br />";
			echo "Type: " . $_FILES["file"]["type"] . "<br />";
			echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
			echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";


			if(file_exists($_FILES["file"]["name"])) {
				$temp_name = $_FILES["file"]["name"] . '_r1';
				$file_mame = check_name($temp_name);
			}else{
				$file_mame = $_FILES["file"]["name"];
			}

			move_uploaded_file($_FILES["file"]["tmp_name"],
				"./" . $file_mame);
			echo "Stored in: " . "./" . $file_mame."<hr>";

		}
	}
	else
	{
		echo "Invalid file";
	}

}

function check_name($name){

	if(file_exists($name)) {
		$matches = array();
		if (preg_match('/_r(\d+)$/', $name,$matches)) {
			$array_split = preg_split('/_r(\d+)$/', $name);

			$num= $matches[1] + 1;
			echo $num;

			$new_name = $array_split[0].'_r' . $num;
		}else{
			echo '!!!match exists file ending FALSE!!!<br>';
		}

		$name = check_name($new_name);
	}
	return $name;
}

