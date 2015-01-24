<?php namespace Danzabar\CLI\Tasks\Helpers;

use Danzabar\CLI\Tasks\Helpers\Helper;

/**
 * The Question helper class
 *
 * @package CLI
 * @subpackage Tasks\Helpers
 * @author Dan Cox
 */
class Question extends Helper
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
		if($allowedMultiple)
		{
			return $this->validateMultipleChoice($answer, $choices);
		} else
		{
			return $this->validateSingleChoice($answer, $choices);
		}
	}

	/**
	 * Validates a single answer
	 *
	 * @return Boolean|String
	 * @author Dan Cox
	 */
	public function validateSingleChoice($answer, $choice)
	{
		if(!in_array(trim($answer), $choice))
		{
			return false;
		}

		return $answer;
	}

	/**
	 * Validates multiple answers
	 *
	 * @return Boolean|String
	 * @author Dan Cox
	 */
	public function validateMultipleChoice($answer, $choice)
	{
		$answers = explode(',', $answer);
		
		foreach($answers as $ans)
		{
			if(!in_array(trim($ans), $choice))
			{
				return false;
			}

			$formatedAnswers[] = trim($ans);
		}		

		return $formatedAnswers;
	}

} // END class Question extends Helper
