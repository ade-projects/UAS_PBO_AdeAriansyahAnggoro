<?php
// File: models/MahasiswaPrestasi.php

require_once 'Mahasiswa.php';

class MahasiswaPrestasi extends Mahasiswa {
    private $namaInstansiBeasiswa;
    private $minimalIpkSyarat;

    public function __construct(array $data) {
        parent::__construct($data);
        $this->namaInstansiBeasiswa = $data['nama_instansi_beasiswa'] ?? '';
        $this->minimalIpkSyarat = isset($data['minimal_ipk_syarat']) ? (float)$data['minimal_ipk_syarat'] : 0.0;
    }

    public function getNamaInstansiBeasiswa() { return $this->namaInstansiBeasiswa; }
    public function getMinimalIpkSyarat() { return $this->minimalIpkSyarat; }

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

    /**
     * Overriding: Tagihan Prestasi = 25% dari Tarif UKT Asli (Diskon 75%)
     */
    public function hitungTagihanSemester() {
        return $this->tarifUktNominal * 0.25;
    }

    /**
     * Overriding: Mengembalikan array of object untuk info unik Prestasi
     */
    public function tampilkanSpesifikasiAkademik() {
        return [
            (object) [
                'label' => 'Instansi Pemberi Beasiswa',
                'value' => $this->namaInstansiBeasiswa
            ],
            (object) [
                'label' => 'Minimal IPK Syarat',
                'value' => number_format($this->minimalIpkSyarat, 2)
            ]
        ];
    }
}