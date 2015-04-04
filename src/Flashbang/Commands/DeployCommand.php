<?php

namespace Flashbang\Commands;

/**
 * Deploy something
 * @author liam
 */
class DeployCommand extends Command {
	public function getDescription() {
		return 'Deploy your software';
	}
	
	public function execute(\Flashbang\Program $program, $parameters) {
		echo "Would deploy!\n";
	}
}
