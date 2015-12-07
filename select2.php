<!--CS340 Final project
    Tatsiana Clifton-->

<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","cliftota-db","vVw09uuIsAt8l75I","cliftota-db");
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
        <p>Below is information about this survey:</p>
        <table>
<?php
//select name and description of surveys along with how many respondents have participated in it
//it counts respondents in the desired age range
if(!($stmt = $mysqli->prepare("SELECT s.name, s.description, COUNT(temp.age) FROM survey s 
         LEFT JOIN (SELECT r.respondent_id, TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) AS age, sr.survey_id FROM respondent r
         INNER JOIN survey_respondent sr ON sr.respondent_id = r.respondent_id) AS temp 
         ON temp.survey_id = s.survey_id WHERE temp.age >= ? AND temp.age <= ?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("ii", $_POST['age1'], $_POST['age2']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
        echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($survey_name, $survey_description, $number_of_respondents)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\nName\n</td>\n<td>\nDescription\n</td>\n<td>\nNumber_of_respondents \n</td>\n</tr><tr>\n<td>\n" . $survey_name . "\n</td>\n<td>\n" . $survey_description . "\n</td>\n<td>\n" . $number_of_respondents . "\n</td>\n</tr>";
}
$stmt->close();
?>
        </table>
 </body>
</html>