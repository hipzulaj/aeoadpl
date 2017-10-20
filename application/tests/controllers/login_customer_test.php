<?php
/**
 * Part of ci-phpunit-test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */
class login_customer_test extends TestCase
{	
	/**
     * @covers user::login
     */
	
	public function setUp()
    {
        $this->resetInstance();
    }

    public function test_login_customer()
	{
		$output = $this->request(
			'POST',
			'user/login',
				[
					'username-login' => 'customer',
					'password-login' => '123',
					'user' => 'Customer'
				]
		);
		$this->assertEquals('customer', $_SESSION['customer']);
	}

	public function test_false_login_cus()
	{
		$output = $this->request(
			'POST',
			'user/login',
				[
					'username-login' => 'false',
					'password-login' => '123',
					'user' => 'Customer'
				]
		);
		$this->assertContains('<title>Login &amp; Register </title>', $output);
	}

	public function test_wrong_pass_cus()
	{
		$output = $this->request(
			'POST',
			'user/login',
				[
					'username-login' => 'customer',
					'password-login' => '12',
					'user' => 'Customer'
				]
		);
		$this->assertContains('<title>Login &amp; Register </title>', $output);
	}

	public function test_null_login_cus()
	{
		$output = $this->request(
			'POST',
			'user/login',
				[
					'username-login' => '',
					'password-login' => '',
					'user' => 'Customer'
				]
		);
		$this->assertContains('<title>Login &amp; Register </title>', $output);
	}

	public function test_login_cus_logged()
	{
		$_SESSION['customer'] = 'customer';
		$output = $this->request('GET', 'user/login');
		$this->assertRedirect('dashboard_cus');
	}

	/**
     * @covers user::logout
     */
	public function test_customer_logout(){
		$_SESSION['customer'] = 'customer';
		$this->request('GET', 'user/logout');
		$this->assertFalse( isset($_SESSION['customer']) );
	}
}