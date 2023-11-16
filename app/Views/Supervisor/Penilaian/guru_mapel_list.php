<?php
// var_dump($periode_id);
// Jika data kosong 
if (empty($guru_mapel)) {
//    echo "404";
?>
<div class="alert alert-warning mt-3 mb-3 ">
    Data Guru Belum di tentukan untuk periode yang dipilih. Hubungi admin anda untuk mengatur mata pelajaran dan guru yang mengajar.
</div>
<?php
}else{
    // var_dump($guru_mapel);
    ?>
    <div class="table-responsive">
    <table class="datatable mid table table-sm table-hover">
<thead class="table-light">
<tr>
<th>No.</th>
<th class="text-center"><i class="mdi mdi-star"></i></th>
<th>Nama</th>
<th>Bidang Studi</th>
<th>Kelas</th>
<th>Status Penilaian</th>
</tr>
</thead>
<tbody>
<?php
$i=1;
foreach ($guru_mapel as $d) {
    $status = StatusNilai($periode_id,$d['id']);
    ?>
<tr>
<td><?=$i++?>.</td>
<td class="text-center">
<a href="<?=base_url('superv/penilaian/guru/'.$d['id'])?>" class="btn btn-success btn-rounded btn-sm shadow-sm"><i class="mdi mdi-star"></i> Beri Nilai</a>
</td>
<td><?=$d['nama']?></td>
<td><?=$d['mapel']?></td>
<td><?=$d['kelas']?></td>
<td>
    <?php
    if ($status==0) {
        echo "<span class='badge bg-warning rounded-pill p-1'>Belum ada penilaian</span>";
    }else{
        echo "<span class='badge bg-primary rounded-pill p-1'>".$status." Kompetensi telah dinilai</span>";
    }

    ?>
</td>
</tr>
<?php } ?>
</tbody>
</table>
    </div>

    <?php
}
?>
<script>
       $('.datatable').DataTable();
</script>
