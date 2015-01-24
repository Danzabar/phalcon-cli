<?php namespace Danzabar\CLI\Tasks\Traits;


/**
 * The confirmation trait, confirm an action and return a Boolean value
 *
 *
 */
Trait Confirmation
{

	/**
	 * The value for a a "Yes" confirmation
	 *
	 * @var string
	 */
	protected $confirmYes = 'Y';

	/**
	 * The value for a "No" confirmation
	 *
	 * @var string
	 */
	protected $confirmNo = 'N';

	/**
	 * The error message that returns in the explicit option is set
	 * and the answer user gives does not match the confirm vars
	 *
	 * @var string
	 */
	protected $invalidConfirmationError = 'Unexpected confirmation.';

	/**
	 * If set to true this will only accept the confirm yesy
	 * and confirm no values, otherwise any value that is not
	 * equal to confirm yes will equate to a no
	 *
	 * @var Boolean
	 */
	protected $explicit = FALSE;

	/**
	 * Request basic confirmation returns a boolean value depending on the answer
	 *
	 * @return Boolean
	 * @author Dan Cox
	 */
	public function confirm($text = 'Do you wish to continue?')
	{
		$this->output->writeln($text);

		return $this->convertToBool($this->input->getInput());	
	}

	/**
	 * Converts the input to a boolean value depending on its answer
	 *
	 * @return Boolean
	 * @author Dan Cox
	 */
	public function convertToBool($answer)
	{
		// If it equals confirm yes
		if($answer == $this->confirmYes)
		{
			return true;
		}

		if($answer == $this->confirmNo || $this->explicit === false)
		{
			return false;
		}

		$this->output->writeln($this->invalidConfirmationError);
	}
	
	/**
	 * Sets the value of the confirmation
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function setConfirmationYes($value)
	{
		$this->confirmYes = $value;
	}

	/**
	 * Sets the reject value for confirmation
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function setConfirmationNo($value)
	{
		$this->confirmNo = $value;
	}

	/**
	 * Sets the explicit variable which controlls how answers are returned
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function setConfirmExplicit($switch)
	{
		$this->explicit = $switch;
	}

	/**
	 * Set the error message that shows on an invalid answer in explicit mode
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function setInvalidConfirmationError($error)
	{
		$this->invalidConfirmationError = $error;
	}

}
