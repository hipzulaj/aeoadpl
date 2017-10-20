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

    //Register Customer

    public function test_register_cus() //belom kelar
	{	
		$output = $this->request(
			'POST',
			'user/register',
				[
					'form-name' => 'testcus',
					'form-email' => 'testcus@gmail.com',
					'form-username' => 'testcus',
					'form-password' => '123',
					'user' => 'Customer'
				]
		);
		$this->assertContains('<title>Login &amp; Register </title>', $output);
	}

    public function test_register_cus_sv()
	{	
		$output = $this->request(
			'POST',
			'user/register',
				[
					'form-name' => 'testcus',
					'form-email' => 'testcus@gmail.com',
					'form-username' => 'testcus',
					'form-password' => '123',
					'user' => 'Customer'
				]
		);
		$this->assertContains('<title>Login &amp; Register </title>', $output);
	}

    public function test_register_cus_logged()
	{	
		$_SESSION['customer'] = 'customer';
		$this->request('GET', 'user/register');
		$this->assertRedirect('dashboard_cus');
	}

   	public function test_null_register_cus()
	{	
		$output = $this->request(
			'POST',
			'user/register',
				[
					'form-name' => '',
					'form-email' => '',
					'form-username' => '',
					'form-password' => '',
					'user' => 'Customer'
				]
		);
		$this->assertContains('<title>Login &amp; Register </title>', $output);
	}


	//Register EO
	public function test_register_eo() //belom kelar
	{	
		$output = $this->request(
			'POST',
			'user/register',
				[
					'form-name' => 'testcus',
					'form-email' => 'testcus@gmail.com',
					'form-username' => 'testcus',
					'form-password' => '123',
					'user' => 'Customer'
				]
		);
		$this->assertContains('<title>Login &amp; Register </title>', $output);
	}

	public function test_register_eo_sv()
	{	
		$output = $this->request(
			'POST',
			'user/register',
				[
					'form-name' => 'testeo',
					'form-email' => 'testeo@gmail.com',
					'form-username' => 'testeo',
					'form-password' => '123',
					'user' => 'EO'
				]
		);
		$this->assertContains('<title>Login &amp; Register </title>', $output);
	}

	public function test_register_eo_logged()
	{	
		$_SESSION['eo'] = 'eo';
		$this->request('GET', 'user/register');
		$this->assertRedirect('dashboard_eo');
	}

	public function test_null_register_eo()
	{	
		$output = $this->request(
			'POST',
			'user/register',
				[
					'form-name' => '',
					'form-email' => '',
					'form-username' => '',
					'form-password' => '',
					'user' => 'Customer'
				]
		);
		$this->assertContains('<title>Login &amp; Register </title>', $output);
	}
}