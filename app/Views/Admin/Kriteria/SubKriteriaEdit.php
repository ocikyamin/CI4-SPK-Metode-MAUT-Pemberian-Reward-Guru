<!-- Modal -->
<div id="modal-edit-kriteria" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="multiple-twoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg shadow-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="multiple-twoModalLabel"><i class="mdi mdi-circle-edit-outline"></i> Edit Sub Kriteria</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
            <form method="post" id="form-sub-kriteria-edit" class="mb-3">
                        <?=csrf_field()?>
                        <input type="hidden" name="sub_kriteria_id" id="sub_kriteria_id">
                        <input type="hidden" name="old_sub_kriteria" id="old_sub_kriteria">
                        <label class="form-label">Nama Indikator / Sub Kriteria</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="sub_kriteria" id="sub_kriteria" placeholder="Contoh : Membuka Pelajaran" value="<?=$sub['sub_kriteria']?>">
                                <button class="btn btn-primary btn-save" id="btn-subkriteria" type="submit">Save</button>
                        </div>
                    </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="CloseEdit()">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
    function CloseEdit() {
        TableSubKriteria();
    }
</script>