<?php

namespace Flashbang;

/**
 * Thrown when the user provides an invalid option, or uses an option incorrectly.
 * @author liam
 */
class InvalidOptionException extends \Exception {
	public function __construct($option, $message = 'No such option')
	{
		$this->option = $option;
		parent::__construct($message);
	}
	
	private $option;
	
	public function getOption() {
		return $this->option;
	}
}
