<?php
// File: models/Mahasiswa.php

abstract class Mahasiswa {
    // 2. Properti dengan hak akses protected
    protected $id_mahasiswa;
    protected $nama_mahasiswa;
    protected $nim;
    protected $semester;
    protected $tarifUktNominal;

    /**
     * 3. Constructor untuk memetakan properti dari database
     * @param array $data Baris data hasil fetch dari database (array asosiatif)
     */
    public function __construct(array $data) {
        $this->id_mahasiswa = $data['id_mahasiswa'] ?? null;
        $this->nama_mahasiswa = $data['nama_mahasiswa'] ?? '';
        $this->nim = $data['nim'] ?? '';
        $this->semester = isset($data['semester']) ? (int)$data['semester'] : 1;
        
        // Pemetaan dari kolom DB 'tarif_ukt_nominal' ke properti '$tarifUktNominal'
        $this->tarifUktNominal = isset($data['tarif_ukt_nominal']) ? (int)$data['tarif_ukt_nominal'] : 0;
    }

    /**
     * Getter Methods (Opsional namun sangat disarankan dalam OOP)
     * Karena properti bertipe protected, class luar memerlukan getter untuk membaca nilainya.
     */
    public function getIdMahasiswa() {
        return $this->id_mahasiswa;
    }

    public function getNamaMahasiswa() {
        return $this->nama_mahasiswa;
    }

    public function getNim() {
        return $this->nim;
    }

    public function getSemester() {
        return $this->semester;
    }

    public function getTarifUktNominal() {
        return $this->tarifUktNominal;
    }

    // 4. Abstract methods yang wajib diimplementasikan oleh class anak
    abstract public function hitungTagihanSemester();
    abstract public function tampilkanSpesifikasiAkademik();
}