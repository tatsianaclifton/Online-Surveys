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
        <h1>Welcome to Online Surveys! What would you like to do?</h1>
        <div class = "center">
            <a class = "button" href = "newSurvey.php">Create New Survey</a>
            <br><br><br><br>
            <a class = "button" href = "takeSurvey.php">Take Survey</a>
            <br><br><br><br>
            <a class = "button" href = "gatheredData.php">Browser Gathered Data and Existing Surveys</a>
            <br><br><br><br>
            <a class = "button" href = "editDelete.php">Edit or Delete Data</a>
        </div>
    </body>
</html>