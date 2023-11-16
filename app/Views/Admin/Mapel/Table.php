<?php
if (empty($mapel)) {
    ?>
    <div class="alert alert-warning"> Belum ada data Mata Pelajaran. Klik New untuk menambahkan.</div>
    <?php
}else{
    ?>
    <table class="table table-sm">
    <thead>
        <tr>
            <th>No.</th>
            <th class="text-center"><i class="mdi mdi-cog"></i></th>
            <th>Mata Pelajaran</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i=1;
        foreach ($mapel as $d) {?>
        <tr>
            <td><?=$i++?>.</td>
            <td class="table-action text-center">
            <a href="#" onclick="EditMapel(<?=$d['id']?>)" class="action-icon"> <i class="mdi mdi-pencil text-info"></i></a>
            <a href="#" onclick="DeleteMapel(<?=$d['id']?>)" class="action-icon"> <i class="mdi mdi-delete text-danger"></i></a>
            </td>
            <td><?=$d['mapel']?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

    <?php
}
?>
<!-- <div class="modalview"></div> -->
<script>

      function EditMapel(id) {
        $.ajax({
            url: "<?=base_url('admin/mapel/edit')?>",
            data: {id:id},
            dataType: "json",
            success: function (response) {
                $('.modalview').html(response.form_mapel)
                $('#modal-mapel').modal('show')
                
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

        function DeleteMapel(id) {
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
                    url: "<?=base_url('admin/mapel/delete')?>",
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
                                TableMapel();
                            }
                            })
                        }

                    }
                    });
       
            }
            })

        }

</script>

