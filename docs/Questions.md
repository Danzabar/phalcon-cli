Questions
=========

You can quickly ask a question using the `Danzabar\CLI\Traits\Question` trait. The most basic way of doing this is asking a question with a free text response, to do this you can use the `ask` method

	$answer = $this->ask("Do you like Questions?");

The answer will contain just the input from the user. There are also choice questions, which pose a question with a list of answers one of which must be selected:

	$answer = $this->choice("Pick one", Array('one', 'two'));

You can also ask Multiple Choice questions:

	$answers = $this->multipleChoice('Pick two of these', Array('one', 'two', 'three'));

You seperate answers with a comma, and the `$answers` var will be an array this time. You can set an error message with the Choice questions for when the answer is not in the list of options. To update this use the `setChoiceError` method:

	$this->setChoiceError("Please select a valid answer");
