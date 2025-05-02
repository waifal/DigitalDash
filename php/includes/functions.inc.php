<?php


function validateUser(?string $userInput): ?string {
	if ($userInput === null) {
		return null;
	}

	$userInput = preg_replace('/[^a-zA-Z]/', '', $userInput);

	return stripslashes(trim(htmlspecialchars($userInput, ENT_QUOTES, 'UTF-8')));
}
