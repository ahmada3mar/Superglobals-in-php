<?php 
session_start();
include "data.php";
function UniqueRandomNumbersWithinRange($min, $max, $quantity) {
    $numbers = range($min, $max);
    shuffle($numbers);
    return array_slice($numbers, 0, $quantity);
}
$IDArr = UniqueRandomNumbersWithinRange(0,count($data)-1,6);
$_SESSION["questionsID"]=$IDArr;
$_SESSION["currentQuestion"]=0;
$_SESSION["setTime"]=true;
// ---------------
unset($_SESSION["allAnswers"]);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Quiz</h1>
    <a href="question.php">
        <h3>Start</h3>
    </a>
</body>

</html>