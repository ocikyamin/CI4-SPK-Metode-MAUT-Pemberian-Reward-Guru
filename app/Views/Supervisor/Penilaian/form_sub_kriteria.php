<div id="modal-sub-kriteria" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-success">
                <h4 class="modal-title" id="fullWidthModalLabel">KRITERIA : <?= strtoupper($kriteria['kode']) ?> -
                    <?= strtoupper($kriteria['kriteria']) ?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <?php
                // cek jika sub kriteria tersedia 
                if (empty($sub_kriteria)) {
                ?>
                <div class="text-center">
                    <i class="dripicons-warning h1 text-warning"></i>
                    <h4 class="mt-2">Belum Tesedia</h4>
                    <p class="mt-3">Indikator Penilaian untuk Kriteria <strong
                            class="text-success"><?= $kriteria['kriteria'] ?></strong></p>
                    <button type="button" class="btn btn-warning my-2" data-bs-dismiss="modal">Tutup</button>
                </div>
                <?php
                } else {
                ?>
                <form id="form-save-nilai">
                    <?= csrf_field() ?>
                    <input type="hidden" name="nilai_id"
                        value="<?= empty($nilai_kriteria) ? 0 : $nilai_kriteria->id ?>">
                    <input type="hidden" name="sekolah_id" value="<?= $guru->sekolah_id ?>">
                    <input type="hidden" name="periode_id" value="<?= $guru->periode_id ?>">
                    <input type="hidden" name="penilai_id" value="<?= UserLogin()->id ?>">
                    <input type="hidden" name="guru_mapel_id" value="<?= $guru->id ?>">
                    <input type="hidden" name="kriteria_id" value="<?= $kriteria['id'] ?>">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="row">
                                <div class="col-lg-6">
                                    <!-- Identitas Penilai  -->
                                    <p>
                                        IDENTITAS PENILAI
                                    </p>
                                    <div class="form-group row mb-1">
                                        <label class="col-lg-3">Nama Penilai</label>
                                        <div class="col-lg-9"><input type="text" class="form-control form-control-sm"
                                                value="<?= UserLogin()->full_name ?>" disabled></div>
                                    </div>
                                    <div class="form-group row mb-1">
                                        <label class="col-lg-3">Periode Penilain</label>
                                        <div class="col-lg-9"><input type="text" value="<?= $guru->tahun_akademik ?>"
                                                class="form-control form-control-sm" disabled></div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-lg-3">Tanggal Penilain</label>
                                        <div class="col-lg-9">
                                            <input type="date" name="tgl_penilaian" value="<?= date('Y-m-d') ?>"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <!-- End Identitas Penilai  -->

                                </div>
                                <div class="col-lg-6">
                                    <!-- Identitas Penilai  -->
                                    <p>
                                        IDENTITAS GURU YANG SEDANG DINILAI
                                    </p>
                                    <div class="form-group row mb-1">
                                        <label class="col-lg-3">Nama Guru</label>
                                        <div class="col-lg-9"><input type="text" class="form-control form-control-sm"
                                                value="<?= $guru->nama ?>" disabled></div>
                                    </div>
                                    <div class="form-group row mb-1">
                                        <label class="col-lg-3">Bidang Studi</label>
                                        <div class="col-lg-9"><input type="text" value="<?= $guru->mapel ?>"
                                                class="form-control form-control-sm" disabled></div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-lg-3">Kelas</label>
                                        <div class="col-lg-9"><input type="text" value="<?= $guru->kelas ?>"
                                                class="form-control form-control-sm" disabled></div>
                                    </div>
                                    <!-- End Identitas Penilai  -->

                                </div>
                            </div>


                        </div>
                        <div class="col-lg-3">
                            <div class="alert bg-success text-white">
                                <strong>Keterangan Skor </strong>
                                <table>
                                    <tr>
                                        <td>(4)</td>
                                        <td>:</td>
                                        <td>Melebihi dari Standar</td>
                                    </tr>
                                    <tr>
                                        <td>(3)</td>
                                        <td>:</td>
                                        <td>Memenuhi dari Standar</td>
                                    </tr>
                                    <tr>
                                        <td>(2)</td>
                                        <td>:</td>
                                        <td>Kurang dari Standar</td>
                                    </tr>
                                    <tr>
                                        <td>(1)</td>
                                        <td>:</td>
                                        <td>Tidak Memenuhi Satandar</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="d-grid">
                                <button type="button"
                                    onclick="ResetNilai(<?=$guru->periode_id ?>,<?= $guru->id ?>,<?= $kriteria['id'] ?>)"
                                    class="btn btn-light btn-rounded btn-sm mb-3">Reset Nilai
                                    ?</button>
                            </div>
                        </div>
                    </div>


                    <div class="table-responsive">
                        <table class="table mid table-bordered table-sm table-hover">
                            <thead>
                                <tr>
                                    <th rowspan="2">No</th>
                                    <th rowspan="2">Indikator Penilaian</th>
                                    <th colspan="4" class="text-center">SKOR <br> <span class="badge bg-success"><b
                                                class="h4 rounded-pill"
                                                id="total-nilai"><?= empty($nilai_kriteria) ? 0 : $nilai_kriteria->skor ?></b>
                                        </span> </th>
                                </tr>
                                <tr>
                                    <th class="text-center">1</th>
                                    <th class="text-center">2</th>
                                    <th class="text-center">3</th>
                                    <th class="text-center">4</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $i = 1;
                                    $jumlah_indikator = 0;
                                    foreach ($sub_kriteria as $sk) {
                                        $statusNilai = StatusNilaiIndikator($guru->periode_id, $guru->id, $kriteria['id'], $sk['id']);
                                        if ($statusNilai !== null) {
                                            $id = $statusNilai->id;
                                            $skor = $statusNilai->nilai;
                                        } else {
                                            $id = 0;
                                            $skor = null;
                                            // Penanganan ketika data tidak ditemukan
                                        }

                                    ?>
                                <tr>
                                    <td><?= $i++ ?>.</td>
                                    <td><?= $sk['sub_kriteria'] ?></td>
                                    <td>
                                        <input type="hidden" name="nilai_indikator_id[]" value="<?= $id ?>">
                                        <input type="hidden" name="indikator[]" value="<?= $sk['id'] ?>">

                                        <input type="checkbox" class="skor" name="skor[]" value="1"
                                            id="satu-<?= $sk['id'] ?>" data-switch="success"
                                            <?= $skor == 1 ? 'checked' : null ?> />
                                        <label for="satu-<?= $sk['id'] ?>" data-on-label="Yes"
                                            data-off-label="No"></label>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="skor" name="skor[]" value="2"
                                            id="dua-<?= $sk['id'] ?>" data-switch="success"
                                            <?= $skor == 2 ? 'checked' : null ?> />
                                        <label for="dua-<?= $sk['id'] ?>" data-on-label="Yes"
                                            data-off-label="No"></label>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="skor" name="skor[]" value="3"
                                            id="tiga-<?= $sk['id'] ?>" data-switch="success"
                                            <?= $skor == 3 ? 'checked' : null ?> />
                                        <label for="tiga-<?= $sk['id'] ?>" data-on-label="Yes"
                                            data-off-label="No"></label>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="skor" name="skor[]" value="4"
                                            id="empat-<?= $sk['id'] ?>" data-switch="success"
                                            <?= $skor == 4 ? 'checked' : null ?> />
                                        <label for="empat-<?= $sk['id'] ?>" data-on-label="Yes"
                                            data-off-label="No"></label>
                                    </td>
                                </tr>
                                <?php
                                        $jumlah_indikator++;
                                    } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center mt-3 mb-3">
                        <button type="button" class="btn btn-outline-warning btn-rounded" data-bs-dismiss="modal"><i
                                class="mdi mdi-close"></i> Tutup </button>
                        <button type="submit" id="btn-save-nilai" disabled class="btn btn-success btn-rounded"><i
                                class="mdi mdi-check-circle-outline"></i> Simpan Nilai</button>
                    </div>
                </form>

                <?php
                }

                ?>


            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="viewsubkriteria"></div>

