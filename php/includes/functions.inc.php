<?php

function validateUser(?string $userInput): ?string {
	if ($userInput === null) {
		return null;
	}

	return stripslashes(trim(htmlspecialchars($userInput, ENT_QUOTES, 'UTF-8')));
}
