<?php

use Danzabar\CLI\CommandTester;

/**
 * The test case for question trait
 *
 * @package CLI
 * @subpackage Tests
 * @author Dan Cox
 */
class QuestionTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * The tester
	 *
	 * @var Object
	 */
	protected $CT;
	
	/**
	 * Setup the test environment for commands
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function setUp()
	{
		$this->CT = new CommandTester();	
	}

	/**
	 * Test asking question a returning an answer
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_askQuestion()
	{
		$this->CT->setInput("answer \n");
		$this->CT->execute('Fake:ask');

		$this->assertContains('answer', $this->CT->getOutput());
	}

	/**
	 * A bit more complicated testing a question that expects two sets of input.
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_advQuestion()
	{
		$this->CT->setInput("yes\nAnswer\n");
		$this->CT->execute('Fake:advAsk');

		$this->assertContains('Answer', $this->CT->getOutput());	
	}

	/**
	 * Test the choice question functionality
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_choiceQuestion()
	{
		$this->CT->setInput("two\n");
		$this->CT->execute('Fake:choice');
		
		$this->assertContains('You have selected two', $this->CT->getOutput());
	}

	/**
	 * Test the validation of a choice
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_choiceError()
	{
		$this->CT->setInput("\n");
		$this->CT->execute('Fake:choice');

		$this->assertContains('The answer you selected is invalid', $this->CT->getOutput());
	}

	/**
	 * Test custom error
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_customError()
	{
		$this->CT->setInput("\n");
		$this->CT->execute('Fake:choice', Array('This is a custom error'));

		$this->assertContains('This is a custom error', $this->CT->getOutput());
	}

	/**
	 * Test multiple selection questions
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_multipleChoice()
	{
		$this->CT->setInput("one, five\n");
		$this->CT->execute('Fake:multiChoice');

		$this->assertContains("Selected one", $this->CT->getOutput());
		$this->assertContains("Selected five", $this->CT->getOutput());	
	}

	/**
	 * Test that an exception is thrown on a mulitple choice question
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_exceptionOnFalseMultipleChoiceAnswers()
	{
		$this->CT->setInput("answer, fake\n");
		$this->CT->execute("Fake:multiChoice");

		$this->assertContains("The answer you selected is invalid", $this->CT->getOutput());
	}

} // END class QuestionTest extends \PHPUnit_Framework_TestCase
