<?php namespace Danzabar\CLI\Traits;

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
	public function choice($question, $choices = Array())
	{
		$this->output->writeln($question);

		$this->output->writeln(join(',', $choices));

		$answer = $this->input->getInput();

		$valid = $this->validateChoices(trim($answer), $choices);

		if($valid)
		{
			return $answer;
		}

		$this->output->writeln($this->wrongChoiceErrorMessage);

		return false;
	}

	/**
	 * Checks that the answer is present in the list of choices
	 *
	 * @return Boolean
	 * @author Dan Cox
	 */
	public function validateChoices($answer, $choices)
	{
		$answersArr = explode(',', $answer);

		if(count($answersArr) == 1)
		{
			if(!in_array($answer, $choices))
			{
				return false;
			}

		} else
		{
			foreach($answersArr as $ans)
			{
				if(!in_array($ans, $choices))
				{
					return false;
				}
			}		
		}	

		return true;
	}
}
