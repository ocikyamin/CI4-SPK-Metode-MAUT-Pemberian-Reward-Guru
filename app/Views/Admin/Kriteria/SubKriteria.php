<div id="modal-sub-kriteria" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width ribbon-box">
        <div class="modal-content ">
            <div class="modal-header"><h4 class="modal-title"><i class="mdi mdi-cog"></i> Indikator Kriteria</h4></div>
            <div class="modal-body">
                <div class="ribbon ribbon-primary float-start shadow-sm"><i class="mdi mdi-table me-1"></i> 
                <?=$kriteria['kriteria']?> (<?=$kriteria['kode']?>)</div>
                <div class="ribbon-content">
                    <div id="div-edit-sub-kritera"></div>
                    <form method="post" id="form-sub-kriteria" class="form-subkriteria-save mb-3">
                        <?=csrf_field()?>
                        <input type="hidden" name="kriteria_id" value="<?=$kriteria['id']?>">
                        <label class="form-label">Nama Indikator / Sub Kriteria</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="sub_kriteria" id="sub_kriteria" placeholder="Contoh : Membuka Pelajaran">
                                <button class="btn btn-primary btn-save" id="btn-subkriteria" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            <div id="table-sub-kriteria"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light btn-rounded btn-sm shadow-sm" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
$(document).ready(function () {
TableSubKriteria();
});
function TableSubKriteria() {
$.ajax({
url: "<?=base_url('admin/kriteria/list/sub')?>",
data: {id:<?=$kriteria['id']?>},
dataType: "json",
beforeSend: function() {
                $('#table-sub-kriteria').html(`<div class="spinner-border spinner-border-sm" role="status">
                <span class="visually-hidden">Loading...</span>
                </div>`);
                },
success: function (response) {
$('#table-sub-kriteria').html(response.list_sub_kriteria)
}
});
}

// $(selector).click(function (e) { 
//     e.preventDefault();
    
// });
 $('.btn-save').click(function (e) { 
    e.preventDefault();
    $.ajax({
        type: "post",
        url: "<?=base_url('admin/kriteria/sub/save')?>",
        data: $('#form-sub-kriteria').serialize(),
        dataType: "json",
                    beforeSend: function() {
                    $('.btn-save').prop('disabled', true);
                    $('.btn-save').html(
                    `<div class="text-center"><div class="spinner-border spinner-border spinner-border-sm" role="status">
                    <span class="visually-hidden">Loading...</span>
                    </div></div>`
                    );
                    },
                    complete: function() {
                    $('.btn-save').prop('disabled', false);
                    $('.btn-save').html(`Save`);
                    },
        success: function (response) {
            if (response.error) {
            if (response.error.sub_kriteria) {
                $.toast({
                position :'top-right',
                heading: 'Warning',
                text : response.error.sub_kriteria,
                showHideTransition: 'fade',
                icon: 'error'
                });

                $('#sub_kriteria').addClass('is-invalid')
                // $('.sub_kriteria').html(response.error.sub_kriteria)
            }

            } // end Error

            if (response.status) {
            $.toast({
            position :'top-right',
            heading: 'Berhasil',
            text: response.msg,
            showHideTransition: 'slide',
            hideAfter: 1000,
            icon: 'success',
            afterHidden: function () {
                $('#sub_kriteria').removeClass('is-invalid')
                // $('#sub_kriteria').addClass('is-valid')
                TableSubKriteria();
            }
            })
            }
        }
    });
    
 });


//  $('.btn-update').click(function (e) { 
//     e.preventDefault();
//     $.ajax({
//         type: "post",
//         url: "<?=base_url('admin/kriteria/sub/update')?>",
//         data: $('.form-subkriteria-edit').serialize(),
//         dataType: "json",
//                     beforeSend: function() {
//                     $('.btn-update').prop('disabled', true);
//                     $('.btn-update').html(
//                     `<div class="text-center"><div class="spinner-border spinner-border spinner-border-sm" role="status">
//                     <span class="visually-hidden">Loading...</span>
//                     </div></div>`
//                     );
//                     },
//                     complete: function() {
//                     $('.btn-update').prop('disabled', false);
//                     $('.btn-update').html(`Save`);
//                     },
//         success: function (response) {
//             if (response.error) {
//             if (response.error.sub_kriteria) {
//                 $.toast({
//                 position :'top-right',
//                 heading: 'Warning',
//                 text : response.error.sub_kriteria,
//                 showHideTransition: 'fade',
//                 icon: 'error'
//                 });

//                 $('#sub_kriteria').addClass('is-invalid')
//                 // $('.sub_kriteria').html(response.error.sub_kriteria)
//             }

//             } // end Error

//             if (response.status) {
//             $.toast({
//             position :'top-right',
//             heading: 'Berhasil',
//             text: response.msg,
//             showHideTransition: 'slide',
//             hideAfter: 1000,
//             icon: 'success',
//             afterHidden: function () {
//                 $('#sub_kriteria').removeClass('is-invalid')
//                 // $('#sub_kriteria').addClass('is-valid')
//                 TableSubKriteria();
//             }
//             })
//             }
//         }
//     });
    
//  });


</script>