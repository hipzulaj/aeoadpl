<?php
/**
 * Part of ci-phpunit-test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */
class login_eo_test extends TestCase
{	
	/**
     * @covers user::login
     */
	
    public function setUp()
    {
        $this->resetInstance();
    }

    public function test_login_eo()
	{
		$output = $this->request(
			'POST',
			'user/login',
				[
					'username-login' => 'eo',
					'password-login' => '123',
					'user' => 'EO'
				]
		);
		$this->assertEquals('eo', $_SESSION['eo']);
	}

	public function test_false_login_eo()
	{
		$output = $this->request(
			'POST',
			'user/login',
				[
					'username-login' => 'false',
					'password-login' => '123',
					'user' => 'EO'
				]
		);
		$this->assertContains('<title>Login &amp; Register </title>', $output);
	}

	public function test_wrong_pass_eo()
	{
		$output = $this->request(
			'POST',
			'user/login',
				[
					'username-login' => 'eo',
					'password-login' => '1',
					'user' => 'EO'
				]
		);
		$this->assertContains('<title>Login &amp; Register </title>', $output);
	}

	public function test_null_login_eo()
	{
		$output = $this->request(
			'POST',
			'user/login',
				[
					'username-login' => '',
					'password-login' => '',
					'user' => 'EO'
				]
		);
		$this->assertContains('<title>Login &amp; Register </title>', $output);
	}

	public function test_login_eo_logged()
	{
		$_SESSION['eo'] = 'eo';
		$output = $this->request('GET', 'user/login');
		$this->assertRedirect('dashboard_eo');
	}

	/**
     * @covers user::logout
     */
	public function test_eo_logout(){
		$_SESSION['eo'] = 'eo';
		$this->request('GET', 'user/logout');
		$this->assertFalse( isset($_SESSION['eo']) );
	}
}