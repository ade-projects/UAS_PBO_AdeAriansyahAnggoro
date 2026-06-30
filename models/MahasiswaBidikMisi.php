<?php
// File: models/MahasiswaBidikmisi.php

require_once 'Mahasiswa.php';

class MahasiswaBidikmisi extends Mahasiswa {
    private $nomorKipKuliah;
    private $danaSakuSubsidi;

    public function __construct(array $data) {
        parent::__construct($data);
        $this->nomorKipKuliah = $data['nomor_kip_kuliah'] ?? '';
        $this->danaSakuSubsidi = isset($data['dana_saku_subsidi']) ? (int)$data['dana_saku_subsidi'] : 0;
    }

    public function getNomorKipKuliah() { return $this->nomorKipKuliah; }
    public function getDanaSakuSubsidi() { return $this->danaSakuSubsidi; }

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

    /**
     * Overriding: Tagihan Bidikmisi = 0 (Full Subsidi)
     */
    public function hitungTagihanSemester() {
        return 0;
    }

    /**
     * Overriding: Mengembalikan array of object untuk info unik Bidikmisi
     */
    public function tampilkanSpesifikasiAkademik() {
        return [
            (object) [
                'label' => 'Nomor KIP Kuliah',
                'value' => $this->nomorKipKuliah
            ],
            (object) [
                'label' => 'Dana Saku Subsidi',
                'value' => 'Rp ' . number_format($this->danaSakuSubsidi, 0, ',', '.')
            ]
        ];
    }
}