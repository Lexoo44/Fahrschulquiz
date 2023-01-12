<?php
require_once 'class.Answer.php';
require_once 'class.Question.php';
class Quiz
{
	/*
   * Konstanten
   */
	public const QUESTIONS_COUNT = 10;
	public const ANSWERS_COUNT = 3;
	public const MINIMUM_PERCENT = 86.6666;
	private static $instance = NULL;

	/**
	 * Hier wird die Fragenummer der aktuellen Frage gemerkt. Die Fragen werden
	 * mit 0 beginnend nummeriert
	 */
	private $actualQuestionNumber = 0;
	/**
	 * Hier wird gemerkt, ob das Quiz fertiggestellt bzw. abgegeben wurde
	 */
	private $completed = false;
	/**
	 * 
	 * Enth�lt die f�r das Quiz ausgew�hlten Fragen
	 */
	private $questions = null;

	/**
	 * Enthält die für das Quiz ausgewählten Fragen
	 */
	private $answers = null;
	/*
	 * Konstruktoren
	 */
	/*
	 *  Array zur speicherung der nummer zufälligen Fragen
	 */
	private $questionNumbers = array();
	private $count = 0;
	/**
	 * Legt Quiz an und holt sich dabei Fragen zuf�llig aus der Datenbank
	 * und schreibt diese in das Fragen-Array hinein
	 */
	public static function getInstance(){
        if(!isset($_SESSION['quiz'])) {
			require_once 'scripts/datenbank.php';
            self::$instance = new Quiz();
			$quiz = self::$instance;
			$_SESSION['quiz'] = $quiz;
		}
        return $_SESSION['quiz'];
    }
	
	private function __construct()
	{
		//if(!isset($_SESSION['quiz'])) {
			$conn = mysqli_connect("localhost", "root", "masterkey", "quiz");
			$sql = "SELECT * FROM fragen ORDER BY RAND() LIMIT 10";
			$stmt = $conn->prepare($sql);
			$stmt->execute();
			$result = $stmt->get_result();
			while ($row = $result->fetch_assoc()) {
				$this->questionNumbers[] = $row['fragenummer'];
			}
			
			foreach ($this->questionNumbers as $questionNumber) {
				$sql = "SELECT * FROM antworten WHERE fragenummer = ? ORDER BY RAND() LIMIT 3";
				$stmt = $conn->prepare($sql);
				$stmt->bind_param("i", $questionNumber);
				$stmt->execute();
				$answersPerQuestion = array();
				$result = $stmt->get_result();
				while ($row = $result->fetch_assoc()) {
					$answer = new Answer($row['antworttext'], $row['richtig']);
					$answersPerQuestion[] = $answer;
				}
				$this->answers[] = $answersPerQuestion;
			}
			//print_r($this->answers);
			foreach ($this->questionNumbers as $questionNumber) {
			$sql = "SELECT * FROM fragen WHERE fragenummer = $questionNumber" ;
			$result = $conn->query($sql);

			while ($row = $result->fetch_assoc()) {
				$question = new Question($row['fragetext'], $row['bild'], $this->answers[$this->count]);
				$this->count = $this->count + 1;
				$this->questions[] = $question;
			}
			}
		//}
	}	
	


