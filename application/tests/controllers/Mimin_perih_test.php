<?php
/**
 * Part of ci-phpunit-test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */
class Mimin_perih_test extends TestCase
{	 
	/**
     * @covers Mimin_perih
     */
    public function setUp()
    {
        $this->resetInstance();
    }

    public function test_login_admin()
	{
		$output = $this->request(
			'POST',
			'/Mimin_perih/login',
				[
					'u' => 'admin',
					'p' => '1234'
				]
		);
		$this->assertEquals('admin', $_SESSION['admin']);
	}

	public function test_false_login_admin()
	{
		$output = $this->request(
			'POST',
			'Mimin_perih/login',
				[
					'u' => 'adm',
					'p' => '1'
				]
		);
		$this->assertContains('<title>Admin Login Form</title>', $output);
	}

	public function test_null_login_admin()
	{
		$output = $this->request(
			'POST',
			'/Mimin_perih/login',
				[
					'u' => '',
					'p' => ''
				]
		);
		$this->assertContains('<title>Admin Login Form</title>', $output);
	}

	public function test_login_admin_logged()
	{
		$_SESSION['admin'] = 'admin';
		$output = $this->request('GET', '/Mimin_perih/login');
		$this->assertContains('<title>SB Admin - Start Bootstrap Template</title>', $output);
	}

	public function test_logout(){
		$_SESSION['admin'] = 'admin';
		$this->request('GET', 'Mimin_perih/logout');
		$this->assertFalse( isset($_SESSION['admin']) );
	}
}