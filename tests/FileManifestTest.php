<?php

namespace Flashbang;
use Flashbang\SCM\Commit;

/**
 * Description of FileManifestTest
 *
 * @author liam
 */
class FileManifestTest extends \PHPUnit_Framework_TestCase {
	protected function setUp() {
		$this->repository = $this->getMockForAbstractClass('\Flashbang\SCM\Repository');
		$this->startCommit = new Commit(1, 'Liam', 'Initial commit', 
				array(), array());
		$this->startCommit = new Commit(9001, 'Liam', 'Final commit', 
				array(), array());
		
		// Mock the builder
		$this->builder = $this->getMockBuilder('\Flashbang\FileManifestBuilder')
			 ->setConstructorArgs(array($this->repository))
			 ->getMock();
		$this->builder
			->method('getRepository')->will($this->returnValue($this->repository));
		$this->builder
			->method('getStartCommit')->will($this->returnValue($this->startCommit));
		$this->builder
			->method('getLastCommit')->will($this->returnValue($this->lastCommit));
		$this->builder
			->method('isValid')->will($this->returnValue(true));
		$this->builder
			->method('getAddedFiles')->will($this->returnValue(array('foo.txt', 'bar.txt')));
		$this->builder
			->method('getRemovedFiles')->will($this->returnValue(array('baz.txt')));
		
		var_dump($this->builder->isValid());
		parent::setUp();
	}
	
	private $startCommit;
	private $lastCommit;
	private $builder;
	
	public function testSimple()
	{
		$manifest = new FileManifest($this->builder);
		$this->assertEquals(
			array('foo.txt', 'bar.txt'),
			$manifest->getAddedFiles()
		);
		$this->assertEquals(
			array('baz.txt'),
			$manifest->getRemovedFiles()
		);
		
		$this->assertEquals($this->startCommit, $manifest->getStartCommit());
		$this->assertEquals($this->lastCommit, $manifest->getEndCommit());
	}
}
