<?php

namespace Flashbang\Commands;

/**
 * Show the version
 * @author liam
 */
class VersionCommand extends Command {
	public function getDescription() {
		return 'Show the Flashbang version';
	}
	
	public function execute(\Flashbang\Program $program, $parameters) {
		 echo $program->getName().' '.$program->getVersion()."\n";
	}
}
