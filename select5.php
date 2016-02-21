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
        <p>This survey with the biggest number of respondents:</p>
        <table>
<?php
//select how many respondents participated in each survey
if(!($stmt = $mysqli->prepare("SELECT survey.name, survey.description, COUNT(survey_respondent.respondent_id) AS respondents FROM survey
RIGHT JOIN survey_respondent ON survey_respondent.survey_id = survey.survey_id 
GROUP BY survey.name"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
        echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
    }
if(!$stmt->bind_result($survey_name, $survey_description, $number_of_respondents)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $survey_name . "\n</td>\n<td>\n" . $survey_description . "\n</td>\n<td>\n" . $number_of_respondents . "\n</td>\n</tr>";
}
$stmt->close();
?>
        </table>
 </body>
</html>