	/*
	 * Getter- und Settermethoden
	 */
	/**
	 * Liefert die Nummer der aktuellen Frage zur�ck
	 * @return 
	 */
	public function getActualQuestionNumber()
	{
		return $this->actualQuestionNumber;
	}
	/**
	 * Setzt die Nummer der aktuellen Frage
	 * @param 
	 */
	public function setActualQuestionNumber($actualQuestionNumber)
	{
		return $this->actualQuestionNumber = $actualQuestionNumber;
	}
	/**
	 * Springt zur n�chsten Frage die zur aktuellen Frage wird
	 * @return
	 */
	public function nextQuestion()
	{
		if($this->actualQuestionNumber < 9) {
			return $this->actualQuestionNumber = $this->actualQuestionNumber + 1;
		}
		return $this->getActualQuestionNumber();
		
	}
	
	
	/**
	 * Springt zur vorigen Frage die zur aktuellen Frage wird
	 * @return
	 */
	public function previousQuestion()
	{
		if($this->actualQuestionNumber > 0) {
			$this->actualQuestionNumber = $this->actualQuestionNumber - 1;
		}
		return $this->getActualQuestionNumber();
		
	}
	/**
	 * Liefert die Anzahl der Fragen des Quiz zur�ck
	 * @return 
	 */
	public function getNumberQuestions()
	{
		return count($this->questions);
	}
	/**
	 * Liefert die aktuelle Frage zur�ck
	 * @return 
	 */
	public function getActualQuestion()
	{
		return $this->questions[$this->actualQuestionNumber];
	}
	/**
	 * Liefert true zur�ck, falls nach der aktuellen Frage noch eine weitere
	 * Frage im Quiz existiert
	 * @return 
	 */
	public function getHasNextQuestion()
	{
		$ret = false;
		if ($this->actualQuestionNumber < $this->getNumberQuestions() - 1)
			$ret = true;
		return $ret;
	}
	/**
	 * Liefert true zur�ck, falls vor der aktuellen Frage noch eine Frage
	 * im Quiz vorhanden ist
	 * @return 
	 */
	public function getHasPreviousQuestion()
	{
		$ret = false;
		if ($this->actualQuestionNumber > 0) {
			$ret = true;
		}
		return $ret;
	}
	/**
	 * Liefert die ganzen Fragen des Quiz zur�ck
	 * @return 
	 */
	public function getQuestions()
	{
		return $this->questions;
	}
	/**
	 * Liefert die Anzahl der beantworteten Fragen des Quiz zur�ck
	 * @return 
	 */
	public function getNumberAnsweredQuestions()
	{
		$ret = 0;
		foreach ($this->questions as $question) {
			if ($question->getAnswered()) {
				$ret++;
			}
		}
		return $ret;
	}

	/**
	 * Liefert die Anzahl der nicht beantworteten Fragen des Quiz zur�ck
	 * @return 
	 */
	public function getNumberUnansweredQuestions()
	{
		$ret = 0;
		foreach ($this->questions as $question) {
			if (!$question->getAnswered()) {
				$ret++;
			}
		}
		return $ret;
	}
	/**
	 * Das Quiz wird fertiggestellt
	 * @param 
	 */
	public function setCompleted($completed)
	{
		$this->completed = $completed;
	}
	/**
	 * Kontrolliert ob das Quiz fertiggestellt wurde
	 * @return
	 */
	public function getCompleted()
	{
		return $this->completed;
	}
	/**
	 * Liefert die Anzahl der richtig gesetzten Antwortm�glichkeiten zur�ck. F�r
	 * jede richtige Antwort wird ein Punkt vergeben
	 * @return 
	 */
	public function getPoints()
	{
		//get the points for each qusetion
		$points = 0;
		foreach ($this->questions as $question) {
			if ($question->getAnswered()) {
				foreach($question->getAnswers() as $answer) {
					$points = $points + $answer->getPoints();					
				}
			}
		}
		return $points;
	}
	/**
	 * Liefert die insgesamt m�glichen Punkte zur�ck. Pro Antwortm�glichkeit wird
	 * ein Punkt vergeben
	 * @return 
	 */
	public function getMaximalPoints()
	{
		$ret = 0;
		foreach ($this->questions as $question) {
			$ret += count($question->getAnswers());
		}
		return $ret;
	}
	/**
	 * Ermittelt die Anzahl der richtig gesetzten Antworten in Prozent gerundet auf 2
	 * Kommastellen
	 * @return 
	 */
	public function getPointsInPercent()
	{
		$ret = 0;
		if ($this->getMaximalPoints() > 0) {
			$ret = round($this->getPoints() / $this->getMaximalPoints() * 100, 2);
		}
		return $ret;
	}
	/**
	 * Liefert zur�ck ob das Quiz bestanden wurde oder nicht. Ein Quiz kann nur
	 * bestanden werden, falls es fertiggestellt wurde und falls MINIMUM_PERCENT 
	 * der Punkte erzielt werden konnten
	 * @return 
	 */
	public function getPassed()
	{
		$ret = false;
		if ($this->getCompleted()) {
			if ($this->getPointsInPercent() >= static::MINIMUM_PERCENT) {
				$ret = true;
			}
		}
		return $ret;
	}

	public function getPreviousQuestion(){
		if($this->actualQuestionNumber > 0) {
			return $this->questions[$this->actualQuestionNumber - 1];
		}
		return null;
	}

	public function getNextQuestion(){
		if($this->actualQuestionNumber < $this->getNumberQuestions() - 1) {
			return $this->questions[$this->actualQuestionNumber + 1];
		}
		return null;
	}
}