<script>
$(document).ready(function() {
    var jumlah_indikator = <?= empty($jumlah_indikator) ? 0 : $jumlah_indikator ?>
    // Hanya satu checkbox dalam setiap baris yang dapat dipilih
    $(".skor").on("click", function() {
        var row = $(this).closest("tr");
        row.find(".skor").not(this).prop("checked", false);
    });
    $(".skor").on("change", function() {
        hitungJumlahNilai()
        var totalChecked = $(".skor:checked").length;
        if (totalChecked !== jumlah_indikator) {
            $('#btn-save-nilai').prop('disabled', true)
        } else {
            $('#btn-save-nilai').prop('disabled', false)

        }
    });
    // Fungsi untuk menghitung jumlah nilai
    function hitungJumlahNilai() {
        var totalNilai = 0;

        $(".skor:checked").each(function() {
            totalNilai += parseInt($(this).val());
        });

        // Menampilkan jumlah nilai di suatu elemen (misalnya span)
        $("#total-nilai").text(totalNilai);
    }

});

// Submit Nilai 
$('#form-save-nilai').submit(function(e) {
    e.preventDefault();
    $.ajax({
        type: "post",
        url: "<?= base_url('superv/penilaian/save') ?>",
        data: $(this).serialize(),
        dataType: "json",
        beforeSend: function() {
            $('#btn-save-nilai').prop('disabled', true);
            $('#btn-save-nilai').html(
                `  <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
Loading...`
            );
        },
        complete: function() {
            $('#btn-save-nilai').prop('disabled', false);
            $('#btn-save-nilai').html(`<i class="mdi mdi-check-circle-outline"></i> Simpan Nilai`);
        },
        success: function(response) {
            if (response.sukses) {
                Swal.fire({
                    icon: 'success',
                    title: 'Selesai !',
                    text: response.msg,
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    const periode_id = $('#periode_id').val()
                    const guru_mapel_id = $('#guru_mapel_id').val()
                    TableStatusNilai(periode_id, guru_mapel_id)
                    $('#modal-sub-kriteria').modal('hide')
                })
            }
        }
    });

});

// Rset Nilai 
function ResetNilai(periode, guru, kriteria) {
    Swal.fire({
        title: 'Are you sure?',
        text: "Tindakan ini akan menghapus data nilai",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Reset Nilai!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "post",
                url: "<?=base_url('superv/penilaian/reset')?>",
                data: {
                    periode_id: periode,
                    guru_mapel_id: guru,
                    kriteria_id: kriteria
                },
                dataType: "json",
                success: function(response) {
                    if (response.status) {
                        $.toast({
                            position: 'top-right',
                            heading: 'Berhasil',
                            text: response.msg,
                            showHideTransition: 'slide',
                            hideAfter: 1000,
                            icon: 'success',
                            afterHidden: function() {

                                window.location = response.url

                            }
                        })
                    }

                }
            });

        }
    })


}
</script>