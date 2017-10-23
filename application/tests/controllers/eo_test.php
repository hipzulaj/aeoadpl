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
        $this->CI->load->model('Model_products');
        $this->CI->Model_products->reset_auto_increment_products();
    }

    //Test Display Dashboard EO
    public function test_transaksi_booking(){
        $_SESSION['eo'] = 'eo';
        $output = $this->request('GET', 'eo/Transaksi_booking');
        $this->assertContains('<td>customer</td>
', $output);
    }

    /**
     * @covers eo::Transaksi_booking
     */
    public function test_transaksi_booking_nologged(){
        $output = $this->request('GET', 'eo/Transaksi_booking');
        $this->assertRedirect('display/login', $output);
    }
    //End of Test Display Dashboard EO


    //Test Tambah_produk
    public function test_tambah_produk(){
        $_SESSION['eo'] = 'eo';
        $expectedGet = $this->CI->Model_products->testing_purpose()+1;
        $output = $this->request('POST', 'eo/Tambah_produk',
            [
                'nama' => 'Testing Purpose 2',
                'harga' => '2',
                'deskripsi' => 'AH AH AH',
                'jenis' => 'Birthday'
            ]);
        $actualGet = $this->CI->Model_products->testing_purpose();
        $this->assertEquals($expectedGet, $actualGet);
        $this->CI->Model_products->testing_reset_purpose_oppose_add_products(6);
    }

    public function test_tambah_produk_null(){
        $_SESSION['eo'] = 'eo';
        $output = $this->request('POST', 'eo/Tambah_produk',
            [
                'nama' => '',
                'harga' => '',
                'deskripsi' => '',
                'jenis' => ''
            ]);
        $this->assertContains('<title>eo Profile </title>', $output);
    }

    public function test_tambah_produk_no_logged(){
        $this->request('GET', 'eo/Tambah_produk');
        $this->assertRedirect('display/login');
    }
    //End of Test Tambah_produk


    //Test Edit Produk
    public function test_edit_produk(){
        $_SESSION['eo'] = 'eo';
        $output = $this->request('POST', 'eo/Edit_produk/4',
            [
                'nama' => 'Testing Edit Purpose',
                'harga' => '1',
                'deskripsi' => 'APAAN DAH',
                'jenis' => 'Wedding'
            ]);
        $updated = $this->CI->Model_products->find(4);
        $actual1 = $updated->nama_produk;
        $actual2 = $updated->deskripsi;

        $this->assertEquals('Testing Edit Purpose', $actual1);
        $this->assertEquals('APAAN DAH', $actual2);
        $this->CI->Model_products->testing_reset_purpose_oppose_edit(4);
    }

    public function test_Edit_product_wrong_id(){
        $_SESSION['eo'] = 'eo';
        $output = $this->request('GET', 'eo/Edit_produk/999');
        $this->assertResponseCode(404);
    }

    public function test_edit_produk_null(){
        $_SESSION['eo'] = 'eo';
        $output = $this->request('POST', 'eo/Edit_produk/5',
            [
                'nama' => '',
                'harga' => '',
                'deskripsi' => '',
                'jenis' => ''
            ]);
        $this->assertContains('<title>eo Profile </title>', $output);
    }

    public function test_edit_produk_no_logged(){
        $this->request('GET', 'eo/Edit_produk/5');
        $this->assertRedirect('display/login');
    }
    //End of Test Edit Produk


    //Test Delete Produk

    public function test_Delete_produk(){
        $_SESSION['eo'] = 'eo';
        $expectedGet = $this->CI->Model_products->testing_purpose()-1;

        $output = $this->request('GET', 'eo/Hapus_produk/5');

        $actualGet = $this->CI->Model_products->testing_purpose();
        $this->assertEquals($expectedGet, $actualGet);

        $actualFind = $this->CI->Model_products->testing_purpose_find(5);
        $expectedFind = 0;
        $this->assertEquals($expectedFind, $actualFind);

        $this->CI->Model_products->testing_reset_purpose_oppose_delete(5);
    }

    public function test_Delete_produk_wrong_id(){
        $_SESSION['eo'] = 'eo';
        $output = $this->request('GET', 'eo/Hapus_produk/999');
        $this->assertResponseCode(404);
    }
    public function test_Delete_produk_no_logged(){
        $this->request('GET', 'eo/Hapus_produk/7');
        $this->assertRedirect('display/login');
    }

    //End of Test Delete Produk
}