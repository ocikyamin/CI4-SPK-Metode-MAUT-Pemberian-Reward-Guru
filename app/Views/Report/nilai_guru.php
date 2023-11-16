<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekapitulasi Nilai</title>
    <style>
        body {
            font-family: "Nunito", sans-serif;
        }

        .center {
            text-align: center;
        }
    </style>
</head>

<body>
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
        <h3>HASIL PENILAIAN KINERJA GURU</h3>
    </center>
    <!-- kop  -->
    <!-- identitas guru  -->
    <?php
    // var_dump($guru);
    // echo "<pre>";
    // print_r($guru);
    // echo "</pre>";
    ?>
    <table>
        <tr>
            <td rowspan="4">A.</td>
            <td>Nama</td>
            <td>:</td>
            <td><?= $guru->nama ?></td>
        </tr>
        <tr>
            <td>No.Induk / NUPTK/ NIP</td>
            <td>:</td>
            <td><?= $guru->nuptk ?></td>
        </tr>
        <tr>
            <td>Tempat / Tanggal Lahir</td>
            <td>:</td>
            <td><?= $guru->tmp_lahir ?>, <?= date('d/m/Y', strtotime($guru->tgl_lahir)) ?></td>
        </tr>
        <tr>
            <td>Pendidikan Terakhir</td>
            <td>:</td>
            <td><?= $guru->pddk_akhir ?></td>
        </tr>

        <tr>
            <td rowspan="4">B.</td>
            <td>Nama Instansi/Sekolah</td>
            <td>:</td>
            <td><?= $guru->nama_sekolah ?></td>
        </tr>
        <tr>
            <td>NPSN</td>
            <td>:</td>
            <td><?= $guru->npsn ?></td>
        </tr>
        <tr>
            <td>Kepala Sekolah</td>
            <td>:</td>
            <td><?= $guru->kepala_sekolah ?></td>
        </tr>
        <tr>
            <td>NIP</td>
            <td>:</td>
            <td><?= $guru->nip ?></td>
        </tr>

        <tr>
            <td rowspan="3">C.</td>
            <td>Tahun Akademik</td>
            <td>:</td>
            <td><?= $guru->tahun_akademik ?></td>
        </tr>
        <tr>
            <td>Bidang Studi</td>
            <td>:</td>
            <td><?= $guru->mapel ?></td>
        </tr>
        <tr>
            <td>Periode Penilaian</td>
            <td>:</td>
            <td><?= $guru->periode ?></td>
        </tr>
    </table>
    <p>
        <!-- nilai  -->
    <table border="1" width="100%" style="border-collapse:collapse">
        <tr>
            <th class="center">No.</th>
            <th>Kompetensi</th>
            <th class="center">Nilai</th>
        </tr>

        <?php
        $i = 1;
        foreach ($kriteria as $k) {
            $nilai = StatusNilaiK($periode_id, $guru_mapel_id, $k['id']);

        ?>
            <tr>
                <td class="center"><?= $i++ ?></td>
                <td><?= $k['kriteria'] ?></td>
                <td class="center">
                    <?php
                    if ($nilai->skor == null) {
                        echo "<span class='badge bg-danger rounded-pill p-1'>Belum dinilai</span>";
                    } else {
                        echo "<b>" . $nilai->skor . "</b>";
                    }
                    ?>
                </td>
            </tr>
        <?php } ?>

    </table>
    <!-- end nilai  -->
    </p>
    <p>
    <table width="100%">
        <tr>
            <td colspan="3" align="right">Canduang, <?= date('d/m/Y') ?></td>
        </tr>
        <tr>
            <td> Guru yang dinilai
                <div><?= $guru->nama ?></div>

            </td>
            <td> Penilai
                <div>
                    <?= $guru->kepala_sekolah ?>
                </div>

            </td>
            <td align="right"> Kepala Sekolah / Madrasah
                <div><?= $guru->kepala_sekolah ?> <br>
                    NIP.<?= $guru->nip ?>
                </div>
            </td>
        </tr>
    </table>
    </p>
    <script>
        window.print()
    </script>
</body>

</html>