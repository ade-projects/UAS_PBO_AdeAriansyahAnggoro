<?php
// File: models/MahasiswaMandiri.php

require_once 'Mahasiswa.php';

class MahasiswaMandiri extends Mahasiswa {
    // Properti tambahan khusus Jalur Mandiri
    private $golonganUkt;
    private $namaWali;

    // Constructor
    public function __construct(array $data) {
        // Memanggil constructor dari abstract class Mahasiswa
        parent::__construct($data);
        
        // Memetakan properti spesifik Mandiri
        $this->golonganUkt = isset($data['golongan_ukt']) ? (int)$data['golongan_ukt'] : null;
        $this->namaWali = $data['nama_wali'] ?? '';
    }

    // Getter untuk properti spesifik
    public function getGolonganUkt() { return $this->golonganUkt; }
    public function getNamaWali() { return $this->namaWali; }

    /**
     * Method Khusus: Mengambil semua data mahasiswa jalur Mandiri
     * dan mengubahnya menjadi objek MahasiswaMandiri
     */
    public static function getAll(PDO $db) {
        $query = "SELECT * FROM tabel_mahasiswa WHERE jenis_pembiayaan = 'Mandiri'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        
        $listMahasiswa = [];
        while ($row = $stmt->fetch()) {
            $listMahasiswa[] = new self($row); // self merujuk ke MahasiswaMandiri
        }
        return $listMahasiswa;
    }

    // Tahan dulu: Implementasi abstract method kosong (wajib ada di PHP)
    public function hitungTagihanSemester() {
        // Logika tagihan mandiri nanti di sini
    }

    public function tampilkanSpesifikasiAkademik() {
        // Logika spesifikasi mandiri nanti di sini
    }
}