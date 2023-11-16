<?= $this->extend('Admin/Layouts') ?>
<?= $this->section('content') ?>
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Dashboard</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="row g-0 align-items-center">
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">Hai, <b class="text-success"><?=UserLogin()->full_name?></b> Selamat
                            Datang 🎉</h5>
                        <div>Sistem <b>Penilaian Kinerja Guru</b> (PKG)
                            Pondok Pesantren Madrasah Tarbiyah Islamiyah (MTI) Canduang
                        </div>
                        <!-- <a href="javascript:;" class="btn btn-sm btn-primary mt-3"><i class="uil-cog"></i> Setting Account</a> -->



                    </div> <!-- end card-body -->
                </div> <!-- end col -->
                <div class="col-md-4">
                    <img src="<?=base_url()?>/public/images/email-campaign.svg" class="card-img" alt="...">
                </div> <!-- end col -->
            </div> <!-- end row-->
        </div> <!-- end card -->
    </div>

    <div class="col-lg-4">

        <div class="row">
            <div class="col-lg-6 col-md-12 col-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <div class="card-title text-center">
                            <i class="uil-users-alt display-4 text-success"></i>
                        </div>
                        <span class="fw-semibold d-block mb-1">Jumlah Guru</span>
                        <h3 class="card-title mb-2"><?= CountData('guru') ?></h3>
                        <div class="d-grid gap-2 mx-auto">
                            <a href="<?=base_url('admin/guru')?>" class="btn btn-sm btn-success">View More</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <div class="card-title text-center">
                            <i class="uil-file-copy-alt display-4 text-info"></i>
                        </div>
                        <span class="fw-semibold d-block mb-1">Kriteria</span>
                        <h3 class="card-title mb-2"><?= CountData('kriteria') ?></h3>
                        <div class="d-grid gap-2 mx-auto">
                            <a href="<?=base_url('admin/kriteria')?>" class="btn btn-sm btn-info">View More</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
<!-- end row -->

<?= $this->endSection() ?>