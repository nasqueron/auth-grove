<?php

return [

	/*
	|--------------------------------------------------------------------------
	| E-mail content
	|--------------------------------------------------------------------------
	|
	| The following language lines are used in mails sent by Auth Grove.
	|
	*/

	///
	/// Master template
	///

    //The first line of every mail sent
	'greetings' => 'Hi,',

	//Signature
	'signature-separator' => '--',
	'signature' => 'Auth Grove',

	///
	/// Reset password mail
	///

	//Subject
	'reset-password-subject' => 'Your password reset link',

	//A paragraph of introduction explaining someone has visited /auth/recover
	//to recover account access and asked to reset the password by e-mail.
	'reset-password-intro' => 'Someone (we hope yourself) has requested to recover access to your account.',

	//To prevent the case login is forgotten, we give it too.
	'reset-password-login' => 'Your login is:',

	//A paragraph to explain the procedure. It will immediately be followed by
	//a new line with the URL the user must go to achieve the reset.
	'reset-password-callforaction' => 'To do so, you can reset your password at the following URL:',

	//A paragraph to indicate who requested the action. It will immediately be
	//followed by a new line with the presumed IP address of the requester.
	'reset-password-origin' => "This was requested from the following IP address:",
];
