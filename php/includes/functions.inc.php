<?php

/**
 * Sanitizes and cleans user input, allowing only letters.
 *
 * @param ?string $userInput The input string, which may be null.
 * @return ?string The sanitized string or null if input is empty.
 */

function validateUser(?string $userInput): ?string {
	if ($userInput === null) {
		return null;
	}

	$userInput = preg_replace('/[^a-zA-Z]/', '', $userInput);

	return stripslashes(trim(htmlspecialchars($userInput, ENT_QUOTES, 'UTF-8')));
}
