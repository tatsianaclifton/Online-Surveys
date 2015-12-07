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
        <h2>We have the following otions availiable:</h2>
        <div>
            <h3>See all questions from a certain survey.</h3>
            <form action = "select1.php" method = "post">
                <label>Survey name:
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
                <input type="submit" value="submit">
            </form>
        </div><br>
        <div>
            <h3>Display name and description of surveys along with how many respondents have participated in it. It counts respondents older than desired age.</h3>
            <form action = "select2.php" method = "post">
                <label>Older than:
                    <input type="number" name="age1">
                </label>
                <label>Younger than:
                    <input type="number" name="age2">
                </label>
                <input type="submit" value="submit">
            </form>
        </div><br>            
        <div>
            <h3>Show how many respondents participated in each survey</h3>
            <form action = "select5.php" method = "post">
                <input type="submit" value="submit">
            </form>
        </div><br>
        <div>
            <h3>Show a survey's name, description and number of respondents for the survey that has the biggest number of respondents</h3>
            <form action = "select4.php" method = "post">
                <input type="submit" value="submit">
            </form>
        </div>
    </body>
</html>