<?php
/**
 * Part of ci-phpunit-test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */
class eo_test extends TestCase
{	
    
    public function setUp()
    {
        $this->resetInstance();
    }

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

    public function test_display_Dashboard_eo()
	{	
		//$_SESSION['eo'] = 'eo';
		$output = $this->request('GET', 'display/Dashboard_eo');
		//$this->assertEquals('eo', $_SESSION['eo']);
	}

	public function test_form_tambah_produk()
	{
		$this->request('GET', 'eo/Tambah_produk_form');
	}

	public function test_transaksi_booking()
	{
		$this->request('GET', 'eo/Transaksi_booking');
	}

	public function test_tambah_produk()
	{	
		//$this->assertFalse( isset($_SESSION['eo']) );
		$this->request(
			'POST',
			'eo/Tambah_produk',
				[
					'nama' => 'Ayam Goyeng',
					'harga' => '123',
					'deskripsi' => 'Suharti',
					'jenis' => 'Wedding'
				]
		);
		//$this->assertEquals('eo', $_SESSION['eo']);
	}

	public function test_edit_produk()
	{	
		//$this->assertFalse( isset($_SESSION['eo']) );
		$this->request(
			'POST',
			'eo/Edit_produk/3',
				[
					'nama' => 'Ayam Goyeng',
					'harga' => '123',
					'deskripsi' => 'Sukinem',
					'jenis' => 'Wedding'
				]
		);
		//$this->assertEquals('eo', $_SESSION['eo']);
	}

	public function test_delete_produk()
	{	
		//$this->assertFalse( isset($_SESSION['eo']) );
		$this->request(
			'POST',
			'eo/Hapus_produk',
				[
					'nama' => 'Ayam Goyeng',
					'harga' => '123',
					'deskripsi' => 'Suharti',
					'jenis' => 'Wedding'
				]
		);
		//$this->assertEquals('eo', $_SESSION['eo']);
	}

	public function test_Logout(){
		$_SESSION['eo'] = 'eo';
        $output = $this->request('GET', 'user/logout');
       	$this->assertContains('<title>Login &amp; Register </title>');
    }
}