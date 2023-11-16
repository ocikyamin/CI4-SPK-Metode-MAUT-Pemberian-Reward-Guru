<?php
if (empty($user)) {
    ?>
<div class="alert alert-warning"> Belum ada data User. Klik New untuk menambahkan.</div>
<?php
}else{
    // var_dump(UserLogin());
    ?>
<table class="table table-sm">
    <thead>
        <tr>
            <th>No.</th>
            <th class="text-center"><i class="mdi mdi-cog"></i></th>
            <th>Email</th>
            <th>Nama User</th>
            <th>Role Akses</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i=1;
        foreach ($user as $d) {?>
        <tr>
            <td><?=$i++?>.</td>
            <td class="table-action text-center">
                <?php
                if (UserLogin()->user_id == $d['id']) {
                   echo "Anda sedang login";
                }else{
                    ?>
                <a href="#" onclick="EditUser(<?=$d['id']?>)" class="action-icon"> <i
                        class="mdi mdi-pencil text-info"></i></a>
                <a href="#" onclick="DeleteUser(<?=$d['id']?>)" class="action-icon"> <i
                        class="mdi mdi-delete text-danger"></i></a>
                <?php
                }

                ?>

            </td>
            <td><?=$d['email']?></td>
            <td><?=$d['full_name']?></td>
            <td><?=$d['role_name']?></td>
            <td>
                <div class="<?=UserLogin()->user_id == $d['id'] ? 'd-none':null?>">
                    <input type="checkbox" class="status_user" value="<?=$d['id']?>" id="status-<?=$d['id']?>"
                        data-switch="success" <?=$d['is_active']==1 ? 'checked':null?>>
                    <label for="status-<?=$d['id']?>" data-on-label="Yes" data-off-label="No"
                        class="mb-0 d-block"></label>
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
function EditUser(id) {
    $.ajax({
        url: "<?=base_url('admin/user/edit')?>",
        data: {
            id: id
        },
        dataType: "json",
        success: function(response) {
            $('.modalview').html(response.form_user)
            $('#modal-user').modal('show')

        }
    });
}

$('.status_user').click(function(e) {
    e.preventDefault();
    $.ajax({
        type: "post",
        url: "<?=base_url('admin/user/status')?>",
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
                        TableUsers();
                    }
                })
            }

        }
    });


});

function DeleteUser(id) {
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
                url: "<?=base_url('admin/user/delete')?>",
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
                                TableUsers();
                            }
                        })
                    }

                }
            });

        }
    })

}
</script>