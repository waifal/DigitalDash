<?php

function validateUsername($userInput) {
	return stripslashes(trim(htmlspecialchars($userInput)));
}
