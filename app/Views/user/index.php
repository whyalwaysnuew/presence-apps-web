<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

    <!--begin::Container-->
	<div class="d-flex flex-column flex-column-fluid container-fluid">
		<!--begin::Toolbar-->
		<div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
			<!--begin::Page title-->
			<div class="page-title d-flex flex-column me-3">
				<!--begin::Title-->
				<h1 class="d-flex text-dark fw-bold my-1 fs-1">Users</h1>
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
                    <div class="table-responsive">
                        <table class="table table-row-dashed table-hover gs-5">
                            <thead class="bg-dark text-white fw-bold">
                                <tr>
                                    <th class="rounded-start align-middle text-center">No</th>
                                    <th class="align-middle">Name</th>
                                    <th class="align-middle text-center">Division</th>
                                    <th class="align-middle text-center">Level</th>
                                    <th class="rounded-end text-center align-middle">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(@$users) { ?>
                                    <?php foreach ($users as $key => $user) { ?>
                                        <tr class="align-middle">
                                            <td class="text-center"><?= $key+1; ?></td>
                                            <td>
                                                <?= @$user->fullname; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if (@$user->division_name) { ?>
                                                    <?= $user->division_name;?>
                                                <?php } else { ?>
                                                    <span class="text-danger">
                                                        <i>
                                                            No Division
                                                        </i>
                                                    </span>
                                                <?php } ?>
                                            </td>
                                            <td class="text-center">
                                                <?= @$user->level; ?>
                                            </td>
                                            <td class="text-center">
                                                <!-- <a href="<?= base_url('user/edit/') . $user->user_id; ?>" class="btn btn-icon btn-color-gray-400 btn-active-color-warning" title="Edit">
                                                    <span class="svg-icon svg-icon-2">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd" d="M2 4.63158C2 3.1782 3.1782 2 4.63158 2H13.47C14.0155 2 14.278 2.66919 13.8778 3.04006L12.4556 4.35821C11.9009 4.87228 11.1726 5.15789 10.4163 5.15789H7.1579C6.05333 5.15789 5.15789 6.05333 5.15789 7.1579V16.8421C5.15789 17.9467 6.05333 18.8421 7.1579 18.8421H16.8421C17.9467 18.8421 18.8421 17.9467 18.8421 16.8421V13.7518C18.8421 12.927 19.1817 12.1387 19.7809 11.572L20.9878 10.4308C21.3703 10.0691 22 10.3403 22 10.8668V19.3684C22 20.8218 20.8218 22 19.3684 22H4.63158C3.1782 22 2 20.8218 2 19.3684V4.63158Z" fill="currentColor"/>
                                                            <path d="M10.9256 11.1882C10.5351 10.7977 10.5351 10.1645 10.9256 9.77397L18.0669 2.6327C18.8479 1.85165 20.1143 1.85165 20.8953 2.6327L21.3665 3.10391C22.1476 3.88496 22.1476 5.15129 21.3665 5.93234L14.2252 13.0736C13.8347 13.4641 13.2016 13.4641 12.811 13.0736L10.9256 11.1882Z" fill="currentColor"/>
                                                            <path d="M8.82343 12.0064L8.08852 14.3348C7.8655 15.0414 8.46151 15.7366 9.19388 15.6242L11.8974 15.2092C12.4642 15.1222 12.6916 14.4278 12.2861 14.0223L9.98595 11.7221C9.61452 11.3507 8.98154 11.5055 8.82343 12.0064Z" fill="currentColor"/>
                                                        </svg>
                                                    </span>
                                                </a> -->
                                                <button id="delete-data" data-id="<?= $user->user_id; ?>" class="btn btn-icon btn-color-gray-400 btn-active-color-danger" title="Delete">
                                                    <span class="svg-icon svg-icon-2">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/>
                                                            <rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"/>
                                                            <rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"/>
                                                        </svg>
                                                    </span>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
		</div>
		<!--end::Post-->

<?= $this->endSection('content') ?>