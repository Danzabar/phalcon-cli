<?php namespace Danzabar\CLI\Tasks\Traits;

/**
 * The question trait allows you to ask a selection of questions.
 *
 */
Trait Question
{

	/**
	 * The error message displayed when the user selects the wrong choices. 
	 *
	 * @var string
	 */
	protected $wrongChoiceErrorMessage = 'The answer you selected is invalid.';
	
	/**
	 * Asks a basic question and returns the response.
	 *
	 * @return String
	 * @author Dan Cox
	 */
	public function ask($question)
	{
		$this->output->writeln($question);

		return $this->input->getInput();		
	}

	/**
	 * Sets the error message that displays when a user picks the wrong answer
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function setChoiceError($error)
	{
		$this->wrongChoiceErrorMessage = $error;
	}
	
	/**
	 * The choice question, pick a single choice.
	 *
	 * @return String
	 * @author Dan Cox
	 */
	public function choice($question, $choices = Array(), $allowedMultiple = FALSE)
	{
		$this->output->writeln($question);

		$this->output->writeln(join(',', $choices));

		$answer = $this->input->getInput();

		$valid = $this->validateChoices($answer, $choices, $allowedMultiple);

		if($valid !== FALSE)
		{
			return $valid;
		}

		$this->output->writeln($this->wrongChoiceErrorMessage);

		return false;
	}

	/**
	 * A quick function to allow multiple answers on a choice question
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function multipleChoice($question, $choices = Array())
	{
		return $this->choice($question, $choices, TRUE);
	}

	/**
	 * Checks that the answer is present in the list of choices
	 *
	 * @return Boolean
	 * @author Dan Cox
	 */
	public function validateChoices($answer, $choices, $allowedMultiple = FALSE)
	{
		$answersArr = explode(',', $answer);
		$formatedAnswers = Array();

		if(count($answersArr) == 1 || $allowedMultiple === FALSE)
		{
			if(!in_array(trim($answer), $choices))
			{
				return false;
			}

			return trim($answer);

		} else
		{
			foreach($answersArr as $ans)
			{
				if(!in_array(trim($ans), $choices))
				{
					return false;
				}

				$formatedAnswers[] = trim($ans);
			}		

			return $formatedAnswers;
		}	
	}
}
