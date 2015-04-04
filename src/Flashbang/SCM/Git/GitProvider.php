<?php

namespace Flashbang\SCM\Git;

/**
 * Description of GitProvider
 *
 * @author liam
 */
class GitProvider extends SCMProvider {
	public function getRepository($params) {
		$this->validateParameters($params);
		
		$gitURL = $params->url;
		$user = $params->user;
		$password = $params->password;
		$branch = isset($params->branch) ? $params->branch : 'master';
		
		return new GitRepository($gitURL, $user, $password, $branch);
	}
	
	private function validateParameters($params)
	{
		if (!isset($params->url))
			throw new \Flashbang\BadParameterException("Must provide a valid Git URL ('url')");
		
		if (!isset($params->user, $params->password))
			throw new \Flashbang\BadParameterException("Must provide a valid username/password");
	}
}
