<?php

function validateUser($userInput) {
	return stripslashes(trim(htmlspecialchars($userInput, ENT_QUOTES, 'UTF-8')));
}
