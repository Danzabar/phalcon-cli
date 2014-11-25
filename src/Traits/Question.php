<?php namespace Danzabar\CLI\Traits;

/**
 * The question trait allows you to ask a selection of questions.
 *
 */
Trait Question
{
	
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

}
