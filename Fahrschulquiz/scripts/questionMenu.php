<td>
                <form action="index.php" method="get">
                    <button type="submit" name="fertigstellen">Quiz fertigstellen</button>
                </form>
            </td>
            <td>
                <?php
                $quiz = Quiz::getInstance();
                if ($quiz->getNumberAnsweredQuestions() > 0) {
                    echo "<label>Beatwortet</label>";
                    echo "<div id='linkAnswerd'>";
                    for ($i = 0; $i < $quiz->getNumberAnsweredQuestions(); $i++) {
                        echo "<a id='links' href='index.php?questionNumber=" . $i . "'>" . ($i + 1) . "</a>";
                    }
                    echo "</div>";
                } else {
                    echo "<p>Beantwortet: Keine beantworteten Fragen vorhanden</p>";
                }
                if ($quiz->getNumberUnansweredQuestions() > 0) {
                    echo "<label>Unbeantwortet: </label>";
                    echo "<div id='linkUnanswerd'>";
                    for ($i = 0; $i < $quiz->getNumberUnansweredQuestions(); $i++) {
                        echo "<a id='links' href='index.php?questionNumber=" . $i . "'>" . ($i + 1) . "</a>";
                    }
                    echo "</div>";
                } else {
                    echo "<p>Nicht beantwortet: Keine unbeantworteten Fragen vorhanden</p>";
                }

                ?>
            </td>
            <td>
                <button id="PrevQ" type="submit" form="QuizAnswers" name="previousQuestion" onclick="questionLink(<?= Quiz::getInstance()->previousQuestion() ?>)">Vorige Frage</button>
            </td>
            <?php
            if(isset($_GET['questionNumber']) && $_GET['questionNumber'] != 0){
                $quiz->setActualQuestionNumber($quiz->getActualQuestionNumber() + 1);
            }
            ?>
            <td>
                <button id="NextQ" type="submit" form="QuizAnswers"name="nextQuestion" onclick="questionLink(<?= Quiz::getInstance()->nextQuestion() ?>)">Nächste Frage</button>
                <?php
                if(isset($_GET['questionNumber']) && $_GET['questionNumber'] != 9){
                    $quiz->setActualQuestionNumber($quiz->getActualQuestionNumber() - 1);
                }
                ?>
            </td>