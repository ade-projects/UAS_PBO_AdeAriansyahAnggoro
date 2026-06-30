<?php
// File: models/MahasiswaPrestasi.php

require_once 'Mahasiswa.php';

class MahasiswaPrestasi extends Mahasiswa {
    // Properti tambahan khusus Jalur Prestasi
    private $namaInstansiBeasiswa;
    private $minimalIpkSyarat;

    // Constructor
    public function __construct(array $data) {
        // Memanggil constructor dari abstract class Mahasiswa
        parent::__construct($data);
        
        // Memetakan properti spesifik Prestasi
        $this->namaInstansiBeasiswa = $data['nama_instansi_beasiswa'] ?? '';
        $this->minimalIpkSyarat = isset($data['minimal_ipk_syarat']) ? (float)$data['minimal_ipk_syarat'] : 0.0;
    }

    // Getter untuk properti spesifik
    public function getNamaInstansiBeasiswa() { return $this->namaInstansiBeasiswa; }
    public function getMinimalIpkSyarat() { return $this->minimalIpkSyarat; }

    /**
     * Method Khusus: Mengambil semua data mahasiswa jalur Prestasi
     * dan mengubahnya menjadi objek MahasiswaPrestasi
     */
    public static function getAll(PDO $db) {
        $query = "SELECT * FROM tabel_mahasiswa WHERE jenis_pembiayaan = 'Prestasi'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        
        $listMahasiswa = [];
        while ($row = $stmt->fetch()) {
            $listMahasiswa[] = new self($row);
        }
        return $listMahasiswa;
    }

    // Tahan dulu: Implementasi abstract method kosong (wajib ada di PHP)
    public function hitungTagihanSemester() {
        // Logika tagihan prestasi nanti di sini
    }

    public function tampilkanSpesifikasiAkademik() {
        // Logika spesifikasi prestasi nanti di sini
    }
}