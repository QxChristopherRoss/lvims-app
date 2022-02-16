<html>
<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bwire Jobs - View Certificate</title>
<link rel="shortcut icon" href="../images/ico/logo.png">
<link href="../css/main.css" rel="stylesheet">
</head>

<body>
<?php
require 'constants/check-login.php';
require '../constants/db_config.php';
$file_id = $_GET['id'];

if ($user_online == "true") {
if ($myrole == "employee") {
}else{
header("location:../");		
}
}else{
header("location:../");	
}



try {
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	
$stmt = $conn->prepare("SELECT * FROM tbl_training WHERE id = :fileid AND member_no = '$myid'");
$stmt->bindParam(':fileid', $file_id);
$stmt->execute();
$result = $stmt->fetchAll();

foreach($result as $row)
{
    $certificate = $row['certificate'];
	$course = $row['training'];
	
	?>
<iframe  style="border:none;" src="../ViewerJS/?title=<?php echo "$course"; ?>#<?php echo 'data:application/pdf;base64,'.base64_encode($certificate).'' ?>" height="100%" width="100%"></iframe>

<?php
}

					  
}catch(PDOException $e)
{

}

?>

</body>

</html>

