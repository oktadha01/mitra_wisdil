<style>
    .row {
        margin-bottom: 1rem;
    }
</style>

<div class="container p-0">
    <form id="save-event" class="box-form mb-3" hidden>
        <div class="row">
            <div class="col">
                <i>"Biaya sistem tiketing untuk satu event adalah Rp 2.500.000. Namun, dengan diskon 50%, total biaya yang harus dibayarkan hanya Rp 1.250.000 per event. Silahkan Ajukan Event Anda"</i>
                <hr>
            </div>
        </div>
        <h5 class="font-weight-bold ml-3 mb-3"><i class="bi bi-person-vcard text-form-agency"> Form Input agency</i> </h5>
        <div class="row ">
            <div class="col-lg-3 col-md-3 col-12 mb-3">
                <div class="input-wrapper ml-0 mr-0">
                    <label class="label-select2">Agency <sup class="text-danger font-weight-bold">*</sup></label>
                    <select class="select2 w-100" style="height:55px;" id="select-agency" required>
                        <option value=''>-- Select City --</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-6 mb-3">
                <div class="input-group">
                    <input type="text" id="email" class="col" required>
                    <label class="label-in">Email <sup class="text-danger font-weight-bold">*</sup></label>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-6 mb-3">
                <div class="input-group">
                    <input type="text" id="kontak" class="col" required>
                    <label class="label-in">No. WhatsApp <sup class="text-danger font-weight-bold">*</sup></label>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-12">
                <div class="input-group">
                    <input type="text" id="alamat-agency" class="col" required>
                    <label class="label-in">Address <sup class="text-danger font-weight-bold">*</sup></label>
                </div>
            </div>
        </div>
        <hr>
        <h5 class="font-weight-bold ml-3 mb-3"><i class="bi bi-calendar2-event text-form-event"> Form Input Event</i></h5>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-12 mb-3">
                <div class="input-wrapper">
                    <input type="text" id="nm-event" class="" required>
                    <label class="label-in">Event Name <sup class="text-danger font-weight-bold">*</sup></label>
                </div>
            </div>
            <div class=" col-lg-3 col-md-6 col-12 mb-3">
                <div class="input-wrapper">
                    <label class="label-select">Select Category <sup class="text-danger font-weight-bold">*</sup></label>
                    <select type="text" id="kategori-event" class="" required>
                        <option value="">-- Select Category --</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-6 mb-3">
                <div class="input-wrapper">
                    <input data-provide="datepicker" data-date-autoclose="true" type="text" id="tgl-event" class="col" required>
                    <label class="label-in">Date <sup class="text-danger font-weight-bold">*</sup></label>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-6 mb-3">
                <div class="input-wrapper">
                    <input type="time" class="col time24" id="jam-event" required>
                    <label class="label-in">clock <sup class="text-danger font-weight-bold">*</sup></label>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-6 mb-3">
                <div class="input-wrapper">
                    <input type="text" id="mc" class="col" required>
                    <label class="label-in">MC <sup class="text-danger font-weight-bold">*</sup></label>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-6 mb-3">
                <div class="input-wrapper">
                    <input type="text" id="lokasi" class="col" required>
                    <label class="label-in">Location <sup class="text-danger font-weight-bold">*</sup></label>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12 mb-3">
                <div class="input-wrapper">
                    <label class="label-select2">Select City <sup class="text-danger font-weight-bold">*</sup></label>
                    <select class="select2 w-100" style="height:55px;" id="kota" required>
                        <option value=''>-- Select City --</option>
                    </select>
                </div>
            </div>
        </div>
        <div class=" row">
            <div class="col-12">
                <div class="input-wrapper">
                    <textarea type="text" id="alamat" class="" required></textarea>
                    <label class="label-in">Address <sup class="text-danger font-weight-bold">*</sup></label>
                </div>
            </div>
        </div>
        <div class=" row">
            <div class="col-md-12 pl-4 pr-4">
                <textarea id="summernote"></textarea>
            </div>
        </div>
        <div class=" row clearfix row mb-1 mt 2">
            <div class="col-lg-6 col-md-6">
                <div id="body-file-pdf" class="card-body">
                    <div class="row li-list p-2 mb-3">
                        <div class="align-content-around col-2 pl-0">
                            <span class="bg-border-span"><i class="bi bi-filetype-pdf"></i></span>
                        </div>
                        <div class="col-6 p-0 align-content-center">
                            <h6 class="mb-0 font-weight-bold">file Proposal</h6>
                            <span class="small border-radius-gray text-file-pdf">text file pdf</span>
                        </div>
                        <div class="align-content-center align-right col-4 p-0">
                            <button class="btn btn-sm btn-warning font-weight-bold btn-ubah-pdf" value="0">Change</button>
                        </div>
                    </div>
                </div>
                <div id="form-upload-pdf" class="card mb-0">
                    <div class="header pt-2 pb-0">
                        <label class="label-up">Upload Proposal <sup class="text-danger font-weight-bold">*</sup></label>
                    </div>
                    <div class="body pt-2">
                        <i class="font-10">File PDF Max 10MB<sup class="text-danger">*</sup></i>
                        <input type="file" class="dropify" id="proposal" accept="application/pdf" required>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-6 pl-4">
                <button class="btn col btn-danger batal">Cencel <i class="bi bi-x-circle"></i></button>
            </div>
            <div class="col-6 pr-4">
                <button type="submit" class="btn col btn-success simpan" data-action="simpan">Save <i class="bi bi-cloud-arrow-up"></i></button>
            </div>
        </div>
    </form>
