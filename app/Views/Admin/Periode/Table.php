<?php
if (empty($periode)) {
    ?>
    <div class="alert alert-warning"> Belum ada data Periode. Klik New untuk menambahkan.</div>
    <?php
}else{
    ?>
    <table class="table table-sm">
    <thead>
        <tr>
            <th>No.</th>
            <th class="text-center"><i class="mdi mdi-cog"></i></th>
            <th>Periode</th>
            <th>Tahun / Semester</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i=1;
        foreach ($periode as $d) {?>
        <tr>
            <td><?=$i++?>.</td>
            <td class="table-action text-center">
            <a href="#" onclick="EditPeriode(<?=$d['id']?>)" class="action-icon"> <i class="mdi mdi-pencil text-info"></i></a>
            <a href="#" onclick="DeletePeriode(<?=$d['id']?>)" class="action-icon"> <i class="mdi mdi-delete text-danger"></i></a>
            </td>
            <td><?=$d['periode']?></td>
            <td><?=$d['tahun_akademik']?></td>
            <td>
                <div>
                <input type="checkbox" class="status_periode" value="<?=$d['id']?>" id="status-<?=$d['id']?>" data-switch="success" <?=$d['is_active']==1 ? 'checked':null?>>
                <label for="status-<?=$d['id']?>" data-on-label="Yes" data-off-label="No" class="mb-0 d-block"></label>
                </div>

            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

    <?php
}
?>
<!-- <div class="modalview"></div> -->
<script>

      function EditPeriode(id) {
        $.ajax({
            url: "<?=base_url('admin/periode/edit')?>",
            data: {id:id},
            dataType: "json",
            success: function (response) {
                $('.modalview').html(response.form_periode)
                $('#modal-periode').modal('show')
                
            }
        });
      }

        $('.status_periode').click(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "<?=base_url('admin/periode/status')?>",
            data: {id:$(this).val()},
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
                    TablePeriode();
                    }
                    })
                    }
                
            }
        });
        

        });

        function DeletePeriode(id) {
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
                    url: "<?=base_url('admin/periode/delete')?>",
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
                                TablePeriode();
                            }
                            })
                        }

                    }
                    });
       
            }
            })

        }

</script>

