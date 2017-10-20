<?php
/**
 * Part of ci-phpunit-test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class welcome_test extends TestCase
{

	public function setUp(){

        $this->resetInstance();
    }

	public function test_display_index(){

		$output = $this->request('GET', 'display/index');
		$this->assertContains('<title>AEO</title>', $output);
	}

	public function test_display_login(){

		$output = $this->request('GET', 'display/login');
		$this->assertContains('<title>Login &amp; Register </title>', $output);
	}

	public function test_display_login_mimin(){

		$output = $this->request('GET', 'display/login_mimin');
		$this->assertContains('<title>Admin Login Form</title>', $output);
	}

	public function test_display_login_mimin_login(){

		$output = $this->request('GET', 'display/login_mimin');
		$this->assertContains('<title>Admin Login Form</title>', $output);
	}

	public function test_display_categorize(){

		$output = $this->request('GET', 'display/categorize');
		$this->assertContains('<title>AEO</title>', $output);
	}

    public function test_display_Tambah_produk(){	

		$_SESSION['eo'] = 'eo';
		$output = $this->request('GET', 'eo/Tambah_produk_form');
		$this->assertContains('<title>eo Profile </title>', $output);
	}

	 /**
     * @covers eo::Tambah_produk_form
     */
	public function test_display_Tambah_produk_nologin(){
		$output = $this->request('GET', 'eo/Tambah_produk_form');
		$this->assertRedirect('display/login');
	}

	public function test_display_Dashboard_cus(){

		$_SESSION['customer'] = 'customer';
		$output = $this->request('GET', 'display/Dashboard_cus');
		$this->assertContains('<title>Customer Profile</title>', $output);
	}

	public function test_display_Dashboard_cus_nologin(){

		$output = $this->request('GET', 'display/Dashboard_cus');
		$this->assertRedirect('user/login');
	}

    public function test_display_Dashboard_eo(){

		$_SESSION['eo'] = 'eo';
		$output = $this->request('GET', 'display/Dashboard_eo');
		$this->assertContains('<i class="fa fa-fw fa-dashboard"></i>', $output);
	}

	public function test_display_Dashboard_eo_nologin(){

		$output = $this->request('GET', 'display/Dashboard_eo');
		$this->assertRedirect('user/login');
	}

	public function test_display_dashboard(){

		$_SESSION['admin'] = 'admin';
		$output = $this->request('GET', 'display/Dashboard');
		$this->assertContains('<title>SB Admin - Start Bootstrap Template</title>', $output);
	}

	public function test_display_dashboard_nologin(){

		$output = $this->request('GET', 'display/Dashboard');
		$this->assertContains('<title>Admin Login Form</title>', $output);
	}

	// public function test_Logout(){
	// 	$_SESSION['admin'] = 'admin';
	// 	$this->assertEquals('admin', $_SESSION['admin']);
	// 	$output = $this->request('GET', 'Mimin_perih/logout');
 //       	$this->assertContains('<title>Admin Login Form</title>', $output);
 //   }

	// public function test_register_eo()
	// {	
	// 	$this->request(
	// 		'POST',
	// 		'user/register',
	// 			[
	// 				'form-name' => 'testeo',
	// 				'form-email' => 'testeo@gmail.com',
	// 				'form-username' => 'testeo',
	// 				'form-password' => '123',
	// 				'user' => 'EO'
	// 			]
	// 	);
	// 	$output = $this->request('GET', 'display/index');
	// 	$this->assertContains('<title>AEO</title>', $output);
	// }

	// public function test_register_eo_same()
	// {	
	// 	$this->request(
	// 		'POST',
	// 		'user/register',
	// 			[
	// 				'form-name' => 'testeo',
	// 				'form-email' => 'testeo@gmail.com',
	// 				'form-username' => 'testeo',
	// 				'form-password' => '123',
	// 				'user' => 'EO'
	// 			]
	// 	);
	// 	$output = $this->request('GET', 'display/index');
	// 	$this->assertContains('<title>AEO</title>', $output);
	// }

	// public function test_method_404()
	// {
	// 	$this->request('GET', 'welcome/method_not_exist');
	// 	$this->assertResponseCode(404);
	// }

	// public function test_APPPATH()
	// {
	// 	$actual = realpath(APPPATH);
	// 	$expected = realpath(__DIR__ . '/../..');
	// 	$this->assertEquals(
	// 		$expected,
	// 		$actual,
	// 		'Your APPPATH seems to be wrong. Check your $application_folder in tests/Bootstrap.php'
	// 	);
	// }
}