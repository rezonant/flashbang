<?php

namespace Flashbang;

class Program {
	public function __construct($arguments) {
		if (!is_array($arguments) || count($arguments) < 1) 
			throw new InvalidArgumentException('$arguments argument must be an array with at least one entry');
		
		$this->name = $arguments[0];
		array_shift($arguments);
		$this->arguments = $arguments;
	}

	const VERSION = '1.0.0';
	
	private $name;
	private $arguments;
	
	private $commands = array(
		'help' => '\Flashbang\Commands\HelpCommand',
		'deploy' => '\Flashbang\Commands\DeployCommand',
		'version' => '\Flashbang\Commands\VersionCommand'
	);
	
	public function getName() {
		return $this->name;
	}
	
	public function getVersion() {
		return self::VERSION;
	}
	
	public function showCommands() {
		foreach ($this->commands as $command => $class) {
			$instance = new $class();
			echo "$command -- {$instance->getDescription()}\n";
		}
	}
	
	/**
	 * Process the job specified in the options
	 */
	public function process() {
		try {
			$params = $this->arguments;
			$command = array_shift($params);

			if ($command === null)
				$this->help();
			
			if ($command == '--version' || $command == '-v')
				$command = 'version';
			if ($command == '--help' || $command == '-h')
				$command = 'help';
			
			if (!isset($this->commands[$command])) {
				$this->help('Invalid command '.$command);
				return 1;
			}

			$class = $this->commands[$command];
			$instance = new $class($this, $params);
			
			return $instance->execute($this, $params);
		} catch (HelpException $e) {
			$this->showHelp($e->getMessage());
		}
	}

	public function help($reason = '') {
		throw new HelpException($reason);
	}
	
	protected function showHelp($reason = '') {
		if ($reason)
			echo "Error: $reason\n";
		
		echo "Usage: ".$this->name." <command> [options]\n";
		echo "\n";
		echo "Commands: \n";
		$this->showCommands();
		echo "\n";
	}
}