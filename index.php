<?php
// File: index.php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// 1. Import seluruh file yang dibutuhkan
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/models/MahasiswaMandiri.php';
require_once __DIR__ . '/models/MahasiswaBidikmisi.php';
require_once __DIR__ . '/models/MahasiswaPrestasi.php';

// 2. Inisialisasi Koneksi Database
$database = new Database();
$db = $database->getConnection();

// 3. Logika Filter Dropdown menggunakan IF-ELSE
$filter = isset($_GET['jenis']) ? $_GET['jenis'] : 'Semua';
$listMahasiswa = [];

if ($filter === 'Mandiri') {
    $listMahasiswa = MahasiswaMandiri::getAll($db);
} elseif ($filter === 'Bidikmisi') {
    $listMahasiswa = MahasiswaBidikmisi::getAll($db);
} elseif ($filter === 'Prestasi') {
    $listMahasiswa = MahasiswaPrestasi::getAll($db);
} else {
    // Default: Menampilkan seluruh data dengan menggabungkan semua class
    $listMahasiswa = array_merge(
        MahasiswaMandiri::getAll($db),
        MahasiswaBidikmisi::getAll($db),
        MahasiswaPrestasi::getAll($db)
    );
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pembayaran Biaya Perguruan Tinggi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7fe;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .navbar-custom {
            background-color: #0d6efd;
        }
        .card-custom {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(13, 110, 253, 0.05);
        }
        .table-header-custom {
            background-color: #0d6efd !important;
            color: white !important;
        }
        .badge-mandiri { background-color: #0d6efd; }
        .badge-bidikmisi { background-color: #198754; }
        .badge-prestasi { background-color: #0dcaf0; color: #000; }
    </style>
</head>
<body>

    <nav class="navbar navbar-dark navbar-custom shadow-sm mb-5">
        <div class="container">
            <span class="navbar-brand mb-0 h1">
                <i class="bi bi-wallet2 me-2"></i> EduPay Portal
            </span>
        </div>
    </nav>

    <div class="container">
        <div class="card card-custom bg-white p-4 mb-4">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h4 class="text-primary fw-bold mb-1">Daftar Tagihan Mahasiswa</h4>
                    <p class="text-muted small mb-md-0">Manajemen verifikasi pembayaran UKT dan Beasiswa</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <form action="" method="GET" class="d-inline-block text-start">
                        <label for="jenis" class="form-label small fw-bold text-secondary">Filter Jenis Pembiayaan:</label>
                        <div class="input-group">
                            <select name="jenis" id="jenis" class="form-select border-primary" style="min-width: 200px;">
                                <option value="Semua" <?= $filter === 'Semua' ? 'selected' : '' ?>>Semua Jalur</option>
                                <option value="Mandiri" <?= $filter === 'Mandiri' ? 'selected' : '' ?>>Mandiri</option>
                                <option value="Bidikmisi" <?= $filter === 'Bidikmisi' ? 'selected' : '' ?>>Bidikmisi</option>
                                <option value="Prestasi" <?= $filter === 'Prestasi' ? 'selected' : '' ?>>Prestasi</option>
                            </select>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-filter"></i> Filter
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card card-custom bg-white overflow-hidden mb-5">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-header-custom text-nowrap">
                        <tr>
                            <th scope="col" class="ps-4">No</th>
                            <th scope="col">NIM</th>
                            <th scope="col">Nama Mahasiswa</th>
                            <th scope="col" class="text-center">Sem.</th>
                            <th scope="col">Jalur Pembiayaan</th>
                            <th scope="col" class="text-end">Tarif UKT Asli</th>
                            <th scope="col" class="text-end">Total Tagihan</th>
                            <th scope="col" class="ps-4">Detail Spesifik (Info Unik)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($listMahasiswa)): ?>
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">
                                    <i class="bi bi-folder-x display-4 d-block mb-3 text-secondary"></i>
                                    Tidak ada data mahasiswa ditemukan.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php 
                            $no = 1; 
                            foreach ($listMahasiswa as $mhs): 
                                // Menentukan kelas badge warna berdasarkan tipe class object-nya
                                $badgeClass = 'badge-mandiri';
                                $jenisTeks = 'Mandiri';
                                
                                if ($mhs instanceof MahasiswaBidikmisi) {
                                    $badgeClass = 'badge-bidikmisi';
                                    $jenisTeks = 'Bidikmisi';
                                } elseif ($mhs instanceof MahasiswaPrestasi) {
                                    $badgeClass = 'badge-prestasi';
                                    $jenisTeks = 'Prestasi';
                                }
                            ?>
                                <tr>
                                    <td class="ps-4 fw-bold text-secondary"><?= $no++; ?></td>
                                    <td class="fw-semibold text-dark"><?= htmlspecialchars($mhs->getNim()); ?></td>
                                    <td><?= htmlspecialchars($mhs->getNamaMahasiswa()); ?></td>
                                    <td class="text-center"><span class="badge bg-light text-dark border"><?= $mhs->getSemester(); ?></span></td>
                                    <td>
                                        <span class="badge <?= $badgeClass ?> px-3 py-2 rounded-pill shadow-sm small">
                                            <?= $jenisTeks; ?>
                                        </span>
                                    </td>
                                    <td class="text-end text-secondary">
                                        Rp <?= number_format($mhs->getTarifUktNominal(), 0, ',', '.'); ?>
                                    </td>
                                    <td class="text-end fw-bold text-primary">
                                        Rp <?= number_format($mhs->hitungTagihanSemester(), 0, ',', '.'); ?>
                                    </td>
                                    <td class="ps-4 py-3">
                                        <div class="d-flex flex-column gap-1">
                                            <?php 
                                            // Memanfaatkan Polimorfisme Array of Object info unik
                                            foreach ($mhs->tampilkanSpesifikasiAkademik() as $info): 
                                            ?>
                                                <small class="text-dark">
                                                    <span class="text-muted fw-semibold"><?= htmlspecialchars($info->label); ?>:</span> 
                                                    <?= htmlspecialchars($info->value); ?>
                                                </small>
                                            <?php endforeach; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>