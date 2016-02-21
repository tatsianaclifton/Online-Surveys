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
        <h3>Delete Survey</h3>
        <form action="delete.php" method="post">
            <fieldset>
                <label>Choose a survey that you want to delete:
                     <select name = "Survey"> 
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
                <input type="submit" value="Submit"> 
            </fieldset>
        </form><br><br>
        <h3>Edit Question</h3>
        <form action="edit.php" method="post">
            <fieldset>
                <label>Choose the question's content that you wand to edit:
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
                </label><br>
                <label>Enter new content for this question:
                    <input type="text" name="content" placeholder="new content">
                </label>
                <br><br>
                <input type="submit" value="Submit"> 
            </fieldset>
        </form>
    </body>
</html>
