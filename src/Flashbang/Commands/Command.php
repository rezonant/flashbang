<?php

namespace Flashbang\Commands;

/**
 * Base class for commands
 * @author liam
 */
abstract class Command {
	public abstract function execute(\Flashbang\Program $program, $parameters);
	public abstract function getDescription();
}
