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
        <!--Form for adding a survey to the database-->
        <form action="addSurvey.php" method="post">
            <fieldset>
                <legend>Create a new survey</legend>
                <label>Survey Name:
                    <input type="text" name="name" placeholder="name">
                </label>
                <br><br>
                <label>Description:
                    <input type="text" name="description" placeholder="description">
                </label>
                <br><br>
                <label>Date of creation:
                    <input type="date" name="date" placeholder="YYYY-MM-DD">
                </label>
                <br><br>
                <input type="submit" value="Submit">
            </fieldset>
        </form>
        <!--Form for adding entries to survey_question table-->
        <form action="addSQ.php" method="post">
            <fieldset>
                <legend>Add a new question to survey</legend>
                <label>Choose the name of survey:
                     <select id = "survey" name = "survey"> 
<!--Display options for choosing survey from the database-->
<?php
if(!($stmt = $mysqli->prepare("SELECT survey_id, name FROM survey"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($survey_id, $name)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $survey_id . ' "> ' . $name . '</option>\n';
}
$stmt->close();
?>
                    </select> 
                </label>
                <br><br>
                <label>Choose the question's content:
                    <select id = "question" name = "question"> 
<!--Display options for choosing question from the database-->
<?php
if(!($stmt = $mysqli->prepare("SELECT question_id, content FROM question"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($question_id, $content)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $question_id . ' "> ' . $content . '</option>\n';
}
$stmt->close();
?>
                    </select> 
                </label>
                <br><br>
                <input type="submit" value="Submit">
            </fieldset>
        </form>
        <!--Form for adding new questions to the database-->
        <form action="addQuestion.php" method="post">
            <fieldset>
                <legend>If you cannot find the right question you can create it</legend>
                <label>Content:
                    <input type="text" name="name" placeholder="content">
                </label>
                <br><br>
                <input type="submit" value="Submit">
            </fieldset>
        </form>
    </body>
</html>
