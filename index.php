<!DOCTYPE html>
<html>
    <body>
    <!-- ----------------------------------------------Task 1------------------------------------------------- -->
<form method="get" action="action.php" target="_blank">
  Email: <input type="text" name="email">
  Password: <input type="password" name="password">
  <input type="submit">
</form>
<!-- ----------------------------------------------Task 2------------------------------------------------- -->
<form method="post" action="">
  Website: <input type="url" name="URL" placeholder="https://example.com" pattern="https://.*">
  <input type="submit" value="Go">
</form>
<?php
if (isset($_POST['URL'])) {
  $url = $_POST['URL'];
  header("Location:$url");
}
?>
<!-- ----------------------------------------------Task 3------------------------------------------------- -->
<?php
$result = '';
if (isset($_POST['result'])) {
    $first_num = $_POST['first_num'];
$second_num = $_POST['second_num'];
$operator = $_POST['operator'];
    switch ($operator) {
        case "+":
           $result = $first_num + $second_num;
            break;
        case "-":
           $result = $first_num - $second_num;
            break;
        case "*":
            $result = $first_num * $second_num;
            break;
        case "/":
            $result = $first_num / $second_num;
    }}
?>
            <form action="" method="post" id="quiz-form">
                <br>
                <input type="number" name="first_num" id="first_num" required="required" value="<?php echo $first_num; ?>" />
                <input type="number" name="second_num" id="second_num" required="required" value="<?php echo $second_num; ?>" />
                <br>
               <b>Result</b> <input readonly="readonly" name="result" value="<?php echo $result; ?>">
               <br>
            <input type="submit" name="operator" value="+" required/>
            <input type="submit" name="operator" value="-" required />
            <input type="submit" name="operator" value="*" />
            <input type="submit" name="operator" value="/" />
	  </form>
<!-- ----------------------------------------------Task 4------------------------------------------------- -->
<form method="post" action="index.php">
		<input type="text" name="task" required>
		<input type="submit" name="addTask" value= "Add Task"/>
        <?php
session_start();
if (isset($_POST["addTask"])) {
    if (isset($_SESSION["tasks"])) {
        array_push($_SESSION["tasks"],$_POST["task"]);
    }else{
        $_SESSION["tasks"] = array($_POST["task"]);
    }
}
if (isset($_SESSION["tasks"])){
    foreach($_SESSION["tasks"] as $task){
        echo "<p>$task</p>";
    }
}
        ?>
	</form>
<!-- ----------------------------------------------Task 5------------------------------------------------- -->
<?php
$path= explode('/',$_SERVER['SCRIPT_NAME']);
echo 'Project name is: '.$path[1].'<br>';
echo 'Script name is: '.$path[2].'<br>';
// <!-- ----------------------------------------------Task 6------------------------------------------------- -->
echo ' page requested time is: '.$_SERVER['REQUEST_TIME'] . '<br>';
// <!-- ----------------------------------------------Task 7 & 8------------------------------------------------- -->
if (isset($_SESSION['refresh']))
	$_SESSION['refresh']++;
else
	$_SESSION['refresh'] = 1;
echo 'this page has been refreshed for '.$_SESSION['refresh'].' times';
// <!-- ----------------------------------------------Task 9------------------------------------------------- -->
setcookie("Tasks", "Done", time() + 60 * 60, "/", "http://localhost/oca/super-task", false, false);
echo "<pre>";
// echo $_COOKIE["Tasks"];
print_r($_COOKIE);
// unset($_COOKIE["Tasks"]);
// setcookie("Tasks", "", time() - 60 * 60);
// if ($_SERVER["REQUEST_METHOD"] == "POST") {   
//     echo "The data is sent by POST";
// }
// else {
//     echo "The data is sent by GET";
// }
?>
</body>
</html>