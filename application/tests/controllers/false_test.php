<?php
/**
 * Part of ci-phpunit-test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class false_test extends TestCase
{

	public function setUp()
    {
        $this->resetInstance();
    }

	public function test_false_login_admin()
	{
		$this->request(
			'POST',
			'/Mimin_perih/login',
				[
					'u' => 'admin',
					'p' => '12'
				]
		);
		$output = $this->request('GET', 'Mimin_perih/login');
		$this->assertContains('<title>Admin Login Form</title>', $output);
	}

	/* public function test_null_login_admin()
	{
		$this->request(
			'POST',
			'/Mimin_perih/login',
				[
					'u' => '',
					'p' => ''
				]
		);
		$output = $this->request('GET', 'Mimin_perih/login');
		$this->assertContains('<title>Admin Login Form</title>', $output);
	} */

	public function test_false_login_cus(){
		$this->request(
			'POST',
			'/user/login',
				[
					'form-username' => 'customer',
					'form-password' => '12',
					'user' => 'Customer'
				]
		);
		$output = $this->request('GET', 'user/login');
		$this->assertContains('<title>Login &amp; Register </title>', $output);
	}

		public function test_false_login_non_cus(){
		$this->request(
			'POST',
			'/user/login',
				[
					'form-username' => 'false',
					'form-password' => '123',
					'user' => 'Customer'
				]
		);
		$output = $this->request('GET', 'user/login');
		$this->assertContains('<title>Login &amp; Register </title>', $output);
	}

	public function test_false_login_eo(){
		$this->request(
			'POST',
			'/user/login',
				[
					'form-username' => 'eo',
					'form-password' => '12',
					'user' => 'EO'
				]
		);
		$output = $this->request('GET', 'user/login');
		$this->assertContains('<title>Login &amp; Register </title>', $output);
	}

	public function test_false_login_non_eo(){
		$this->request(
			'POST',
			'/user/login',
				[
					'form-username' => 'false',
					'form-password' => '123',
					'user' => 'EO'
				]
		);
		$output = $this->request('GET', 'user/login');
		$this->assertContains('<title>Login &amp; Register </title>', $output);
	}

	public function test_null_login(){
		$this->request(
			'POST',
			'/user/login',
				[
					'form-username' => '',
					'form-password' => '',
					'user' => ''
				]
		);
		$output = $this->request('GET', 'user/login');
		$this->assertContains('<title>Login &amp; Register </title>', $output);
	}

	public function test_register_null()
	{	
		$this->request(
			'POST',
			'/user/register',
				[
					'form-name' => '',
					'form-email' => '',
					'form-username' => '',
					'form-password' => '',
					'user' => 'Customer'
				]
		);
		$output = $this->request('GET', 'user/login');
		$this->assertContains('<title>Login &amp; Register </title>', $output);
	}
}
