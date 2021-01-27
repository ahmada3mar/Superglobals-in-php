<?php 
include "data.php";
session_start();
// ==================
if (!isset($_SESSION["questionsID"])) {
    header("Location:index.php");
}
// ==================

if (isset($_GET["id"])) {
    $_SESSION["currentQuestion"]=$_GET["id"];
    $pevAnswerID=$_SESSION["allAnswers"][$_GET["id"]]["answerID"];
}
// ==================
$maxTime =20;
// ================
$questionsID=$_SESSION["questionsID"];
$question=$data[$questionsID[$_SESSION["currentQuestion"]]];
if (isset($_SESSION["setTime"])) {
    $_SESSION['time']=time()*1000 + 1000 * 60 * $maxTime;
    $_SESSION["forTotalTime"]=time();
    unset($_SESSION["setTime"]);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/question.css">
</head>

<body>
    <div class="questionPage">
        <div class="question">
            <div class="heder">
                <?php echo "<p>Total Question - ".count($questionsID)."</p>";?>
                <p id="timer">#h #m #s</p>
                <?php echo "<p>Max Time - $maxTime Min</p>";?>
            </div>
            <form class="body" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <?php 
                echo "<p><b>Q - {$question['question']}</b></p>";
                if (isset($pevAnswerID)) {
                    foreach($question['answers'] as $k=> $answer){
                        if ($pevAnswerID == $k) {
                            echo '<input type="radio" id="'.$k.'" checked="checked" name="answer" value="'.$k.'"><label for="'.$k.'">'.$answer['answer'].'</label><br>';
                        }
                        else{
                            echo '<input type="radio" id="'.$k.'" name="answer" value="'.$k.'"><label for="'.$k.'">'.$answer['answer'].'</label><br>';
                        }
                        
                    }
                    
                }
                else{
                    foreach($question['answers'] as $k=> $answer){
                        echo '<input type="radio" id="'.$k.'" name="answer" value="'.$k.'"><label for="'.$k.'">'.$answer['answer'].'</label><br>';
                    }

                }
                if ($_SESSION["currentQuestion"]==count($questionsID)-1) {
                    echo '<input type="submit" value="Finish">';
                }else{
                    echo '<input type="submit" value="Next Question">';
                }
                ?>

            </form>
            <?php
            function setAnswers($isTrue,$answerID){
                    $_SESSION["allAnswers"][$_SESSION["currentQuestion"]]["isTrue"]=$isTrue;
                    $_SESSION["allAnswers"][$_SESSION["currentQuestion"]]["answerID"]=$answerID;
            }
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $answerID = $_POST['answer'];
                    if (isset($question['answers'][$answerID]['isTrue'])) setAnswers(true,$answerID);
                    else setAnswers(false,$answerID);
                    if ($_SESSION["currentQuestion"]==count($questionsID)-1) {
                        $_SESSION["doneTime"]=time();
                        header("Location:done.php");
                    }
                    else{
                        $_SESSION["currentQuestion"]++;
                        header("Location:question.php");
                    }
                }
            ?>
        </div>
        <div class="qNumCon">
            <?php 
            $i=1;
            while ($i <= count($questionsID)){
                $id=$i-1;
                if ($id == $_SESSION["currentQuestion"]) echo "<p class='current'>{$i}</p>";
                else if(!isset($_SESSION["allAnswers"][$id]))echo "<p>{$i}</p>";
                else echo "<a href='question.php?id=$id'><p>$i</p></a>";
                $i++;
            }
            ?>

        </div>
    </div>

    <!-- ======================== -->
    <?php 
    echo '
    <script>
            var countDownDate = '.$_SESSION['time'].';
    console.log(countDownDate)
    console.log(new Date().getTime())
            var x = setInterval(function() {
                var now = new Date().getTime();
                var distance = countDownDate - now;
    
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
                document.getElementById("timer").innerHTML = hours + "h " +
                    minutes + "m " + seconds + "s ";
    
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("timer").innerHTML = "EXPIRED";
                }
            }, 1000);
            </script>
    ';
    ?>
</body>

</html>