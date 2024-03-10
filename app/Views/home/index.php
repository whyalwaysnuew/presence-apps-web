<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

    <!--begin::Container-->
	<div class="d-flex flex-column flex-column-fluid container-fluid">
		<!--begin::Toolbar-->
		<div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
			<!--begin::Page title-->
			<div class="page-title d-flex flex-column me-3">
				<!--begin::Title-->
				<h1 class="d-flex text-dark fw-bold my-1 fs-1">Dashboard</h1>
				<!--end::Title-->
			</div>
			<!--end::Page title-->

            <!-- begin::Actions -->
            <div class="d-flex align-items-center gap-2">
                
            </div>
            <!--end::Actions -->

		</div>
		<!--end::Toolbar-->	


		<!--begin::Post-->
		<div class="content flex-column-fluid" id="kt_content">
            <div class="col-lg-12">
                <?= session()->getFlashdata('message'); ?>
            </div>
            
			<!--end::Row-->

            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h2 class="fs-2 fw-bold">Dashboard</h2>
                    </div>
                </div>
                <div class="card-body"></div>
                <div class="card-footer d-flex justify-content-end">
                    <button type="button" class="btn btn-primary">Submit</button>
                </div>
            </div>
            
		</div>
		<!--end::Post-->

<?= $this->endSection('content') ?>