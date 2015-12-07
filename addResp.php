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

//add respondent to the database based on form's input
if(!($stmt = $mysqli->prepare("INSERT INTO respondent(email, gender, country, birth_date) VALUES (?,?,?,?)"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("ssss",$_POST['email'],$_POST['gender'],$_POST['country'] ,$_POST['birth']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	echo "Added " . $stmt->affected_rows . " rows to respondent.";
}
?>