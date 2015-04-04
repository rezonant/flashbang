<?php

namespace Flashbang\SCM;

/**
 * Specifies the interface for a Repository provided by an SCMProvider.
 * @author liam
 */
abstract class Repository {
	/**
	 * Retrieve the ID of the latest commit.
	 * This can then be used with getCommit() to fetch the commit details.
	 * 
	 * @return string The latest commit ID
	 * @throws BadParameterException
	 */
	public abstract function getLatestCommitId();
	
	/**
	 * Retrieve the given Commit by ID
	 * 
	 * @return Commit The commit object.
	 * @throws InvalidArgumentException When no commit with $id exists
	 */
	public abstract function getCommit($id);
	
	/**
	 * Fetch the source code corresponding to the given repository (described 
	 * by $params) into the given filesystem $path.
	 * 
	 * This is used when no previous deployment was made.
	 * 
	 * @throws BadParameterException
	 */
	public abstract function fetch($path, Commit $commit);
	
	
	/**
	 * Fetch a file from the repository as it appeared within the given commit.
	 * 
	 * @throws BadParameterException
	 */
	public abstract function fetchFile($repoPath, $destFile, Commit $commit);
}
