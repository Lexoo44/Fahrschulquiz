<table id="tableAnswers">
    <tbody>
        <tr>
            <td><label>Antworten</label></td>
            <td><label>Ihre Antworten</label></td>
            <td><label>Richtige Antworten</label></td>
            <td><label>Punkte</label></td>
        </tr>
        <tr>
            <td>
                <table>
                    <?php
                    $quiz = Quiz::getInstance();
                    $answers = $quiz->getActualQuestion()->getAnswers();
                    foreach ($answers as $answer) {
                        echo "<tr><td><label>" . $answer->getAnswerText() . "</label></td></tr>";
                    }
                    ?>
                </table>
            </td>
            <td>
                <table>
                    <?php
                    $quiz = Quiz::getInstance();
                    $answers = $quiz->getActualQuestion()->getAnswers();
                    $radioanswer = 1;
                    foreach ($answers as $answer) {
                        if ($answer->getAnswered() == true) {
                            if ($answer->getAnswerSelected() == true) {
                                echo "<tr><td><input type='radio' name=" . "answer" . $radioanswer . " checked disabled value='1'></td><td><input type='radio' name=" . "answer" . $radioanswer . " value='0' disabled></td></tr>";
                            } else {
                                echo "<tr><td><input type='radio' name=" . "answer" . $radioanswer . " value='1' disabled></td><td><input type='radio' name=" . "answer" . $radioanswer . " value='0' checked disabled></td></tr>";
                            }
                        } else {
                            echo "<tr><td><input type='radio' name=" . "answer" . $radioanswer . " value='1' disabled></td><td><input type='radio' name=" . "answer" . $radioanswer . " value='0' disabled></td></tr>";
                        }
                        $radioanswer = $radioanswer + 1;
                    }
                    ?>
                </table>

            </td>
            <td>
                <table>
                    <?php
                    $quiz = Quiz::getInstance();
                    $answers = $quiz->getActualQuestion()->getAnswers();
                    if ($quiz->getActualQuestion()->getAnswers()[0]->getCorrect() == 1) {
                        echo "<tr><td><input type='radio' name='answer1c' checked disabled value='1' disabled></td><td><input type='radio' name='answer1c' value='0' disabled></td></tr>";
                    } else if ($quiz->getActualQuestion()->getAnswers()[0]->getCorrect() == 0) {
                        echo "<tr><td><input type='radio'  checked name='answer1c' value='1' checked disabled></td><td><input type='radio' name='answer1c' value='0' checked disabled></td></tr>";
                    }
                    if ($quiz->getActualQuestion()->getAnswers()[1]->getCorrect() == 1) {
                        echo "<tr><td><input type='radio' name='answer2c' value='1' checked disabled></td><td><input type='radio' name='answer2c' value='0' disabled></td></tr>";
                    } else if ($quiz->getActualQuestion()->getAnswers()[1]->getCorrect() == 0) {
                        echo "<tr><td><input type='radio' name='answer2c' value='1' disabled></td><td><input type='radio' name='answer2c' value='0' checked disabled></td></tr>";
                    }
                    if ($quiz->getActualQuestion()->getAnswers()[2]->getCorrect() == 1) {
                        echo "<tr><td><input type='radio' name='answer3c' checked disabled value='1'></td><td><input type='radio' name='answer3c' value='0' disabled></td></tr>";
                    } else if ($quiz->getActualQuestion()->getAnswers()[2]->getCorrect() == 0) {
                        echo "<tr><td><input type='radio' name='answer3c' value='1' disabled></td><td><input type='radio' name='answer3c' value='0' checked disabled></td></tr>";
                    }
                    ?>
                </table>
            </td>
            <td>
                <table>
                <?php
                //check if selcted answer an correct answer are the same
                $quiz = Quiz::getInstance();
                $answers = $quiz->getActualQuestion()->getAnswers();
                foreach ($answers as $answer) {
                    if ($answer->getAnswered() == true) {
                            if ($answer->getCorrect() == true && $answer->getAnswerSelected() == true) {
                                echo "<tr><td><label>1</label></td></tr>";
                            } else if ($answer->getCorrect() == false && $answer->getAnswerSelected() == false) {
                                echo "<tr><td><label>1</label></td></tr>";
                            } else {
                                echo "<tr><td><label>0</label></td></tr>";
                            }
                        
                    } else {
                        echo "<tr><td><label>0</label></td></tr>";
                    }
                }
                ?></td>
                </table>
        </tr>
    </tbody>
</table>