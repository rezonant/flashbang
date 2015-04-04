<?php

namespace Flashbang;
use Flashbang\SCM\Commit;

/**
 * Test FileManifestBuilder
 *
 * @author liam
 */
class FileManifestBuilderTest extends \PHPUnit_Framework_TestCase {
	
	protected function setUp() {
		$this->repository = $this->getMockForAbstractClass('\Flashbang\SCM\Repository');
		$this->startCommit = new Commit(1, 'Liam', 'Initial commit', 
				array('README.md', 'index.php', 'build.log'), 
				array());
		$this->secondCommit = new Commit(2, 'Liam', 'Remove build log and add build file', 
				array('build.json'), 
				array('build.log'));
		$this->thirdCommit = new Commit(3, 'Liam', 'Add tests', 
				array('tests/phpunit.xml', 'tests/phpunit.log'),
				array());
		$this->fourthCommit = new Commit(4, 'Liam', 'Oops, removing log', 
				array(),
				array('tests/phpunit.log'));
		parent::setUp();
	}
	
	private $repository;
	private $startCommit;
	
	public function testIsValid() {
		$builder = new FileManifestBuilder($this->repository);
		$builder->startCommit($this->startCommit);
		$builder->addCommit($this->secondCommit);
		$this->assertTrue($builder->isValid());
	}
	
	public function testSimple() {
		$builder = new FileManifestBuilder($this->repository);
		$builder->startCommit($this->startCommit);
		$builder->addCommit($this->secondCommit);
		$builder->addCommit($this->thirdCommit);
		$builder->addCommit($this->fourthCommit);
		
		$this->assertEquals(
			array('build.json', 'tests/phpunit.xml'),
			$builder->getAddedFiles()
		);
		$this->assertEquals(
			array('build.log', 'tests/phpunit.log'),
			$builder->getRemovedFiles()
		);
	}
	
	public function testBuild() {
		$builder = new FileManifestBuilder($this->repository);
		$builder->startCommit($this->startCommit);
		$builder->addCommit($this->secondCommit);
		$builder->addCommit($this->thirdCommit);
		$builder->addCommit($this->fourthCommit);
		$builder->build();
	}
	
	/**
	 * @expectedException \Flashbang\InvalidBuildException
	 */
	public function testInvalidBuild_empty() {
		
		$builder = new FileManifestBuilder($this->repository);
		$builder->build();
	}
	
	/**
	 * @expectedException \Flashbang\InvalidBuildException
	 */
	public function testInvalidBuild_noCommits() {
		
		$builder = new FileManifestBuilder($this->repository);
		$builder->startCommit($this->startCommit);
		$builder->build();
	}
}
