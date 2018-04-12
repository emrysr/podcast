<?php
ini_set('error_reporting', E_ALL);
define('DEBUG',1);

include ('db.php');
/*
if(isset($_POST['data'])){
//	$post = addslashes($_POST['data']);
	mysqli_query($db,"insert into newsletter (email, firstname, surname, datesignup) values ('$post', NOW())") or die(mysqli_error());
}
*/
function AddToNewsletter($email,$firstname,$surname){
	try {
		$ticktoc = date('Y-m-d H:i:s');

		$sql = "INSERT INTO newsletter (email, firstname, surname, datesignup) VALUES (:email,:firstname,:surname,:ticktoc)";
		$statement = $db->prepare($sql);
			
		$statement->bindValue(":email", $email, PDO::PARAM_STR);
		$statement->bindValue(":firstname", $firstname, PDO::PARAM_STR);
		$statement->bindValue(":surname", $surname, PDO::PARAM_STR);
		
		//If SQL Fails throw Exception
		$success = $statement->execute();

		if(!$success){
			throw new Exception('AddToNewsletter Statement Error');
		}
			
		if(DEBUG)  $response['sql'] = $statement->debugDumpParams();
		$response['success']=true;
	}
	catch(PDOException $e) {
		if(DEBUG)  $response['error'] = $e->getMessage();
		$response['success'] = false;
	}
	//Return Array of values
	return $response;
}
?>