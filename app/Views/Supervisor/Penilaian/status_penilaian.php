<h4><i class="mdi mdi-list-status"></i> Status Penilaian</h4>
<div class="table-responsive">

    <table class="table table-sm table-bordered table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Kriteria Penilaian</th>
                <th class="text-center">Nilai</th>
            </tr>
        </thead>
        <tbody>
            <?php
$i=1;
foreach ($kriteria as $k) {
$nilai = StatusNilaiK($periode_id, $guru_mapel_id, $k['id']);

?>
            <tr>
                <td><?=$i++?></td>
                <td><?=$k['kriteria']?></td>
                <td class="text-center">
                    <?php
if ($nilai->skor==null) {
echo "<span class='badge bg-danger rounded-pill p-1'>Belum dinilai</span>";
}else{
echo "<b>".$nilai->skor."</b>";
}
?>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>