<?php

namespace Flashbang\Commands;

/**
 * Show help
 * @author liam
 */
class HelpCommand extends Command {
	public function getDescription() {
		return 'Shows this help screen';
	}
	
	public function execute(\Flashbang\Program $program, $parameters) {
		$program->help();
	}
}
