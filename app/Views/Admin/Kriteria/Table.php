<?php
if (empty($kriteria)) {
    ?>
    <div class="alert alert-warning"> Belum ada data kriteria Penilaian. Klik New untuk menambahkan data.</div>
    <?php
}else{
    ?>
<div class="table-responsive">
<table id="basic-datatable" class="table table-hover table-striped table-sm table-centered nowrap">
    <thead>
        <tr>
            <th class="text-center"><i class="mdi mdi-cog"></i></th>
            <th>No.</th>
            <th>Kode</th>
            <th>Kriteria</th>
            <th class="text-center">Bobot</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i=1;
        foreach ($kriteria as $d) {?>
        <tr>
            <td class="table-action text-center">
                <a href="#" onclick="Edit(<?=$d['id']?>)" class="action-icon"> <i class="mdi mdi-pencil text-info"></i></a>
                <a href="#" onclick="Delete(<?=$d['id']?>)" class="action-icon"> <i class="mdi mdi-delete text-danger"></i></a>
                <a href="#" onclick="SubKriteria(<?=$d['id']?>)" class="action-icon"><i class="mdi mdi-dots-vertical text-warning"></i></a>
            </td>
            <td><?=$i++?>.</td>
            <td><?=$d['kode']?></td>
            <td><?=$d['kriteria']?></td>
            <td class="text-center"><span class="badge bg-info p-1"><?=$d['bobot']?></span></td>
                
        </tr>
        <?php } ?>
    </tbody>
</table>                                           
</div> <!-- end Responsive-->
    <?php
}
?>
<script>
      function Edit(id) {
        $.ajax({
            url: "<?=base_url('admin/kriteria/edit')?>",
            data: {id:id},
            dataType: "json",
            success: function (response) {
                $('.modalview').html(response.form_kriteria)
                $('#modal-kriteria').modal('show')
                
            }
        });
      }
      function SubKriteria(id) {
        $.ajax({
            url: "<?=base_url('admin/kriteria/sub')?>",
            data: {id:id},
            dataType: "json",
            success: function (response) {
                $('.modalview').html(response.sub_kriteria)
                $('#modal-sub-kriteria').modal('show')
                
            }
        });
      }
      function Delete(id) {
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
                    url: "<?=base_url('admin/kriteria/delete')?>",
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
                            TableKriteria();
                            }
                            })
                        }

                    }
                    });
       
            }
            })

        }

</script>
