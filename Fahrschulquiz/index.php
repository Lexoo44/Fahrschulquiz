<?php
require_once "inc/classes/class.Quiz.php";
session_start();


$quiz = Quiz::getInstance();
if (isset($_GET['questionNumber'])) {
    $questionNumber = $_GET['questionNumber'];
    $quiz->setActualQuestionNumber($questionNumber);
    require_once "scripts/validateAnswer.php";
} else {
    $quiz->setActualQuestionNumber(0);
}
if(isset($_GET['fertigstellen'])){
    $quiz->setCompleted(true);
}

if(isset($_GET['start'])){
    //$_GET['start'] = null;
    session_destroy();
    //echo "<meta http-equiv='refresh' content='1'>";
    //header("Refresh:0 url=index.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Fahrschulquiz</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="inc/css/usermanagement.css">
    <script defer src="inc/js/quizForm.js"></script>
</head>

<body>
    <h1 id="titel">Fahrschulquiz</h1>
    <?php
    if(isset($_SESSION['login'])){
        echo "<div id='login'><p>Sie sind eingeloggt als" . $_SESSION['login'] . "</p><a id='logina' href='scripts/login.php'>Logout</a></div>";
    } else {
        echo "<div id='login'><p>Sie sind nicht eingeloggt</p><a id='logina' href='scripts/login.php'>Login</a></div>";
    }
    ?>

    <table class="uppertable">
        <tr>
            <?php
            if (!$quiz->getCompleted()) {
                require_once "scripts/questionMenu.php";
            } else {
                require_once "scripts/questionMenuCompleted.php";
            }

            ?>
        </tr>
    </table>
    <hr>
    </hr>
    <table class="middletable">
        <tr>
            <td id="questionnumber">
                <?php
                $quiz = Quiz::getInstance();
                echo "<h3>Frage " . ($quiz->getActualQuestionNumber() + 1) . " von " . Quiz::QUESTIONS_COUNT . "</h3>";
                ?>
            </td>
            <td class="qustionPic" id="right">
                <?php
                $quiz = Quiz::getInstance();
                echo "<img src='images/" . $quiz->getActualQuestion()->getImageFilename() . "' alt=''>";
                ?>
            </td>
        </tr>
        <tr>
            <td id="left">
                <?php
                $quiz = Quiz::getInstance();
                echo "<p>" . $quiz->getActualQuestion()->getQuestionText() . "</p>";
                ?>

            </td>
            <td id="right">
                <?php
                $quiz = Quiz::getInstance();
                echo "<p>" . $quiz->getActualQuestion()->getImageFilename() . "</p>";
                ?>
            </td>
        </tr>
    </table>
    <hr>
    </hr>
    <?php
    $quiz = Quiz::getInstance();
    if ($quiz->getCompleted() == true) {
        require_once "scripts/quizCompleted.php";
    } else {
        require_once "scripts/quizFragen.php";
    }
    ?>
</body>

</html>