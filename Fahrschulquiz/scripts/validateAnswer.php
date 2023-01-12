<?php
    $quiz = Quiz::getInstance();

    if(isset($_GET['nextQuestion'])){
        if(isset($_GET['answer1']) || isset($_GET['answer2']) ||isset($_GET['answer3'])){
            //if answer is set save answer
            if(isset($_GET['answer1'])){
                $answer1 = $_GET['answer1'];
                $quiz->getPreviousQuestion()->getAnswers()[0]->setAnswerSelected($answer1);
            }
            if(isset($_GET['answer2'])){
                $answer2 = $_GET['answer2'];
                $quiz->getPreviousQuestion()->getAnswers()[1]->setAnswerSelected($answer2);
            }
            if(isset($_GET['answer3'])){
                $answer3 = $_GET['answer3'];
                $quiz->getPreviousQuestion()->getAnswers()[2]->setAnswerSelected($answer3);
            }
        }
    } else if(isset($_GET['previousQuestion'])){
        if(isset($_GET['answer1']) || isset($_GET['answer2']) ||isset($_GET['answer3'])){
            //if answer is set save answer
            if(isset($_GET['answer1'])){
                $answer1 = $_GET['answer1'];
                $quiz->getNextQuestion()->getAnswers()[0]->setAnswerSelected($answer1);
            }
            if(isset($_GET['answer2'])){
                $answer2 = $_GET['answer2'];
                $quiz->getNextQuestion()->getAnswers()[1]->setAnswerSelected($answer2);
            }
            if(isset($_GET['answer3'])){
                $answer3 = $_GET['answer3'];
                $quiz->getNextQuestion()->getAnswers()[2]->setAnswerSelected($answer3);
            }
        }
    } else {
        if(isset($_GET['answer1']) || isset($_GET['answer2']) ||isset($_GET['answer3'])){
            //if answer is set save answer
            if(isset($_GET['answer1'])){
                $answer1 = $_GET['answer1'];
                $quiz->getActualQuestion()->getAnswers()[0]->setAnswerSelected($answer1);
            }
            if(isset($_GET['answer2'])){
                $answer2 = $_GET['answer2'];
                $quiz->getActualQuestion()->getAnswers()[1]->setAnswerSelected($answer2);
            }
            if(isset($_GET['answer3'])){
                $answer3 = $_GET['answer3'];
                $quiz->getActualQuestion()->getAnswers()[2]->setAnswerSelected($answer3);
            }
        }
    }
?>