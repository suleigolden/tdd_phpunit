<?php
// use the following namespace
use PHPUnit\Framework\TestCase;

// extend using TestCase instead PHPUnit_Framework_TestCase
class UserTest extends TestCase {

	/** @test */
	public function that_We_Can_Get_The_First_Name()
	{
		$user = new \App\Models\User;

		$user->setFirstName('Suleiman');

		$this->assertEquals($user->getFirstName(), 'Suleiman');
	}

	public function testThatWeCanGetTheLastName()
	{
		$user = new \App\Models\User;

		$user->setLastName('Golden');

		$this->assertEquals($user->getLastName(), 'Golden');
	}

	public function testThatWeCanGetTheFullName()
	{
		$user = new \App\Models\User;

		$user->setFirstName('Suleiman');
		$user->setLastName('Golden');

		$this->assertEquals($user->getFullName(), 'Suleiman Golden');
	}

	public function testFirstNameAndLastNameTrimed()
	{
		$user = new \App\Models\User;

		$user->setFirstName('Suleiman   ');
		$user->setLastName('   Golden');

		$this->assertEquals($user->getFullName(), 'Suleiman Golden');
	}

	public function testThatWeCanGetEmailAddress()
	{
		$user = new \App\Models\User;

		$user->setEmail('suleigolden@thelastcodebender.com');

		$this->assertEquals($user->getEmail(), 'suleigolden@thelastcodebender.com');
	}

	public function testThatWeCanGetFullUserDetails()
	{
		$user = new \App\Models\User;

		$user->setFirstName('Suleiman');
		$user->setLastName('Golden');
		$user->setEmail('suleigolden@thelastcodebender.com');

		$userDetails = $user->getFullDetails();

		$this->assertArrayHaskey('full_name', $userDetails);
		$this->assertArrayHaskey('email', $userDetails);

		$this->assertEquals($userDetails['full_name'], 'Suleiman Golden');
		$this->assertEquals($userDetails['email'], 'suleigolden@thelastcodebender.com');

	}
}