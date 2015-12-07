<!--CS340 Final project
    Tatsiana Clifton-->

<a class = "button" href = "main.php">Home</a><br><br><br>
<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","cliftota-db","vVw09uuIsAt8l75I","cliftota-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

//add answer to the database based on form's input
if(!($stmt = $mysqli->prepare("INSERT INTO `answer` (respondent_id, question_id, answer_content) 
VALUES (?, ?, ?)"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("iii",$_POST['respondent_id'],$_POST['question_id'],$_POST['answer']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
}
else{
	echo "Added " . $stmt->affected_rows . " rows to answer. Use your browser back button to answer other questions.";
}
?>