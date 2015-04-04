<?php

namespace Flashbang;
use Flashbang\SCM\SCMProvider;
use Flashbang\InvalidBuildException;

/**
 * Used to build a FileManifest.
 * @author liam
 */
class FileManifestBuilder {
	public function __construct(SCM\Repository $repository)
	{
		$this->repository = $repository;
	}
	
	private $repository;
	private $startCommit;
	private $commits = array();
	private $removedFiles = array();
	private $addedFiles = array();
	
	public function getStartCommit()
	{
		return $this->startCommit;
	}
	
	public function getRemovedFiles()
	{
		return array_values($this->removedFiles);
	}
	
	public function getAddedFiles()
	{
		return array_values($this->addedFiles);
	}
	
	public function getRepository()
	{
		return $this->repository;
	}
	
	public function isValid()
	{
		return 1
			&& $this->repository
			&& $this->startCommit
			&& count($this->commits) > 0;
	}
	
	public function startCommit(SCM\Commit $commit)
	{
		$this->startCommit = $commit;
		return $this;
	}
	
	public function getLastCommit()
	{
		if (empty($this->commits))
			return null;
		
		return $this->commits[count($this->commits) - 1];
	}
	
	public function addCommit(SCM\Commit $commit)
	{
		foreach ($commit->getRemovedFiles() as $file)
			$this->fileRemoved($file);
		foreach ($commit->getAddedFiles() as $file)
			$this->fileAdded($file);
		
		$this->commits[] = $commit;
		
		return $this;
	}
	
	public function fileAdded($file)
	{
		$this->addedFiles[$file] = $file;
		return $this;
	}
	
	public function fileRemoved($file)
	{
		unset($this->addedFiles[$file]);
		$this->removedFiles[] = $file;
		return $this;
	}
	
	public function build()
	{
		if (!$this->isValid())
			throw new InvalidBuildException();
		
		return new FileManifest($this);
	}
}
