<?php
if (empty($guru_mapel)) {
?>
<div class="alert alert-warning"> Belum ada data Guru Bidang Studi. Klik Tombol Pengaturan Untuk Menambahkan Guru Bidang Studi.</div>
<?php
}else{
?>

<div class="row">
<div class="col-lg-12">
<table class="table table-sm">
<thead>
<tr>
<th>No.</th>
<th class="text-center"><i class="mdi mdi-cog"></i></th>
<th>Kode</th>
<th>Nama</th>
<th>Bidang Studi</th>
<th>Kelas</th>
</tr>
</thead>
<tbody>
<?php
$i=1;
foreach ($guru_mapel as $d) {?>
<tr>
<td><?=$i++?>.</td>
<td class="table-action text-center">
<a href="#" onclick="EditGuruMapel(<?=$d['id']?>)" class="action-icon"> <i class="mdi mdi-pencil text-info"></i></a>
<a href="#" onclick="DeleteGuruMapel(<?=$d['id']?>)" class="action-icon"> <i class="mdi mdi-delete text-danger"></i></a>
</td>
<td><?=$d['kode_guru']?></td>
<td><?=$d['nama']?></td>
<td><?=$d['mapel']?></td>
<td><?=$d['kelas']?></td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
</div>

<?php
}

?>

<script>
      function EditGuruMapel(id) {
        $.ajax({
            url: "<?=base_url('admin/guru/mapel/edit')?>",
            data: {id:id},
            dataType: "json",
            success: function (response) {
                $('.modalview').html(response.form_guru_mapel)
                $('#modal-guru-mapel').modal('show')
                
            }
        });
      }

      function DeleteGuruMapel(id) {
          Swal.fire({
            title: 'Are you sure?',
            text: "Tindakan ini akan menghapus data",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                    type: "post",
                    url: "<?=base_url('admin/guru/mapel/delete')?>",
                    data: {id:id},
                    dataType: "json",
                    success: function (response) {
                        if (response.status) {
                            $.toast({
                            position :'top-right',
                            heading: 'Berhasil',
                            text: response.msg,
                            showHideTransition: 'slide',
                            hideAfter: 1000,
                            icon: 'success',
                            afterHidden: function () {
                                TableGuruMapel();
                            }
                            })
                        }

                    }
                    });
       
            }
            })

        }
</script>

