<div id="modal-sekolah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
           

            <div class="modal-header">
                <h4 class="modal-title">
                New Sekolah
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form id="form-sekolah" method="post">
                <?=csrf_field()?>
            <div class="modal-body">

            <div class="form-group mb-2">
                <label for="npsn">NPSN</label>
                <input type="text" class="form-control" id="npsn" name="npsn" placeholder="(99999)">
                <div class="npsn invalid-feedback"></div>
            </div>
            <div class="form-group mb-2">
                <label for="nama_sekolah">Nama Sekolah</label>
                <input type="text" class="form-control" id="nama_sekolah" name="nama_sekolah" placeholder="Ex : MTS TI Candung">
                <div class="nama_sekolah invalid-feedback"></div>
            </div>
            <div class="form-group mb-2">
                <label for="kepala_sekolah">Kepala Sekolah</label>
                <input type="text" class="form-control" id="kepala_sekolah" name="kepala_sekolah" placeholder="Ex : Muhammad Abduh, M. Pd">
                <div class="kepala_sekolah invalid-feedback"></div>
            </div>
            <div class="form-group mb-2">
                <label for="nip">NIP</label>
                <input type="text" class="form-control" id="nip" name="nip" placeholder="(9999999999)">
                <div class="nip invalid-feedback"></div>
            </div>
            <div class="form-group mb-2">
                <label for="alamat">Alamat Sekolah</label>
                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Ex : Jl. Syekh Sulaiaman Arrasuli, Kec, Kab, Prov">
                <div class="alamat invalid-feedback"></div>
            </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light btn-rounded btn-sm shadow-sm" data-bs-dismiss="modal">Close</button>
                <button type="submit" id="btn-save" class="btn btn-primary btn-rounded btn-sm shadow-sm">Save</button>
            </div>
            </form> <!-- Form //-->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
 $('#form-sekolah').submit(function (e) { 
    e.preventDefault();
    $.ajax({
        type: "post",
        url: "<?=base_url('admin/sekolah/save')?>",
        data: $(this).serialize(),
        dataType: "json",
                    beforeSend: function() {
                    $('#btn-save').prop('disabled', true);
                    $('#btn-save').html(
                    `<div class="text-center"><div class="spinner-border spinner-border spinner-border-sm" role="status">
                    <span class="visually-hidden">Loading...</span>
                    </div></div>`
                    );
                    },
                    complete: function() {
                    $('#btn-save').prop('disabled', false);
                    $('#btn-save').html(`Save`);
                    },
        success: function (response) {
            if (response.error) {
            if (response.error.npsn) {
                $('#npsn').addClass('is-invalid')
                $('.npsn').html(response.error.npsn)
            }
            if (response.error.nip) {
                $('#nip').addClass('is-invalid')
                $('.nip').html(response.error.nip)
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
                $('#modal-sekolah').modal('hide')
                TableSekolah();
            }
            })
            }
        }
    });
    
 });
</script>