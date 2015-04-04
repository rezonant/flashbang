<?php

namespace Flashbang;

use Flashbang\SCM\SCMProvider;

/**
 * Enumerates a set of files which are staged to be deployed to a 
 * transport destination.
 * 
 * @author liam
 */
class FileManifest {
	/**
	 * Create a new FileManifest
	 * @param \Flashbang\FileManifestBuilder $builder The builder
	 */
	public function __construct(FileManifestBuilder $builder)
	{
		if (!$builder->isValid())
			throw new InvalidBuildException();
		
		$this->startCommit = $builder->getStartCommit();
		$this->endCommit = $builder->getLastCommit();
		$this->repository = $builder->getRepository();
		$this->addedFiles = $builder->getAddedFiles();
		$this->removedFiles = $builder->getRemovedFiles();
	}
	
	private $startCommit;
	private $endCommit;
	private $repository;
	private $addedFiles;
	private $removedFiles;
	
	public function getRepository() 
	{
		return $this->repository;
	}
	
	public function getStartCommit()
	{
		return $this->startCommit;
	}
	
	public function getEndCommit()
	{
		return $this->endCommit;
	}
	
	public function getAddedFiles()
	{
		return $this->addedFiles;
	}
	
	public function getRemovedFiles()
	{
		return $this->removedFiles;
	}
}
