<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Konfirmasi extends CI_Controller
{
    public $uri;
    function index()
    {
        $this->load->helper('encryption'); // Pastikan helper dimuat
        $key = "wisdilindonesia24";
        $plaintext = "Oktadha Nurdiansya/Kota Bandar Lampung/oktadha01@gmail.com/085741234567";
        $encrypted = encrypt_data($plaintext, $key);

        echo "URL: http://localhost/mitra_wisdil/konfirmasi/akun/" . $encrypted;
    }
    public function akun()
    {
        $this->load->helper('encryption'); // Pastikan helper dimuat

        $key = "wisdilindonesia24";
        $ciphertext = $this->uri->segment(3); // Ambil dari URL

        echo "Data terenkripsi: " . $ciphertext . "<br>";

        $decrypted_data = decrypt_data($ciphertext, $key);
        echo "Data terdekripsi: " . ($decrypted_data ? $decrypted_data : "Gagal") . "<br>";

        if ($decrypted_data) {
            list($nama, $kota, $email, $kontak) = explode("/", $decrypted_data);

            echo "Nama: " . htmlspecialchars($nama) . "<br>";
            echo "Kota: " . htmlspecialchars($kota) . "<br>";
            echo "Email: " . htmlspecialchars($email) . "<br>";
            echo "Kontak: " . htmlspecialchars($kontak) . "<br>";
        } else {
            echo "Gagal mendekripsi data.";
        }
    }
}
