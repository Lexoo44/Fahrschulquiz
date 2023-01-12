<td>
    <h3>Auswertung</h3>
    <?php
    $quiz = Quiz::getInstance();
    //printf($quiz->getPoints());
    //if point are more than 90% of the max points
    
    if ($quiz->getPoints() >= ($quiz->getMaximalPoints() * 0.9)) {
        echo "Von den" . $quiz->getMaximalPoints() . " möglichen Punkten haben Sie " . $quiz->getPoints() . " erreicht. Das sind " . $quiz->getPointsInPercent() ." Prozent. Sie haben den Test bestanden.";
    } else {
        echo "Von den" . $quiz->getMaximalPoints() . " möglichen Punkten haben Sie " . $quiz->getPoints() . " erreicht. Das sind " . $quiz->getPointsInPercent() ." Prozent. Sie haben den Test nicht bestanden.";
    }
    ?>
</td>
<td>
    <?php
    $quiz = Quiz::getInstance();
    if ($quiz->getNumberAnsweredQuestions() > 0) {
        echo "<div id='linkAnswerd'>";
        for ($i = 0; $i < $quiz->getNumberAnsweredQuestions(); $i++) {
            echo "<a id='links' href='index.php?questionNumber=" . $i . "'>" . ($i + 1) . "</a>";
        }
        echo "</div>";
    }
    ?>
</td>
<td>
<form action="index.php" method="get">
        <input type="submit" name="start" value="Neues Quiz erstellen">
    </form>
</td>