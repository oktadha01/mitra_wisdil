<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Base64 Encoding yang Aman untuk URL (tanpa padding)
 */
function base64_urlsafe_encode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

/**
 * Base64 Decoding yang Aman untuk URL
 */
function base64_urlsafe_decode($data) {
    $data = strtr($data, '-_', '+/');
    $padding = strlen($data) % 4;
    if ($padding) {
        $data .= str_repeat('=', 4 - $padding);
    }
    return base64_decode($data);
}

/**
 * Fungsi untuk mengenkripsi data menggunakan AES-128-CBC (lebih pendek)
 */
function encrypt_data($plaintext, $key) {
    $key = substr(hash('sha256', $key, true), 0, 16); // Pakai 128-bit key
    $iv_length = openssl_cipher_iv_length('aes-128-cbc');
    $iv = openssl_random_pseudo_bytes($iv_length);
    
    $compressed_text = gzcompress($plaintext); // Kompres teks agar lebih pendek
    $ciphertext = openssl_encrypt($compressed_text, 'aes-128-cbc', $key, 0, $iv);

    return base64_urlsafe_encode($iv . $ciphertext);
}

/**
 * Fungsi untuk mendekripsi data
 */
function decrypt_data($ciphertext, $key) {
    $key = substr(hash('sha256', $key, true), 0, 16);
    $data = base64_urlsafe_decode($ciphertext);
    
    if ($data === false) {
        return false;
    }

    $iv_length = openssl_cipher_iv_length('aes-128-cbc');
    if (strlen($data) < $iv_length) {
        return false;
    }

    $iv = substr($data, 0, $iv_length);
    $ciphertext = substr($data, $iv_length);

    $decrypted = openssl_decrypt($ciphertext, 'aes-128-cbc', $key, 0, $iv);
    
    return $decrypted ? gzuncompress($decrypted) : false;
}
?>