</div>
<div class="container">
    <div class="row">
        <div class="col-12 p-1">
            <button class="col-12 btn btn-info btn-tambah-event"> Create an Event <i class="bi bi-patch-plus"></i></button>
        </div>
        <div class="col-12 p-1">
            <div class=" search mb-3">
                <input type="text" id="searchInput" placeholder="Search...">
                <button><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <ul id="load-data-event" class="list-group d-block">

    </ul>
</div>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Detail Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-12">
                        <ul class="list-inline">
                            <li class="text-muted"><i>Agency</i></li>
                            <li id="li-text-agency" class="li-border-text">
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-4 col-md-4 col-6">
                        <ul class="list-inline">
                            <li class="text-muted"><i>Email</i></li>
                            <li id="li-text-email" class="li-border-text">
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-4 col-md-4 col-6">
                        <ul class="list-inline">
                            <li class="text-muted"><i>No. WhatsApp</i></li>
                            <li id="li-text-kontak" class="li-border-text">
                            </li>
                        </ul>
                    </div>
                    <div class="col-12">
                        <ul class="list-inline">
                            <li class="text-muted"><i>Address</i></li>
                            <li id="li-text-alamatuser" class="li-border-text">
                            </li>
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-6">
                        <ul class="list-inline">
                            <li class="text-muted"><i>Event</i></li>
                            <li id="li-text-event" class="li-border-text">
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-3 col-6">
                        <ul class="list-inline">
                            <li class="text-muted"><i>Kategory Event</i></li>
                            <li id="li-text-kategori-event" class="li-border-text">
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-3 col-4">
                        <ul class="list-inline">
                            <li class="text-muted"><i>Date</i></li>
                            <li id="li-text-tgl" class="li-border-text">
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-3 col-3">
                        <ul class="list-inline">
                            <li class="text-muted"><i>O'clock</i></li>
                            <li id="li-text-jam" class="li-border-text">
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-3 col-5">
                        <ul class="list-inline">
                            <li class="text-muted"><i>MC</i></li>
                            <li id="li-text-mc" class="li-border-text">
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-3 col-6">
                        <ul class="list-inline">
                            <li class="text-muted"><i>Location</i></li>
                            <li id="li-text-lokasi" class="li-border-text">
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-3 col-6">
                        <ul class="list-inline">
                            <li class="text-muted"><i>City</i></li>
                            <li id="li-text-kota" class="li-border-text">
                            </li>
                        </ul>
                    </div>
                    <div class="col-12">
                        <ul class="list-inline">
                            <li class="text-muted"><i>Address</i></li>
                            <li id="li-text-alamatevent" class="li-border-text">
                            </li>
                        </ul>
                    </div>
                    <div class="col-12">
                        <ul class="list-inline">
                            <li class="text-muted"><i>Description</i></li>
                            <li id="li-text-desk" class="li-border-text pl-4 w-100">
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <ul class="list-inline">
                            <li class="text-muted"><i>Proposal</i></li>
                            <li class="li-border-text"><a id="li-a-proposal" target="_blank">Porosal</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-inline">
                <div class="row">
                    <div class="col-8 p-0">
                        <button type="button" class="btn btn-warning edit-event mr-3" data-dismiss="modal">Edit Data</button>
                    </div>
                    <div class="col-4 p-0">
                        <button type="button" class="btn btn-default float-right" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>