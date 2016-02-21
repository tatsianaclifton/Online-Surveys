<!--CS340 Final project
    Tatsiana Clifton-->

<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli(); //credentials need to be added
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
?>


<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset="utf-8">
        <title>Online Surveys</title>
        <link rel="stylesheet" href="style.css" type="text/css">
    </head>
    <body>
        <a class = "button" href = "main.php">Home</a><br><br><br>
        <p>This survey includes the following questions:</p>
        <table>
<?php
//select all questions from a certain survey
if(!($stmt = $mysqli->prepare("SELECT question.content FROM question
     INNER JOIN survey_question ON survey_question.question_id = question.question_id
     INNER JOIN survey ON survey.survey_id = survey_question.survey_id
     WHERE survey.survey_id = ? ORDER BY question.content DESC"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("i", $_POST['survey']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
        echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
    }
if(!$stmt->bind_result($question_content)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $question_content  . "\n</td>\n</tr>";
}
$stmt->close();
?>
        </table>
 </body>
</html>
