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
        public function test_display_Tambah_produk_form()
	{
		$output = $this->request('GET', 'eo/Tambah_produk_form');
		$this->assertContains('<title>Tambah_produk_form </title>', $output);
	}
        
        
         public function test_display_Transaksi_booking()
	{
		$output = $this->request('GET', 'eo/Transaksi_booking');
		$this->assertContains('<a href="#">Third Level Item</a>', $output);
	}
         public function test_display_Tambah_produk()
	{
		$output = $this->request('GET', 'eo/Tambah_produk');
		$this->assertContains('<a href="cards.html">Cards</a>', $output);
	}
         public function test_display_Edit_produk()
	{
		$output = $this->request('GET', 'eo/Edit_produk');
		$this->assertContains('<a href="navbar.html">Navbar</a>', $output);
	}
//         public function test_display_Tambah_produk1()
//	{
//		$output = $this->request('GET', 'eo/Tambah_produk');
//		$this->assertContains('<li class="breadcrumb-item active">List Produk</li>', $output);
//	}
         public function test_display_register()
	{
		$output = $this->request('GET', 'user/register');
		$this->assertContains('<label class="sr-only" for="form-password">Password</label>', $output);
	}
         public function test_display_register1()
	{
		$output = $this->request('GET', 'user/register');
		$this->assertContains('<label class="sr-only" for="form-username">Username</label>', $output);
	}
        public function test_display_Dashboard_cus()
	{
		$output = $this->request('GET', 'display/Dashboard_cus');
		$this->assertContains('<span class="nav-link-text">Charts</span>', $output);
	}
        public function test_display_Dashboard_eo()
	{
		$output = $this->request('GET', 'display/Dashboard_eo');
		$this->assertContains('<i class="fa fa-fw fa-dashboard"></i>', $output);
	}
  
         

        
        
//	public function test_login()
//	{
//		//$this->assertFalse( isset($_SESSION['admin']) );
//		$this->request(
//			'POST',
//			'Mimin_perih/login',
//				[
//					'u' => 'admin',
//					'p' => '1234',
//				]
//		);
//		$this->assertEquals('admin', $_SESSION['admin']);
//	}

	public function test_display_dashboard()
	{
		$this->request('GET', 'display/Dashboard');
		//$this->assertEquals('<title>SB Admin - Start Bootstrap Template</title>', $output);
	}
	
//	public function test_Logout(){
//		$_SESSION['admin'] = 'admin';
//		$this->assertEquals('admin', $_SESSION['admin']);
//		$this->request('GET', 'Mimin_perih/logout');
//        $this->assertNull( $_SESSION['admin'] );
//    }

//	public function test_register_cus()
//	{	
//		$this->request(
//			'POST',
//			'user/register',
//				[
//					'form-name' => 'testcus',
//					'form-email' => 'testcus@gmail.com',
//					'form-username' => 'testcus',
//					'form-password' => '123',
//					'user' => 'Customer'
//				]
//		);
//		$output = $this->request('GET', 'display/index');
//		$this->assertContains('Hi! testcus', $output);
//	}

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
