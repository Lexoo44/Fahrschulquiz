<form id="QuizAnswers" name="questionForm">
    <table>
        <tbody>
            <tr>
                <td><label>Antworten</label></td>
                <td>Richtig Falsch</td>
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
                        //check if answer sa been selected before
                        foreach ($answers as $answer) {
                            if ($answer->getAnswered() == true) {
                                if ($answer->getAnswerSelected() == true) {
                                    echo "<tr><td><input type='radio' name=" . "answer" . $radioanswer . " checked value='1'></td><td><input type='radio' name=" . "answer" . $radioanswer . " value='0'></td></tr>";
                                } else {
                                    echo "<tr><td><input type='radio' name=" ."answer" . $radioanswer . " value='1' ></td><td><input type='radio' name=" . "answer" . $radioanswer . " value='0' checked></td></tr>";
                                }
                            } else {
                                echo "<tr><td><input type='radio' name=" ."answer" . $radioanswer . " value='1'></td><td><input type='radio' name=" ."answer" . $radioanswer . " value='0'></td></tr>";
                            }
                            $radioanswer = $radioanswer + 1;
                        }
                        /*
                        foreach ($answers as $answer) {
                            echo "<tr><td><input type='radio' name=" . "answer" . $radioanswer . " value='1'></td>";
                            echo "<td><input type='radio' name=" . "answer" . $radioanswer . " value='0'>" . "<br></td></tr>";
                            $radioanswer = $radioanswer + 1;
                        }
                        */
                        ?>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <input type="hidden" name= "questionNumber" id="Answers">
</form>
