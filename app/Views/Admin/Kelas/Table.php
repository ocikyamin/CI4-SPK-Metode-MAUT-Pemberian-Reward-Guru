<?php
if (empty($kelas)) {
    ?>
    <div class="alert alert-warning"> Belum ada data kelas. Klik New untuk menambahkan.</div>
    <?php
}else{
    ?>
    <table class="table table-sm">
    <thead>
        <tr>
            <th>No.</th>
            <th class="text-center"><i class="mdi mdi-cog"></i></th>
            <th>Sekolah</th>
            <th>Nama Kelas</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i=1;
        foreach ($kelas as $d) {?>
        <tr>
            <td><?=$i++?>.</td>
            <td class="table-action text-center">
            <a href="#" onclick="EditKelas(<?=$d['id']?>)" class="action-icon"> <i class="mdi mdi-pencil text-info"></i></a>
            <a href="#" onclick="DeleteKelas(<?=$d['id']?>)" class="action-icon"> <i class="mdi mdi-delete text-danger"></i></a>
            </td>
            <td><?=$d['nama_sekolah']?></td>
            <td><?=$d['kelas']?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

    <?php
}
?>
<!-- <div class="modalview"></div> -->
<script>

      function EditKelas(id) {
        $.ajax({
            url: "<?=base_url('admin/kelas/edit')?>",
            data: {id:id},
            dataType: "json",
            success: function (response) {
                $('.modalview').html(response.form_kelas)
                $('#modal-kelas').modal('show')
                
            }
        });
      }


        function DeleteKelas(id) {
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
                    url: "<?=base_url('admin/kelas/delete')?>",
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
                                TableKelas('all');
                            }
                            })
                        }

                    }
                    });
       
            }
            })

        }

</script>

