<?php
// use the following namespace
use PHPUnit\Framework\TestCase;

// extend using TestCase instead PHPUnit_Framework_TestCase
class SampleTest extends TestCase {

	public function testTrueAssertsToTrue()
	{
		$this->assertTrue(true);
	}
}