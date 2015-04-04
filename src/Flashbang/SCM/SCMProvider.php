<?php

namespace Flashbang\SCM;

/**
 * Base class for SCM (Source Code Management) providers.
 * Responsible for resolving a set of user parameters into a Repository instance.
 * 
 * @author liam
 */
abstract class SCMProvider {
	
	/**
	 * Construct a Repository object for the given $params.
	 * The resulting Repository object must identify a single branch within the repository.
	 * 
	 * @throws BadParameterException Thrown if parameters are missing or incorrect
	 */
	public abstract function getRepository($params);
}
