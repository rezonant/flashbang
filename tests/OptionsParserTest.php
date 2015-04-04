<?php

namespace Flashbang;

/**
 * @author liam
 */
class OptionsParserTest extends \PHPUnit_Framework_TestCase {
	public function testSimple()
	{
		$parser = new OptionsParser(array(
			'foo' => false,
			'bar' => ''
		));
		
		$params = array();
		$options = $parser->parse(array('prog', 'param1', '--foo', 'param2', '--bar', '3', 'param3'), $params);
		
		$this->assertEquals(true, $options->foo);
		$this->assertEquals('3', $options->bar);
		
		$this->assertCount(3, $params);
		$this->assertEquals('param1', $params[0]);
		$this->assertEquals('param2', $params[1]);
		$this->assertEquals('param3', $params[2]);
	}
	
	public function testDefaults()
	{
		$parser = new OptionsParser(array(
			'foo' => false,
			'bar' => 'abcd'
		));
		
		$params = array();
		$options = $parser->parse(array('prog', 'abc'), $params);
		
		$this->assertEquals(false, $options->foo);
		$this->assertEquals('abcd', $options->bar);
		
		$this->assertCount(1, $params);
		$this->assertEquals('abc', $params[0]);
	}
	
	/**
	 * @expectedException \Flashbang\InvalidOptionException
	 */
	public function testMissingValue()
	{
		$parser = new OptionsParser(array(
			'foo' => false,
			'bar' => ''
		));
		
		$params = array();
		$options = $parser->parse(array('prog', 'param1', '--foo', 'param2', '--bar'), $params);
		
		$this->assertEquals(true, $options->foo);
		$this->assertEquals('3', $options->bar);
		
		$this->assertCount(3, $params);
	}
	
	/**
	 * @expectedException \Flashbang\InvalidOptionException
	 */
	public function testInvalidOption()
	{
		$parser = new OptionsParser(array(
			'foo' => false,
			'bar' => ''
		));
		
		$params = array();
		$parser->parse(array('prog', 'param1', '--foo', 'param2', '--baz'), $params);
	}
	
	
	/**
	 * @expectedException \Flashbang\InvalidOptionException
	 */
	public function testShortOptionsSimple()
	{
		$parser = new OptionsParser(array(
			'foo' => false,
			'bar' => ''
		));
		
		$parser->addShortOption('f', 'foo');
		$parser->addShortOption('b', 'bar');
		
		$params = array();
		$options = $parser->parse(array('prog', '-fb', 'param2'), $params);
		
		$this->assertEquals(true, $options->foo);
		$this->assertEquals('3', $options->bar);
		
		$this->assertCount(3, $params);
	}
}
