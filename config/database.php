<?php
// File: config/database.php

class Database {
    private $host = "localhost";
    private $db_name = "DB_UAS_PBO_TRPL1B_AdeAriansyahAnggoro";
    private $username = "dev"; // Sesuaikan dengan konfigurasi MySQL kamu
    private $password = "dev";     // Sesuaikan dengan konfigurasi MySQL kamu
    private $conn;

    /**
     * Method untuk mendapatkan koneksi database menggunakan PDO
     * @return PDO|null
     */
    public function getConnection() {
        $this->conn = null;

        try {
            // Data Source Name (DSN)
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8mb4";
            
            // Konfigurasi tambahan untuk PDO
            $options = [
                // Mengubah error handling PDO menjadi Exception agar bisa ditangkap oleh catch
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                // Mengubah fetch mode default menjadi Array Asosiatif
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                // Menonaktifkan emulasi prepared statements untuk keamanan dari SQL Injection
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            // Instansiasi objek PDO
            $this->conn = new PDO($dsn, $this->username, $this->password, $options);
            
        } catch (PDOException $exception) {
            // Jika koneksi gagal, tangkap exception dan hentikan program dengan pesan error
            die("Koneksi ke database gagal: " . $exception->getMessage());
        }

        return $this->conn;
    }
}