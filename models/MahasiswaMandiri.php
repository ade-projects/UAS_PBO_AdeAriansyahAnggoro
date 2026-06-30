<?php
// File: models/MahasiswaMandiri.php

require_once __DIR__ . '/Mahasiswa.php';

class MahasiswaMandiri extends Mahasiswa {
    private $golonganUkt;
    private $namaWali;

    public function __construct(array $data) {
        parent::__construct($data);
        $this->golonganUkt = isset($data['golongan_ukt']) ? (int)$data['golongan_ukt'] : null;
        $this->namaWali = $data['nama_wali'] ?? '';
    }

    public function getGolonganUkt() { return $this->golonganUkt; }
    public function getNamaWali() { return $this->namaWali; }

    public static function getAll(PDO $db) {
        $query = "SELECT * FROM tabel_mahasiswa WHERE jenis_pembiayaan = 'Mandiri'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        
        $listMahasiswa = [];
        while ($row = $stmt->fetch()) {
            $listMahasiswa[] = new self($row);
        }
        return $listMahasiswa;
    }

    /**
     * Overriding: Tagihan Mandiri = UKT + 100.000 (biaya administrasi)
     */
    public function hitungTagihanSemester() {
        return $this->tarifUktNominal + 100000;
    }

    /**
     * Overriding: Mengembalikan array of object untuk info unik Mandiri
     */
    public function tampilkanSpesifikasiAkademik() {
        return [
            (object) [
                'label' => 'Golongan UKT',
                'value' => $this->golonganUkt
            ],
            (object) [
                'label' => 'Nama Wali',
                'value' => $this->namaWali
            ]
        ];
    }
}