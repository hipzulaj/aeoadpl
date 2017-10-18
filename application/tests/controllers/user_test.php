<?php
/**
 * Part of ci-phpunit-test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */
class user_test extends TestCase
{	

	public function setUp()
    {
        $this->resetInstance();
    }

    public function test_Login_cus()
	{
		//$this->assertFalse( isset($_SESSION['customer']) );
		$this->request(
			'POST',
			'user/login',
				[
					'form-username' => 'customer',
					'form-password' => '123',
					'user' => 'Customer'
				]
		);
		$this->assertEquals('customer', $_SESSION['customer']);
	}

    public function test_Dashboard_cus()
	{
		$_SESSION['customer'] = 'customer';
		$this->request('GET', 'display/Dashboard_cus');
		//$this->assertEquals('customer', $_SESSION['customer']);
	}

	public function test_booking()
	{
		$this->request(
			'POST',
			'customer/booking',
				[
					'user' => 'customer',
					'jenis' => 'birthday',
					'name' => 'aaa',
					'biaya' => '20000'
				]
		);
	}

	public function test_cancel_booking()
	{	
		//$this->assertFalse( isset($_SESSION['eo']) );
		$this->request('GET','customer/Cancel_booking/10');
		$this->assertRedirect('display/Dashboard_cus');
	}

	public function test_Logout(){
		$_SESSION['customer'] = 'customer';
		$output = $this->request('GET', 'user/logout');
       	$this->assertContains('<title>Login &amp; Register </title>');
    }   
}