<?php
/*$servername = "localhost";
$username = "root";
$dbname = "database_hint";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully"; 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }*/
	$HOST_NAME = "localhost";
	$DB_NAME = "database_hint";
	$CHAR_SET = "charset=utf8"; // เช็ตให้อ่านภาษาไทยได้
	$USERNAME = "root";     // ตั้งค่าตามการใช้งานจริง
	try {
		$db = new PDO('mysql:host='.$HOST_NAME.';dbname='.$DB_NAME.';'.$CHAR_SET,$USERNAME);
		//echo "เชื่อมต่อฐานข้อมูลสำเร็จ";
		/*$sql = "SELECT *FROM profile";
		$query = $db->query($sql);
		print_r($query->fetchAll());*/
	} catch (PDOException $e) {
		echo "ไม่สามารถเชื่อมต่อฐานข้อมูลได้ : ".$e->getMessage();
	}
 if(isset($_GET['state'])&&$_GET['state']=='add') {
 	$query="INSERT INTO Profile (Name,Lastname,Nickname,Birthday) VALUES (:name,:lastname,:nickname,:birthday)";
 			$ps = $db->prepare($query);
 			$ps->execute(['name'=>$_POST['name'],'lastname'=>$_POST['lastname'],'nickname'=>$_POST['nickname'],'birthday'=>$_POST['birthday']]);
	$query2="SELECT* FROM profile";
			$ps2 = $db->prepare($query2);
			$ps2->execute();
			$data=$ps2->fetchAll(PDO::FETCH_ASSOC);
if (isset($_GET['state'])&&$_GET['state']=='delete') {
	$query3="DELETE FROM profile WHERE ID=48";
	$ps3->execute();
	$data2=$ps3->fetchAll(PDO::FETCH_ASSOC);
}
 }
?>
<!DOCTYPE html>
<html>
<head>
	<title>PROFILE USERS</title>
	<style type="text/css">
		input {width: 200px;}
		.table1{width: 200px;}
	</style>
</head>
<body>
	<div>
 		<center>REPORT</center>
 	Select: <select>
 		<option value="id">ID</option>
 		<option value="name">Name</option>
 		<option value="lastname">Lastname</option>
 		<option value="nickname">Nickname</option>
 		<option value="birthday">Birthday</option>
 	</select>
 	<button>Seach</button>
 	<button>ADD</button>
 </div>
 <form action="connectDB.php?state=add" method="post"> 
  	<div class="table1">
 	<table border="1" name="result">
 		<tr>
 			<td>Id</td><td>Name</td><td>Lastname</td><td>Nickname</td><td>Birthday</td><td colspan="2">Action</td>
 		</tr>
 			<?php
 				for ($i=0;isset($data[$i]); $i++) { 
 					echo '<tr><td>'.$data[$i]['ID'].'</td><td>'.$data[$i]['Name'].'</td><td>'.$data[$i]['Lastname'].'</td><td>'.$data[$i]['Nickname'].'</td><td>'.$data[$i]['Birthday'].'</td><td><button>Edit</button></td><td><button>Delete</button></td><tr>';
 				}
 			?>
 		
 	</table><hr style="width: 1000px">
 </div>
 <table border="1">
 		<tr>
 			<td>Name: </td>
 			<td><input type="text" name="name" /></td>
 		</tr>
 		<tr>
 			<td>Lastname: </td>
 			<td><input type="text" name="lastname" /></td>
 		</tr>
 		<tr>
 			<td>Nickname: </td>
 			<td><input type="text" name="nickname" /></td>
 		</tr>
 		<tr>
 			<td>Birthday: </td>
 			<td><input type="date" name="birthday" /></td>
 		</tr>
 	</table>
 	<button>Save</button>
<form action="connectDB.php?state=delete" method="post">
	
</form>
	
</form>
</body>
</html>

