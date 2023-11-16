<?php
if (empty($sub_kriteria)) {
    ?>
    <div class="alert alert-warning"> Belum ada data Sub kriteria Penilaian</div>
    <?php
}else{
    ?>
<div class="table-responsive">
    

<table class="table table-sm table-striped table-centered p-0">
    <thead>
        <tr>
            <th width="10%" class="text-center"><i class="mdi mdi-cog"></i></th>
            <th>No.</th>
            <th>Indikator</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i=1;
        foreach ($sub_kriteria as $d) {?>
        <tr>
            <td class="table-action text-center">
            <a href="#" onclick="EditSub(<?=$d['id']?>)" class="action-icon"> <i class="mdi mdi-pencil text-info"></i></a>
                <a href="#" onclick="DeleteSub(<?=$d['id']?>)" class="action-icon"> <i class="mdi mdi-delete text-danger"></i></a>
            </td>
            <td><?=$i++?>.</td>
            <td><?=$d['sub_kriteria']?></td>  
        </tr>
        <?php } ?>
    </tbody>
</table>                                           
</div> <!-- end Responsive-->
    <?php
}
?>
<div class="modaleditview"></div>
<script>
    function EditSub(id) {
        $.ajax({
            type: "get",
            url: "<?=base_url('admin/kriteria/sub/edit')?>",
            data: {id:id},
            dataType: "json",
            success: function (response) {
                $('.modaleditview').html(response.edit_sub_kriteria)
                $('#modal-edit-kriteria').modal('show')
                // $('#form-sub-kriteria').remove()
                // $('#btn-subkriteria').removeClass('btn-primary')
                // $('#btn-subkriteria').addClass('btn-warning')
                // $('#btn-subkriteria').html('Edit')
                // $('#form-sub-kriteria').removeClass('form-subkriteria-save')
                // $('#form-sub-kriteria').addClass('form-subkriteria-edit')
                // $('#btn-subkriteria').removeClass('btn-save')
                // $('#btn-subkriteria').addClass('btn-update')
                
                // $('#sub_kriteria_id').val(response.sub.id)
                // $('#sub_kriteria').val(response.sub.sub_kriteria)
                // $('#old_sub_kriteria').val(response.sub.sub_kriteria)
                // console.log(response.sub.sub_kriteria)
            }
        });
    }
      function DeleteSub(id) {
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
                    url: "<?=base_url('admin/kriteria/sub/delete')?>",
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
                                TableSubKriteria();
                            }
                            })
                        }

                    }
                    });
       
            }
            })

        }
</script>
