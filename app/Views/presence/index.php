<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

    <!--begin::Container-->
	<div class="d-flex flex-column flex-column-fluid container-fluid">
		<!--begin::Toolbar-->
		<div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
			<!--begin::Page title-->
			<div class="page-title d-flex flex-column me-3">
				<!--begin::Title-->
				<h1 class="d-flex text-dark fw-bold my-1 fs-1">Presence</h1>
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
                <form enctype="multipart/form-data" method="POST" id="FormPresence">
                    <div class="card-body">
                        <div class="d-flex flex-column gap-4">
                            <div class="col-12">
                                <label for="picture" class="form-label fw-bold">Picture</label>
                                <!--begin::Dropzone-->
                                <div class="dropzone" id="dropzonePicture">
                                    <!--begin::Message-->
                                    <div class="dz-message needsclick">
                                        <i class="ki-duotone ki-file-up fs-3x text-primary">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
    
                                        <!--begin::Info-->
                                        <div class="ms-4">
                                            <h3 class="fs-5 fw-bold text-gray-900 mb-1">Drop files here or click to upload.</h3>
                                            <span class="fs-7 fw-semibold text-gray-500">Upload up to 10 files</span>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                </div>
                                <!--end::Dropzone-->
                            </div>
    
                            <div class="col-12">
                                <label for="name" class="form-label fw-bold">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="<?= session()->get('fullname') ?>">
                            </div>
    
                            <div class="col-12">
                                <label for="date" class="form-label fw-bold">Date & Time</label>
                                <input type="text" name="date" id="date" class="form-control" placeholder="Pick Date & Time" readonly value="<?= date('d F Y H:i'); ?>">
                            </div>
    
                            <div class="col-12">
                                <label for="" class="form-label fw-bold">Location</label>
                                <div class="d-flex gap-2">
                                    <input type="text" name="location" id="location" class="form-control" placeholder="" value="" readonly>
                                    <button type="button" id="buttonGetLocation" onclick="getLocation()" class="btn btn-icon btn-light btn-active-light-success col-1" title="Get Location">
                                        <span class="svg-icon svg-icon-muted svg-icon-2x">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.3" d="M21 11H18.9C18.5 7.9 16 5.49998 13 5.09998V3C13 2.4 12.6 2 12 2C11.4 2 11 2.4 11 3V5.09998C7.9 5.49998 5.50001 8 5.10001 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H5.10001C5.50001 16.1 8 18.4999 11 18.8999V21C11 21.6 11.4 22 12 22C12.6 22 13 21.6 13 21V18.8999C16.1 18.4999 18.5 16 18.9 13H21C21.6 13 22 12.6 22 12C22 11.4 21.6 11 21 11ZM12 17C9.2 17 7 14.8 7 12C7 9.2 9.2 7 12 7C14.8 7 17 9.2 17 12C17 14.8 14.8 17 12 17Z" fill="currentColor"/>
                                                <path d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z" fill="currentColor"/>
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                                <!-- <input type="text" name="" id="coords" class="form-control" value> -->
                            </div>
    
                            <div class="col-12">
                                <label for="remark" class="form-label fw-bold">Remark</label>
                                <select name="remark" id="remark" data-control="select2" class="form-select" data-placeholder="Select an option" >
                                    <option></option>
                                    <option value="Check In">Check In</option>
                                    <option value="Check Out">Check Out</option>
                                    <option value="Permit">Permit</option>
                                </select>
                            </div>
    
                            <input type="hidden" name="created_by" id="created_by" value="<?= session()->get('user_id') ?>" readonly>
                            <input type="hidden" name="pictureFileName" id="pictureFileName" value="-" readonly>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <button type="button" id="buttonSubmit" class="btn btn-primary fw-bold">Submit</button>
                    </div>
                </form>
            </div>
            
		</div>
		<!--end::Post-->

<?= $this->endSection('content') ?>