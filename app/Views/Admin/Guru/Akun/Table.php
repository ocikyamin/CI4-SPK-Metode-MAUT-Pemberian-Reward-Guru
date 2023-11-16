<p>
    <button onclick="NewAkunGuru()" class="btn btn-primary btn-rounded shadow-sm btn-sm">
        <i class="mdi mdi-plus"></i> New
    </button>
</p>
<?php
if (empty($guru)) {
    ?>
<div class="alert alert-warning"> Belum ada data Guru. Klik New untuk menambahkan.</div>
<?php
}else{
    ?>
<table class="table table-sm">
    <thead>
        <tr>
            <th>No.</th>
            <th class="text-center"><i class="mdi mdi-cog"></i></th>
            <th>NUPTK</th>
            <th>Nama</th>
            <th>TTL</th>
            <th>Gender</th>
            <th>Pendidikan</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i=1;
        foreach ($guru as $d) {?>
        <tr>
            <td><?=$i++?>.</td>
            <td class="table-action text-center">
                <a href="#" onclick="Edit(<?=$d['id']?>)" class="action-icon"> <i
                        class="mdi mdi-pencil text-info"></i></a>
                <a href="#" onclick="Delete(<?=$d['id']?>)" class="action-icon"> <i
                        class="mdi mdi-delete text-danger"></i></a>
            </td>

            <td><?=$d['nuptk']?></td>
            <td><?=$d['nama']?></td>
            <td><?=$d['tmp_lahir']?>, <?=date('d/m/Y', strtotime($d['tgl_lahir']))?></td>
            <td><?=$d['jk']?></td>
            <td><?=$d['pddk_akhir']?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<?php
}
?>
<!-- <div class="modalview"></div> -->
<script>
function NewAkunGuru() {
    $.ajax({
        url: "<?=base_url('admin/guru/akun/new')?>",
        data: "data",
        dataType: "json",
        success: function(response) {
            $('.modalview').html(response.form_guru)
            $('#modal-guru').modal('show')

        }
    });
}

function Edit(id) {
    $.ajax({
        url: "<?=base_url('admin/guru/akun/edit')?>",
        data: {
            id: id
        },
        dataType: "json",
        success: function(response) {
            $('.modalview').html(response.form_guru)
            $('#modal-guru').modal('show')

        }
    });
}

$('.status_akun').click(function(e) {
    e.preventDefault();
    $.ajax({
        type: "post",
        url: "<?=base_url('admin/guru/akun/status')?>",
        data: {
            id: $(this).val()
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
                        TableAkunGuru();
                    }
                })
            }

        }
    });


});

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
                url: "<?=base_url('admin/guru/akun/delete')?>",
                data: {
                    id: id
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
                                TableAkunGuru();
                            }
                        })
                    }

                }
            });

        }
    })

}
</script>