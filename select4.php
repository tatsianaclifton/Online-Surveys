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
//choose the survey that has the biggest number of respondents
if(!($stmt = $mysqli->prepare("SELECT temp.name AS survey_name, temp.description AS survey_description, temp.respondents AS number_of_respondents
FROM
    (SELECT s.name AS name, s.description AS description, COUNT(sr.respondent_id) AS respondents FROM survey s
     RIGHT JOIN survey_respondent sr ON sr.survey_id = s.survey_id
     GROUP BY s.name) AS temp
WHERE temp.respondents = (SELECT MAX(DISTINCT temp2.respondents)
    FROM     
    (SELECT s.name AS name, s.description AS description, COUNT(sr.respondent_id) AS respondents FROM survey s
    RIGHT JOIN survey_respondent sr ON sr.survey_id = s.survey_id
    GROUP BY s.name) AS temp2)"))){
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
