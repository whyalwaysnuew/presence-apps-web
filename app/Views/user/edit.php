<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

    <!--begin::Container-->
	<div class="d-flex flex-column flex-column-fluid container-fluid">
		<!--begin::Toolbar-->
		<div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
			<!--begin::Page title-->
			<div class="page-title d-flex flex-column me-3">
				<!--begin::Title-->
				<h1 class="d-flex text-dark fw-bold my-1 fs-1">Edit User</h1>
				<!--end::Title-->
			</div>
			<!--end::Page title-->

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
                    <form id="updateForm" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="d-flex flex-column gap-4">
                                <div class="col-12">
                                    <label for="fullname" class="form-label fw-bold">Name</label>
                                    <input type="text" name="fullname" id="fullname" class="form-control" value="<?= $user->fullname ?>" placeholder="e.g. Jerry Brilianto Akbar">
                                </div>

                                <div class="col-12">
                                    <label for="email" class="form-label fw-bold">Email</label>
                                    <input type="text" name="email" id="email" class="form-control" value="<?= $user->email ?>" placeholder="e.g. jerry@gmail.com">
                                </div>
        
                                <div class="col-12">
                                    <label for="division_id" class="form-label fw-bold">Division</label>
                                    <select name="division_id" id="division_id" data-control="select2" class="form-select" data-placeholder="Select Division" >
                                        <option></option>
                                        <?php if(@$divisions) { ?>
                                            <?php foreach ($divisions as $key => $division) { ?>
                                                <option value="<?= @$division->division_id; ?>" <?= $user->division == $division->division_id ? 'selected' : ''; ?>><?= @$division->division_name; ?></option>
                                        <?php }} ?>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label for="level" class="form-label fw-bold">Level</label>
                                    <select name="level" id="level" data-control="select2" class="form-select" data-placeholder="Select Level" >
                                        <option></option>
                                        <option value="ADMIN" <?= $user->level == 'ADMIN' ? 'selected' : ''; ?>>ADMIN</option>
                                        <option value="USER" <?= $user->level == 'USER' ? 'selected' : ''; ?>>USER</option>
                                    </select>
                                </div>
        
                                <input type="hidden" name="created_by" id="created_by" value="<?= session()->get('user_id') ?>" readonly>
                                <input type="hidden" name="pictureFileName" id="pictureFileName" value="-" readonly>
                            </div>
                        </div>
                        <div class="card-footer d-flex flex-column flex-lg-row justify-content-center justify-content-lg-end gap-2">
                            <a href="<?= base_url('user'); ?>" class="btn btn-danger fw-bold col-12 col-lg-2 order-2 order-lg-first">Cancel</a>
                            <!-- <button type="button" id="submit" class="btn btn-primary fw-bold">Update</button> -->
                            <button type="submit" class="btn btn-primary fw-bold col-12 col-lg-2 order-1" id="submitForm">
                                <!--begin::Indicator label-->
                                <span class="indicator-label fw-bold">Update</span>
                                <!--end::Indicator label-->
                                <span class="indicator-progress">Please Wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
		</div>
		<!--end::Post-->

<?= $this->endSection('content') ?>