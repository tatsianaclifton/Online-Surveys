<!--CS340 Final project
    Tatsiana Clifton-->

<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli();//credentials need to be added
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
        <h2>Please answer the questions</h2>
        <p>For each statement, enter a number from 1 to 10, where 10 is the highest level of agreement with the statement.</p>
<?php
//add survey_respondent to the database based on form's input
if(!($stmt = $mysqli->prepare("INSERT INTO survey_respondent(survey_id, respondent_id, completed) VALUES (?, ?, ?)"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("iis",$_POST['Survey'],$_POST['Email'],$_POST['completed']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
    if(!($stmt = $mysqli->prepare("SELECT question.content, question.question_id FROM question
INNER JOIN survey_question ON survey_question.question_id = question.question_id
INNER JOIN survey ON survey.survey_id = survey_question.survey_id
WHERE survey.survey_id = ?"))){
    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
    }
    if(!($stmt->bind_param("i",$_POST['Survey']))){
        echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
    }
    if(!$stmt->execute()){
        echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
    }
    if(!$stmt->bind_result($question_content, $question_id)){
        echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
    }
    while($stmt->fetch()){
        echo 
           '<h3>' . $question_content  . '</h3>
           <form action="addAns.php" method="post">
                <input type="number" name="answer" placeholder="answer">
                <input type="submit" value="submit" name="submit">
                <input type="hidden" value=' . $question_id. ' name="question_id">
                <input type="hidden" value='. $_POST['Email']. ' name="respondent_id">
                <input type="hidden" value="1" name="submitted">
            </form>';
    }
    $stmt->close();
}
?>
    </body>
</html>
