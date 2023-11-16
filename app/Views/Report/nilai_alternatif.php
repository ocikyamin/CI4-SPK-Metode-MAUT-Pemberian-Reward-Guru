<?php
// var_dump($periode_id);
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
    // var_dump($guru_mapel);
?>
<style>
body {
    font-family: "Nunito", sans-serif;

}

.center {
    text-align: center;
}

table {
    font-size: 12px;
}
</style>
<title>Laporan Penilaian Kinerja Guru</title>
<!-- kop  -->
<table width="100%" style="border-bottom: 3px double;">
    <tr>
        <td align="center">

            <div>
                <img src="<?= base_url('public/mtic.webp') ?>" alt="Logo" width="80">
            </div>

            <b style="font-family:Bodoni MT Black;font-size:25px;font-weight: bold;clear: both;">PONDOK
                PESANTREN</b>
            <br>
            <span style="font-family:Book Antiqua;font-size:22px;">MADRASAH TARBIYAH ISLAMIYAH CANDUANG</span>
            <br>
            <p style="font-size:8px;line-height: 10px;padding:0px;margin:0px">
                <em>Alamat : Jln. Syekh Sulaiman Arrasuli, Pakan Kamis, Lubuak Aua, Kenagarian Canduang Koto Laweh,
                    Kecamatan Canduang, Kabupaten Agam, Sumatera Barat, 26192, <br>
                    Telp (0752) 28115, Fax. (0752) 426758, email: <a href="#">mticanduang@gmail.com</a> website :
                    www.mticanduang.sch.id</em>
            </p>
        </td>
    </tr>
</table>


<center>
    <h3>HASIL PENILAIAN KINERJA GURU <?=strtoupper($sekolah['nama_sekolah'])?> <br>
        (<?=strtoupper($periode['periode'])?>) TP. <?=$periode['tahun_akademik']?>


    </h3>
</center>

<p>
    <b>BOBOT KRITERIA</b>
</p>
<table border="1" width="100%" style="border-collapse:collapse">
    <thead class="table-light">
        <tr>
            <th class="center">No.</th>
            <th class="center">Kode</th>
            <th>Kriteria</th>
            <th>Bobot</th>
            <th>NB</th>

        </tr>
    </thead>
    <tbody>
        <?php
// Hitung Total Bobot Kriteria
$totalBobot = TotalBobot()->bobot;
$no =1;
$b = 0;
$nb=0;
foreach ($kriteria as $k) {
    $NB = $k['bobot'] / $totalBobot;
?>
        <tr>
            <td class="center"><?=$no++?></td>
            <td class="center"><?= $k['kode'] ?></td>
            <td><?= $k['kriteria'] ?></td>
            <td class="center"><?= $k['bobot'] ?></td>
            <td class="center"><?= number_format($NB, 2) ?></td>
        </tr>
        <?php
        $b += $k['bobot'];
        $nb  +=$NB;
}
?>
    </tbody>
    <tr>
        <td colspan="3" class="center">Jumlah </td>
        <td class="center"><?=$b?></td>
        <td class="center"><?=number_format($NB,1)?></td>
    </tr>
</table>
<p>
    <b>
        DATA NILAI ALTERNATIF (MATRIKS KEPUTUSAN)
    </b>
</p>
<table border="1" width="100%" style="border-collapse:collapse">
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
            <td class="center">
                <?= $nilai == NULL ? 0 : $nilai->skor ?>
            </td>
            <?php } ?>
        </tr>
        <?php } ?>
    </tbody>
</table>

<p>
    <b> NILAI TERKECIL (MIN) DAN TERBESAR (MAX)</b>
</p>
<table border="1" width="100%" style="border-collapse:collapse">
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
            <td class="center"><?= $nilaiMin ?></td>
            <?php endforeach; ?>
        </tr>
        <tr>
            <td class="bg-primary text-white">Max</td>
            <?php foreach ($kriteria as $k) : ?>
            <?php
                        $max = NilaiMinMax($sekolah_id == 'all' ? 'all' : $d['sekolah_id'], $periode_id, $k['id'], 'max');
                        $nilaiMax = $max == NULL ? 0 : $max->skor;
                        ?>
            <td class="center"><?= $nilaiMax ?></td>
            <?php endforeach; ?>
        </tr>

    </tbody>
</table>


<!-- HASIL NILAI REFERENSI -->
<p>
    <b> HASIL PERHITUNGAN NILAI PREFERENSI</b>
</p>
<table border="1" width="100%" style="border-collapse:collapse">
    <thead class="table-light">
        <tr>
            <th>No.</th>
            <th>Kode</th>
            <th>Nama</th>
            <th class="center">Hasil</th>
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
            <td class="center">
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

                                // Hasil BobotKriteria 
                                // C1	C2	C3	C4	C5	C6	C7	C8
                                // 0.05	0.2	0.15	0.2	0.1	0.15	0.1	0.05

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
<p>
    <b>
        PENGURURUTAN NILAI TERTINGGI-TERENDAH (PERANGKINGAN)
    </b>
</p>

<table border="1" width="100%" style="border-collapse:collapse">
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
                echo "<td class='center'>" . number_format($nilaiReferensi['referensi'], 3) . "</td>";
                echo "<th scope='row'>" . ($ranking + 1) . "</th>";
                echo "</tr>";
            }
            ?>

    </tbody>
</table>
<p>
    <b>
        INFORMASI KEPUTUSAN
    </b>
</p>
<table border="1" width="100%" style="border-collapse:collapse">
    <thead>
        <tr class="bg-dark">
            <th scope="col">#</th>
            <th scope="col">Kode</th>
            <th scope="col">Nama Alternatif</th>
            <th scope="col" class="center">Nilai</th>
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
                echo "<td class='center'>" . number_format($nilaiReferensi['referensi'], 3) . "</td>";
                echo "<th scope='row'>" . $keputusan . "</th>";
                echo "</tr>";
            }
            ?>

    </tbody>
</table>

<p>
    <b>KEPUTUSAN AKHIR</b>
</p>
<table border="1" width="100%" style="border-collapse:collapse">
    <thead>
        <tr class="bg-dark">
            <th scope="col">#</th>
            <th scope="col">Kode</th>
            <th scope="col">Nama Alternatif</th>
            <th scope="col" class="center">Nilai</th>
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
                echo "<td class='center'>" . number_format($nilaiReferensi['referensi'], 3) . "</td>";
                echo "<th scope='row'>" . $keputusan . "</th>";
                echo "</tr>";
            }
        ?>
    </tbody>
</table>
<p>
<table width="100%">
    <tr>
        <td align="right">Canduang, <?=date('d F Y')?></td>
    </tr>
    <tr>
        <td align="right">Kepala Madrasah, <br> <br> <br> <br><br> <br></td>
    </tr>
    <tr>
        <td align="right"><?=$sekolah['kepala_sekolah']?> <br> NIP. <?=$sekolah['nip']?> </td>
    </tr>
</table>
</p>
<script>
window.print()
</script>

<?php
}
?>