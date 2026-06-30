<?php
// File: models/MahasiswaBidikmisi.php

require_once 'Mahasiswa.php';

class MahasiswaBidikmisi extends Mahasiswa {
    // Properti tambahan khusus Jalur Bidikmisi
    private $nomorKipKuliah;
    private $danaSakuSubsidi;

    // Constructor
    public function __construct(array $data) {
        // Memanggil constructor dari abstract class Mahasiswa
        parent::__construct($data);
        
        // Memetakan properti spesifik Bidikmisi
        $this->nomorKipKuliah = $data['nomor_kip_kuliah'] ?? '';
        $this->danaSakuSubsidi = isset($data['dana_saku_subsidi']) ? (int)$data['dana_saku_subsidi'] : 0;
    }

    // Getter untuk properti spesifik
    public function getNomorKipKuliah() { return $this->nomorKipKuliah; }
    public function getDanaSakuSubsidi() { return $this->danaSakuSubsidi; }

    /**
     * Method Khusus: Mengambil semua data mahasiswa jalur Bidikmisi
     * dan mengubahnya menjadi objek MahasiswaBidikmisi
     */
    public static function getAll(PDO $db) {
        $query = "SELECT * FROM tabel_mahasiswa WHERE jenis_pembiayaan = 'Bidikmisi'";
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
        // Logika tagihan bidikmisi nanti di sini
    }

    public function tampilkanSpesifikasiAkademik() {
        // Logika spesifikasi bidikmisi nanti di sini
    }
}