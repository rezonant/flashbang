<?php

namespace Flashbang\SCM\Git;

use \Flashbang\SCM\Repository;

/**
 * Represents a git repository
 * @author liam
 */
class GitRepository extends Repository {
	public function __construct($url, $user, $password, $branch)
	{
		$this->url = $url;
		$this->user = $user;
		$this->password = $password;
		$this->branch = $branch;
	}
	
	private $url;
	private $user;
	private $password;
	private $branch;
	
	public function fetch($path, \Flashbang\SCM\Commit $commit) {
		;
	}
	
	public function fetchFile($repoPath, $destFile, \Flashbang\SCM\Commit $commit) {
		;
	}
	
	public function getCommit($id) {
		;
	}
	
	public function getLatestCommitId() {
		;
	}
}
