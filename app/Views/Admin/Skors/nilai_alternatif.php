<?php
// Jika data kosong 
if (empty($guru_mapel)) {
    //    echo "404";
?>
<div class="alert alert-warning mt-3 mb-3 ">
    Data Guru Belum di tentukan untuk periode yang dipilih. Hubungi admin anda untuk mengatur mata pelajaran dan guru
    yang mengajar.
</div>
<?php
} else {

?>
<div class="alert alert-info" role="alert">
    <i class="dripicons-information me-2"></i> BOBOT KRITERIA
</div>
<div class="table-responsive">
    <table class="mid table table-sm table-hover table-bordered">
        <thead class="table-light">
            <tr>
                <th>Kriteria</th>
                <?php
                // Hitung Total Bobot Kriteria
                $totalBobot = TotalBobot()->bobot;
                foreach ($kriteria as $k) {
                ?>
                <td><?= $k['kode'] ?></td>
                <?php
                    ?>
                <?php

                }
                ?>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>Bobot</th>
                <?php
        
                foreach ($kriteria as $k) {
                    $terBobot = $k['bobot'] / $totalBobot;
                ?>
                <td><?= number_format($terBobot, 2) ?></td>
                <?php
                    ?>
                <?php

                }
                ?>
            </tr>

        </tbody>
    </table>
</div>
<div class="alert alert-info" role="alert">
    <i class="dripicons-information me-2"></i> DATA NILAI ALTERNATIF (MATRIKS KEPUTUSAN)
</div>
<div class="table-responsive">
    <table class="mid table table-sm table-hover">
        <thead class="table-light">
            <tr>
                <th>No.</th>
                <th>Kode</th>
                <th>Nama</th>
                <?php
                    foreach ($kriteria as $k) {
                    ?>
                <th><?= $k['kode'] ?></th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php
                $i = 1;
                foreach ($guru_mapel as $d) {
                ?>
            <tr>
                <td><?= $i++ ?>.</td>
                <td><?= $d['kode_guru'] ?></td>
                <td><?= $d['nama'] ?></td>
                <?php
                        foreach ($kriteria as $k) {
                            $nilai = NilaiAlternatif($sekolah_id == 'all' ? 'all' : $d['sekolah_id'], $periode_id, $d['id'], $k['id']);
                        ?>
                <td>
                    <?= $nilai == NULL ? 0 : $nilai->skor ?>
                </td>
                <?php } ?>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<div class="alert alert-info" role="alert">
    <i class="dripicons-information me-2"></i> NILAI TERKECIL (MIN) DAN TERBESAR (MAX)
</div>

<div class="table-responsive">
    <table class="mid table table-sm table-bordered">
        <thead class="table-dark">
            <tr>
                <th>NILAI</th>
                <?php foreach ($kriteria as $k) : ?>
                <th><?= $k['kode'] ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="bg-warning text-white">Min</td>
                <?php foreach ($kriteria as $k) : ?>
                <?php
                        $min = NilaiMinMax($sekolah_id == 'all' ? 'all' : $d['sekolah_id'], $periode_id, $k['id'], 'min');
                        $nilaiMin = $min == NULL ? 0 : $min->skor;
                        ?>
                <td><?= $nilaiMin ?></td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <td class="bg-primary text-white">Max</td>
                <?php foreach ($kriteria as $k) : ?>
                <?php
                        $max = NilaiMinMax($sekolah_id == 'all' ? 'all' : $d['sekolah_id'], $periode_id, $k['id'], 'max');
                        $nilaiMax = $max == NULL ? 0 : $max->skor;
                        ?>
                <td><?= $nilaiMax ?></td>
                <?php endforeach; ?>
            </tr>

        </tbody>
    </table>
</div>


<!-- HASIL PERHITUNGAN NORMALISASI MATRIKS <br>
        Nilai matriks berikisar antara 0-1 -->
<div class="alert alert-info" role="alert">
    <i class="dripicons-information me-2"></i> HASIL PERHITUNGAN NORMALISASI MATRIKS
</div>

<div class="table-responsive">
    <table class="mid table table-sm table-hover table-bordered">
        <thead class="table-light">
            <tr>
                <th>No.</th>
                <th>Kode</th>
                <?php
                    foreach ($kriteria as $k) {
                    ?>
                <th><?= $k['kode'] ?></th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php
                $i = 1;
                foreach ($guru_mapel as $d) {
                ?>
            <tr>
                <td><?= $i++ ?>.</td>
                <td><?= $d['kode_guru'] ?></td>
                <?php
                        foreach ($kriteria as $k) {
                            $min = NilaiMinMax($sekolah_id == 'all' ? 'all' : $d['sekolah_id'], $periode_id, $k['id'], 'min'); // Dapatkan Nilai Min (Nilai Terkecil)
                            $max = NilaiMinMax($sekolah_id == 'all' ? 'all' : $d['sekolah_id'], $periode_id, $k['id'], 'max');
                            // Dapatkan Nilai Max (Nilai Terbesar)
                            $nilai = NilaiAlternatif($sekolah_id == 'all' ? 'all' : $d['sekolah_id'], $periode_id, $d['id'], $k['id']);
                        ?>
                <td>
                    <?php
                                $hasil_normalisasi = 0;
                                $nilai_alternatif = $nilai == NULL ? 0 : $nilai->skor;
                                $nilaiMin = $min == NULL ? 0 : $min->skor;
                                $nilaiMax = $max == NULL ? 0 : $max->skor;
                                if ($nilaiMax != $nilaiMin) {
                                    $hasil_normalisasi = ($nilai_alternatif - $nilaiMin) / ($nilaiMax - $nilaiMin);
                                } else {
                                    // Tangani kasus ketika nilaiMax->nilai sama dengan nilaiMin->nilai
                                    // Misalnya, berikan nilai default atau tampilkan pesan kesalahan
                                    $hasil_normalisasi = 0;
                                }
                                echo number_format($hasil_normalisasi, 3);
                                ?>
                </td>
                <?php } ?>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>


<!-- HASIL NILAI REFERENSI -->
<div class="alert alert-info" role="alert">
    <i class="dripicons-information me-2"></i> HASIL PERHITUNGAN NILAI PREFERENSI
</div>

<div class="table-responsive">
    <table class="mid table table-sm table-hover table-bordered">
        <thead class="table-light">
            <tr>
                <th>No.</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Referensi</th>
            </tr>
        </thead>
        <tbody>
            <?php
                // Hitung Total Bobot Kriteria
                $totalBobot = TotalBobot()->bobot;
                $i = 1;
                foreach ($guru_mapel as $d) {
                ?>
            <tr>
                <td><?= $i++ ?>.</td>
                <td><?= $d['kode_guru'] ?></td>
                <td><?= $d['nama'] ?></td>
                <td>
                    <?php
                            $hasil_normalisasi = 0;
                            $nilai_referensi = 0;
                            $hasil_referensi = 0;
                            foreach ($kriteria as $k) {
                                $min = NilaiMinMax($sekolah_id == 'all' ? 'all' : $d['sekolah_id'], $periode_id, $k['id'], 'min'); // Dapatkan Nilai Min (Nilai Terkecil)
                                $max = NilaiMinMax($sekolah_id == 'all' ? 'all' : $d['sekolah_id'], $periode_id, $k['id'], 'max'); // Dapatkan Nilai Max (Nilai Terbesar)
                                // Dapatkan Nilai setiap guru
                                $nilai = NilaiAlternatif($sekolah_id == 'all' ? 'all' : $d['sekolah_id'], $periode_id, $d['id'], $k['id']);

                                // Bagi setiap Bobot Kriteria dengan Total Bobot Kriteria 
                                $bobotKriteria = $k['bobot'] / $totalBobot;

                            ?>
                    <?php


                                $nilai_alternatif = $nilai == NULL ? 0 : $nilai->skor;
                                $nilaiMin = $min == NULL ? 0 : $min->skor;
                                $nilaiMax = $max == NULL ? 0 : $max->skor;
                                if ($nilaiMax != $nilaiMin) {
                                    $hasil_normalisasi = ($nilai_alternatif - $nilaiMin) / ($nilaiMax - $nilaiMin);
                                } else {
                                    // Tangani kasus ketika nilaiMax->nilai sama dengan nilaiMin->nilai
                                    // Misalnya, berikan nilai default atau tampilkan pesan kesalahan
                                    $hasil_normalisasi = 0;
                                }

                                $nilai_referensi = $bobotKriteria * $hasil_normalisasi;
                                $hasil_referensi = $hasil_referensi + $nilai_referensi;
                                ?>
                    <?php }

                            echo number_format($hasil_referensi, 3);

                            // Simpan nilai referensi ke dalam array
                            $nilaiReferensiArray[] = array(
                                'kode_alternatif' => $d['kode_guru'],
                                'nama_alternatif' => $d['nama'],
                                'referensi' => $hasil_referensi
                            );

                            // Urutkan array berdasarkan nilai referensi secara menurun
                            usort($nilaiReferensiArray, function ($a, $b) {
                                return $b['referensi'] <=> $a['referensi'];
                            });


                            ?>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>


<!-- Perengkingan -->
<div class="alert alert-info" role="alert">
    <i class="dripicons-information me-2"></i> PENGURURUTAN NILAI TERTINGGI-TERENDAH (PERANGKINGAN)
</div>

<table class="table table-sm table-striped table-hover">
    <thead>
        <tr class="bg-dark">
            <th scope="col">#</th>
            <th scope="col">Kode</th>
            <th scope="col">Nama Alternatif</th>
            <th scope="col">Nilai</th>
            <th scope="col">Ranking</th>
        </tr>
    </thead>
    <tbody>
        <?php
            // Tampilkan peringkat
            $no = 1;

            foreach ($nilaiReferensiArray as $ranking => $nilaiReferensi) {
                echo "<tr>";
                echo "<td>" . $no++ . ".</td>";
                echo "<td>" . $nilaiReferensi['kode_alternatif'] . "</td>";
                echo "<td>" . $nilaiReferensi['nama_alternatif'] . "</td>";
                echo "<td>" . number_format($nilaiReferensi['referensi'], 3) . "</td>";
                echo "<th scope='row'>" . ($ranking + 1) . "</th>";
                echo "</tr>";
            }
            ?>

    </tbody>
</table>
<div class="alert alert-info" role="alert">
    <i class="dripicons-information me-2"></i> INFORMASI KEPUTUSAN
</div>
<table class="table table-sm table-striped table-hover">
    <thead>
        <tr class="bg-dark">
            <th scope="col">#</th>
            <th scope="col">Kode</th>
            <th scope="col">Nama Alternatif</th>
            <th scope="col">Nilai</th>
            <th scope="col">Keputusan</th>
        </tr>
    </thead>
    <tbody>
        <?php
            // Tampilkan peringkat
            $no = 1;
            $keputusan = "";
            foreach ($nilaiReferensiArray as $ranking => $nilaiReferensi) {
                $rank = $ranking + 1;
                if ($rank < 4 && $nilaiReferensi['referensi'] > 0.70) {
                    $keputusan = "<span class='badge bg-success rounded-pil'>Diberikan Penghargaan</span>";
                } else {
                    $keputusan = "<span class='badge bg-warning rounded-pil'>Belum Mendapatkan Penghargaan</span>";
                }

                echo "<tr>";
                echo "<td>" . $no++ . ".</td>";
                echo "<td>" . $nilaiReferensi['kode_alternatif'] . "</td>";
                echo "<td>" . $nilaiReferensi['nama_alternatif'] . "</td>";
                echo "<td>" . number_format($nilaiReferensi['referensi'], 3) . "</td>";
                echo "<th scope='row'>" . $keputusan . "</th>";
                echo "</tr>";
            }
            ?>

    </tbody>
</table>
<div class="alert alert-info" role="alert">
    <i class="dripicons-information me-2"></i> KEPUTUSAN AKHIR
</div>

<table id="tabelData" class="table table-sm table-striped table-hover">
    <thead>
        <tr class="bg-dark">
            <th scope="col">#</th>
            <th scope="col">Kode</th>
            <th scope="col">Nama Alternatif</th>
            <th scope="col">Nilai</th>
            <th scope="col">Keputusan</th>
        </tr>
    </thead>
    <tbody>
        <?php
 
            // Tampilkan peringkat 1-3
            $no = 1;
            foreach ($nilaiReferensiArray as $ranking => $nilaiReferensi) {
                if ($no > 3) {
                    break; // Hentikan loop setelah mencapai peringkat 3
                }
                $keputusan = "<span class='badge bg-success rounded-pil'>Diberikan Penghargaan</span>";
                echo "<tr>";
                echo "<td>" . $no++ . ".</td>";
                echo "<td>" . $nilaiReferensi['kode_alternatif'] . "</td>";
                echo "<td>" . $nilaiReferensi['nama_alternatif'] . "</td>";
                echo "<td>" . number_format($nilaiReferensi['referensi'], 3) . "</td>";
                echo "<th scope='row'>" . $keputusan . "</th>";
                echo "</tr>";
            }
        ?>
    </tbody>
</table>

<?php
}
?>