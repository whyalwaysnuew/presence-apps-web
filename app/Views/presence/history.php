<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

    <!--begin::Container-->
	<div class="d-flex flex-column flex-column-fluid container-fluid">
		<!--begin::Toolbar-->
		<div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
			<!--begin::Page title-->
			<div class="page-title d-flex flex-column me-3">
				<!--begin::Title-->
				<h1 class="d-flex text-dark fw-bold my-1 fs-1">Presence History</h1>
				<!--end::Title-->
			</div>
			<!--end::Page title-->

            <!-- begin::Actions -->
            <div class="d-flex align-items-center gap-2">
                <button type="button" class="btn btn-success fw-bold">Export</button>
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
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-row-dashed table-hover gs-5">
                            <thead class="bg-dark text-white fw-bold">
                                <tr>
                                    <th class="rounded-start align-middle text-center">No</th>
                                    <th class="align-middle">Picture</th>
                                    <th class="align-middle">Name</th>
                                    <th class="align-middle text-center">Remark</th>
                                    <th class="align-middle">Date</th>
                                    <th class="rounded-end align-middle">Location</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(@$presence) {?>
                                    <?php foreach($presence as $no => $data) { ?>
                                    <tr class="align-middle">
                                        <td class="text-center fw-bold"><?= $no+1; ?></td>
                                        <td>
                                            <a href="<?= base_url('upload/presence/' . $data->created_by . '/' . $data->file) ?>" class="d-block overlay" data-fslightbox="lightbox-basic">
                                                <img src="<?= base_url('upload/presence/'.$data->created_by . '/' . $data->file) ?>" alt="" class="w-50px">
                                            </a>
                                        </td>
                                        <td><?= $data->name; ?></td>
                                        <td class="text-center">
                                            <?php if($data->remark == 'Check In') {?>    
                                                <span class="badge badge-light-success">Check In</span>
                                            <?php } else if ($data->remark == 'Check Out') {?>
                                                <span class="badge badge-light-danger">Check Out</span>
                                            <?php } else if($data->remark == 'Permit') {?>
                                                <span class="badge badge-light-primary">Permit</span>
                                            <?php }?>
                                        </td>
                                        <td><?= date('d F Y H:i', strtotime($data->presence_date)); ?></td>
                                        <td class="">
                                            <?= $data->location; ?>
                                        </td>
                                    </tr>
                                <?php } }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
		</div>
		<!--end::Post-->

<?= $this->endSection('content') ?>