<?php
/**
 * Part of ci-phpunit-test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class display_test extends TestCase
{

	public function setUp()
    {
        $this->resetInstance();
    }

	public function test_display_index()
	{
		$output = $this->request('GET', 'display/index');
		$this->assertContains('<title>AEO</title>', $output);
	}

	public function test_display_login()
	{
		$output = $this->request('GET', 'display/login');
		$this->assertContains('<title>Login &amp; Register </title>', $output);
	}

	public function test_display_login_mimin()
	{
		$output = $this->request('GET', 'display/login_mimin');
		$this->assertContains('<title>Admin Login Form</title>', $output);
	}

	public function test_display_categorize()
	{
		$output = $this->request('GET', 'display/categorize');
		$this->assertContains('<title>AEO</title>', $output);
	}

	public function test_login()
	{
		//$this->assertFalse( isset($_SESSION['admin']) );
		$this->request(
			'POST',
			'Mimin_perih/login',
				[
					'u' => 'admin',
					'p' => '1234',
				]
		);
		$this->assertEquals('admin', $_SESSION['admin']);
	}
/*
	public function test_display_dashboard()
	{
		$output = $this->request('GET', 'display/Dashboard');
		$this->assertContains('<title>SB Admin - Start Bootstrap Template</title>', $output);
	}
*/
	public function test_Login_eo()
	{	
		//$this->assertFalse( isset($_SESSION['eo']) );
		$this->request(
			'POST',
			'user/login',
				[
					'form-username' => 'eo',
					'form-password' => '123',
					'user' => 'EO'
				]
		);
		$this->assertEquals('eo', $_SESSION['eo']);
	}

	public function test_session_eo(){
		$_SESSION['eo'] = 'eo';
		$this->request('POST', 'user/login', '$_SESSION["eo"]');
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
		$output = $this->request('POST', 'display/Dashboard_cus');
		$this->assertEquals('customer', $_SESSION['customer']);
		//$this->assertContains('<title>Customer Profile</title>', $output);
	} 
	
	public function test_Logout(){
		$this->request('GET', 'Mimin_perih/logout');
        $this->request('GET', 'user/logout');
        //$this->assertRedirect('display/index');
        $this->assertFalse( isset($_SESSION['admin']) );
        $this->assertFalse( isset($_SESSION['eo']) );
        $this->assertFalse( isset($_SESSION['customer']) );
    }

	/*public function test_display_Dashboard_eo()
	{	
		$output = $this->request('GET', 'display/Dashboard_eo');
		$this->assertContains('<title>EO Profile </title>', $output);
	} */

	public function test_register_cus()
	{	
		$this->request(
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
		$output = $this->request('GET', 'display/index');
		$this->assertContains('Hi! testcus', $output);
	}

	public function test_register_eo()
	{	
		$this->request(
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
		$output = $this->request('GET', 'display/index');
		$this->assertContains('<title>AEO</title>', $output);
	}

	public function test_method_404()
	{
		$this->request('GET', 'welcome/method_not_exist');
		$this->assertResponseCode(404);
	}

	public function test_APPPATH()
	{
		$actual = realpath(APPPATH);
		$expected = realpath(__DIR__ . '/../..');
		$this->assertEquals(
			$expected,
			$actual,
			'Your APPPATH seems to be wrong. Check your $application_folder in tests/Bootstrap.php'
		);
	}
}
