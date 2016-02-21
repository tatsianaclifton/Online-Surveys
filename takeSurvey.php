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
        <!--Form for adding a new respondent to the database-->
        <form action="addResp.php" method="post">
            <fieldset>
                <legend>Create a new respondent</legend>
                <label>Email:
                    <input type="text" name="email" placeholder="email">
                </label>
                <br><br>
                <label>Gender:
                    <input type="text" name="gender" placeholder="gender">
                </label>
                <br><br>
                <label>Country:
                    <input type="text" name="country" placeholder="country">
                </label>
                <br><br>
                <label>Date of birth:
                    <input type="date" name="birth" placeholder="YYYY-MM-DD">
                </label>
                <br><br>
                <input type="submit" value="Submit">
            </fieldset>
        </form>
        <!--Form to start answering a survey-->
        <form action="addSR.php" method="post">
            <fieldset>
                <legend>Take a survey</legend>
                <label>Choose a survey's name:
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
                <label>Choose your email:
                    <select name = "Email"> 
<!--Display options for choosing email from the database-->
<?php
if(!($stmt = $mysqli->prepare("SELECT respondent_id, email FROM respondent"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($respondent_id, $email)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $respondent_id . ' "> ' . $email . '</option>\n';
}
$stmt->close();
?>
                    </select> 
                </label>
                <br><br>
                <label>Date of completion:
                    <input type="date" name="completed" placeholder="YYYY-MM-DD">
                </label>
                <br><br>
                <input type="submit" value="Submit"> 
            </fieldset>
        </form>
    </body>
</html>
