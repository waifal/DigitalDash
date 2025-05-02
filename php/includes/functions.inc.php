<?php

function validateUsername($userInput) {
	return stripslashes(trim(htmlspecialchars($userInput, ENT_QUOTES, 'UTF-8')));
}
