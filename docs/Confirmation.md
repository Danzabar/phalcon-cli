Confirmation
============

The `Confirmation helper allows you to ask for confirmation from the user before continuing with an action, for example:

	$confirmation = $this->helpers->load('confirm');

	if($confirmation->confirm("Do you want to continue?"))
	{
		// Confirmed
	}

You can decide what the value for confirmed or cancelled is using the `setConfirmationYes` and `setConfirmationNo` respectively:

	$confirmation->setConfirmationYes('confirm');
	$confirmation->setConfirmationNo('cancel');

By Default the confirmation trait will take any answer that isnt the `ConfirmationYes` as a no, you can change this by setting the explicit flag:

	$confirmation->setConfirmExplicit(TRUE);

This will return an error when a user doesnt give either the chosen yes or no answers, you can edit this error by using the `setInvalidConfirmationError` method:

	$confirmation->setInvalidConfirmationError('Please confirm Yes or No');

