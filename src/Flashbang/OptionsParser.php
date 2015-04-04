<?php

namespace Flashbang;

/**
 * @author liam
 */
class OptionsParser {
	public function __construct($defaults)
	{
		if (!is_object($defaults) && !is_array($defaults))
			throw new \InvalidArgumentException('$defaults must be an array or object');
		
		$this->defaults = (array)$defaults;
	}
	
	protected $defaults = array();
	protected $shortOptions = array();
	
	public function addShortOption($short, $full)
	{
		$this->shortOptions[$short] = $full;
		return $this;
	}
	
	/**
	 * Get the options specified in the given arguments array (skipping the first entry which is the program name).
	 * Provide a set of defaults which will initialize the return value.
	 */
	function parse($args, &$params) {

		array_shift($args);

		$enable = true;
		$options = $this->defaults;
		$params = array();
		$consumeOptionParam = null;
		
		foreach ($args as $arg) {
			if ($arg == '--') {
				$enable = false;
				continue;
			}

			if ($enable && $arg[0] == '-') {
				$arg = substr($arg, 1);
				if ($arg[0] == '-') {
					// Long option
					$option = substr($arg, 1);
					if (!isset($this->defaults[$option]))
						throw new InvalidOptionException('--'.$option);
					
					$hasValue = !is_bool($this->defaults[$option]);
					if ($hasValue) {
						$consumeOptionParam = $option;
						continue;
					}
					
					$options[$option] = true;
				} else {
					// Short option
					$shortOptions = $arg;
					
					for ($i = 0, $max = strlen($shortOptions); $i < $max; ++$i) {
						$shortOption = $shortOptions[$i];
						$eligibleForParam = count($shortOptions) == $i + 1;
						
						if (!isset($this->shortOptions[$shortOption]))
							throw new InvalidOptionException('-'.$shortOption);
						
						$option = $this->shortOptions[$shortOption];
						if (!isset($this->defaults[$option]))
							throw new InvalidOptionException('--'.$option);
						
						$hasValue = !is_bool($this->defaults[$option]);
						if ($hasValue) {
							if (!$eligibleForParam)
									throw new InvalidOptionException('--'.$option, 'Option requires a value');
							$consumeOptionParam = $option;
							break;
						}
						
						$options[$option] = true;
					}
				}
				
				continue;
			}

			if ($consumeOptionParam) {
				$options[$consumeOptionParam] = $arg;
				$consumeOptionParam = null;
				continue;
			}
			
			$params[] = $arg;
		}
		
		if ($consumeOptionParam)
			throw new InvalidOptionException('--'.$consumeOptionParam, 'Option requires a value');

		return (object)$options;
	}
}
