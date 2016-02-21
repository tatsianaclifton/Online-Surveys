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

//update the question content
if(!($stmt = $mysqli->prepare("UPDATE question SET content = ?
WHERE question_id = ?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("si",$_POST['content'],$_POST['question']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} 
else{
	echo "Updated " . $stmt->affected_rows . " rows in question.";
}
?>
