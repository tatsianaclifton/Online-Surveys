<!--CS340 Final project
    Tatsiana Clifton-->

<a class = "button" href = "main.php">Home</a><br><br><br>
<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli();//credentials need to be added
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

//add survey to the database based on form's input
if(!($stmt = $mysqli->prepare("INSERT INTO survey(name, description, opening_time) VALUES (?,?,?)"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("sss",$_POST['name'],$_POST['description'],$_POST['date']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	echo "Added " . $stmt->affected_rows . " rows to survey.";
}
?>
