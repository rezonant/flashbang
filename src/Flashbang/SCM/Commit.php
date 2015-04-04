<?php

namespace Flashbang\SCM;

/**
 * Represents a commit provided by an SCMProvider instance.
 * @author liam
 */
class Commit {
	/**
	 * Construct a new Commit object.
	 * 
	 * @param string $id
	 * @param string $author
	 * @param string $message
	 */
	public function __construct($id, $author, $message, $filesAdded, $filesRemoved)
	{
		$this->id = $id;
		$this->author = $author;
		$this->message = $message;
		$this->filesAdded = $filesAdded;
		$this->filesRemoved = $filesRemoved;
	}
	
	private $id;
	private $author;
	private $message;
	private $filesAdded;
	private $filesRemoved;
	
	public function getAddedFiles()
	{
		return $this->filesAdded;
	}
	
	public function getRemovedFiles()
	{
		return $this->filesRemoved;
	}
	
	/**
	 * Retrieve the author of this commit
	 * @return string
	 */
	public function getAuthor()
	{
		return $this->author;
	}
	
	/**
	 * Retrieve the commit message associated with this commit,
	 * or an empty string if there is no such message.
	 * 
	 * @return string
	 */
	public function getMessage()
	{
		return $this->message;
	}
	
	/**
	 * Retrieve the ID for this commit. This ID will be recorded internally
	 * and passed to the various operations of SCMProvider, so it must be canonical.
	 * 
	 * @return string
	 */
	public function getId()
	{
		return $this->id;
	}
}
