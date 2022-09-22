<?php use App\Http\Controllers\HelpersController as Helpers; 
$haveaccessadd = Helpers::checkaccess('purchaseorders', 'add');
$haveaccessdelete = Helpers::checkaccess('purchaseorders', 'delete');
?>

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

<style>
    .animate-charcter
{
   text-transform: uppercase;
  background-image: linear-gradient(
    -225deg,
    #231557 0%,
    #44107a 29%,
    #ff1361 67%,
    #fff800 100%
  );
  background-size: auto auto;
  background-clip: border-box;
  background-size: 200% auto;
  font-family: 'Times New Roman', Times, serif;
  color: #fff;
  background-clip: text;
  text-fill-color: transparent;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  animation: textclip 2s linear infinite;
  display: inline-block;
      font-size: 30px;
}

@keyframes textclip {
  to {
    background-position: 200% center;
  }
}

</style>
@endsection

<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight hetf2"><i class="fa fa-plus"></i>
            {{ __('Purchase Orders') }} <?php if($haveaccessadd): ?> 
            <button type="button" id="btnAdd" class="btn btn-sm btn-success m-2" data-toggle="modal" data-target="#addUser">
                <i class="fa fa-plus me-2"></i>Create Purchase Orders   
            </button> <?php endif; ?>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{-- table --}}
                    <div class="table-responsive">
                        <table id="datastable" class="table text-start table-striped align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr>
                                    <td></td>
                                    <td><input type="text" class="form-control input-sm src_class_user" autocomplete="off" onkeyup="searcAjax(this)" placeholder="No Surat Jalan" name=""></td>
                                    <td><input type="text" class="form-control input-sm src_class_user" autocomplete="off" onkeyup="searcAjax(this)" placeholder="Jumlah Pre Order" name=""></td>
                                    <!--  <td><input type="text" class="form-control input-sm src_class_user" autocomplete="off" onkeyup="searcAjax(this)" placeholder="Barang Bagus" name=""></td>
                                    <td><input type="text" class="form-control input-sm src_class_user" autocomplete="off" onkeyup="searcAjax(this)" placeholder="Code Product" name=""></td> -->
                                    <td><input type="text" class="form-control input-sm src_class_user" autocomplete="off" onkeyup="searcAjax(this)" placeholder="Catatan" name=""></td>
                                    <td><input type="text" class="form-control input-sm src_class_user" autocomplete="off" onkeyup="searcAjax(this)" placeholder="Flag" name=""></td> 
                                    <td></td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th class="align-center">No PO</th>
                                    <th class="align-center">No Surat Jalan</th>
                                    <th class="align-center">Catatan</th>
                                    <th class="align-center">Flag</th>
                                    <th class="align-center">Action</th>
                                    <!-- <th></th> -->
                                   <!-- <th></th> -->
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th class="align-center">No PO</th>
                                    <th class="align-center">No Surat Jalan</th>
                                    <th class="align-center">Catatan</th>
                                    <th class="align-center">Flag</th>
                                    <th class="align-center">Action</th>
                                    <!-- <th></th> -->
                                   <!-- <th></th> -->
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    {{-- table --}}
                </div>
            </div>
        </div>
    </div>

    {{-- CREATE --}}
    @if ($haveaccessadd) 
    <div class="modal fade" style="background: rgba(0, 0, 0, 0.7);" id="viewad" tabindex="-1" role="dialog" aria-labelledby="viewTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex right-content-lg-start">
                    <h5 class="modal-title" id="ModalLongTitle"></h5>
                    <button type="button" class="close-modal btn btn-sm btn-danger close closeModalad" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade active show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                           
                            <form id="smbtn" enctype="multipart/form-data"> 
                                @csrf
                                <input type="hidden" id="id" class="inpt-cst-add" name="id">
                                <div class="form-group">
                                    <label for="no_purchase_order" class="form-label">No P O *</label>
                                    <input type="text" class="form-control inpt-cst-add mb-2" name="no_purchase_order" id="no_purchase_order" placeholder="No P O" autocomplete="off">
                                </div>  
                                <div class="form-group">
                                    <label for="suratjalan" class="form-label">No Surat Jalan *</label>
                                    <input type="text" class="form-control inpt-cst-add mb-2" name="suratjalan" id="suratjalan" placeholder="No Surat Jalan" autocomplete="off">
                                </div> 

                                <div class="form-group">
                                    <label for="deskripsi_po" class="form-label">Deskripsi</label>
                                    <textarea name="deskripsi_po" class="form-control inpt-cst-add mb-2" id="deskripsi_po" cols="10" rows="6"></textarea>
                                </div>

                                <div class="input-group mb-2">
                                    <label for="" class="form-label">Cari Produk
                                        <small style="color:white; visibility: hidden;">
                                            {{-- *(P-01 : Produk Basah | P-02 : Produk Padat | P-03 : Produkaaaaaaaaaaaaaaa)* --}}
                                            *(P-01 : Produk Basah | P-02 : Produk Padat | P-03 : Produk CairaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaCairaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa)* 
                                        </small>
                                    </label>
                                    <input type="text" name="search" id="produkId" class="form-control produkId" placeholder="Cari Produk" autocomplete="off">
                                    <input type="text" name="search" id="paketId" class="form-control paketId" placeholder="Cari Produk" autocomplete="off">
                                    <button type="button" class="btn btn-primary">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>

                                <div class="form-group">
                                    <div id="produk_list" class="produk_list"></div><div id="produk_list_paket" class="produk_list_paket" style="margin-top: 20px"></div>
                                    
                                </div>
                                
                                {{-- <input type="hidden" name="user_group" id="user_group"> --}}
                                
                                <input type="hidden" name="user_group" id="user_group" class="user_group">
                                <input type="hidden" name="user_group_paket" id="user_group_paket" class="user_group_paket">

                                <div class="d-flex justify-content-end">
                                    <div class="control-group after-add-more">
                                        <div class="copy control-group"></div>
                                    </div>
                                </div><br>

                                {{-- tabel --}}
                                <table id="listProdukTable" class="table text-start table-striped align-middle table-bordered table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>Code</th>
                                            <th class="align-center">Nama Produk</th>
                                            <th>Qty</th> 
                                            <th>Action</th> 
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Code</th>
                                            <th class="align-center">Nama Produk</th>
                                            <th>Qty</th> 
                                            <th>Action</th> 
                                        </tr>
                                    </tfoot>
                                </table>
                                {{-- tabel --}}                               

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm closeModalad" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" id="addvbtn" data-attid="" class="btn btn-success btn-sm"></button>
                                    <button type="submit" id="addkarantinavbtn" data-attid="" class="btn btn-info btn-sm ">Save Karantina</button>
                                </div>
                            </form>
                            {{--  --}}
                        </div>               
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- CREATE --}}


    {{-- DETAIL --}}
    <div class="modal fade" id="view" tabindex="-1" role="dialog" aria-labelledby="viewTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                {{-- MODAL BODY --}}
                <div class="modal-body">
                    <ul class="nav nav-pills mb-10" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="btnproduct" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Modal Details Info</button>
                        </li>
                        {{-- <li class="nav-item" role="presentation" style="margin-left:20px; background-color:aqua;">
                            <button class="nav-link active" style="background-color:aqua; color:black" id="btnpaket" data-attid="" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Paket Details Info</button>
                        </li> --}}
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade active show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <dl class="row mt-5">
                  

                                <dt class="col-sm-4 show_name">Surat Jalan </dt>
                                <dd class="col-sm-8 show_name">: <span name="name" id="surat_po"></dd>
                                    
                                    <dt class="alias_gudang col-sm-4">No Purchase </dt>
                                    <dd class="alias_gudang col-sm-8">: <span name="email" id="surat_jalan"></dd>
                                        

                            </dl>
                            
                            <i><b><p class=" mb-3" id="surat_jalan"></p></b></i>  </center> 
                            <table class="table table-striped" id="table_detail">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th class="title-code"></th>
                                        <th scope="col" class="title-detail"></th>
                                        <th scope="col" class="title-qty"></th>
                                        {{-- <th scope="col">Barang Bagus</th> --}}
                                        {{-- <th scope="col">Code Product</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    {{--  --}}
                                </tbody>
                            </table>
                            {{--  --}}
                        </div>
                    </div>
                </div>
                {{-- MODAL BODY --}}

                {{-- y --}}
                <div class="modal-footer"> 
                    <button id="closeModal" type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                        Close                        
                    </button>
                    @if ($haveaccessadd)
                        <span id="editvbtn" data-attid="" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>Edit Purchase Order</span>
                        <!-- <span id="editvbtnpaket" data-attid="" class="btn btn-info btn-sm"><i class="fa fa-edit"></i>Edit Purchase Paket</span> -->

                    @endif

                    @if ($haveaccessdelete)
                    
                    <button onClick="deleteyesshow()" data-attid="" data-deleteval="1" id="deletevbtn" class="btn btn-danger btn-sm"></a>
                        <button onClick="undeleteyesshow()" data-attid="" data-deleteval="0" id="undeletevbtn" class="btn btn-success btn-sm"></a>                    
                    @endif
                </div>

            </div>
        </div>
    </div>




    <div class="modal fade" id="viewpaket" tabindex="-1" role="dialog" aria-labelledby="viewTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                {{-- MODAL BODY --}}
                <div class="modal-body">
                    <ul class="nav nav-pills mb-10" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="btnproduct" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Modal Details Info</button>
                        </li>
                        {{-- <li class="nav-item" role="presentation" style="margin-left:20px; background-color:aqua;">
                            <button class="nav-link active" style="background-color:aqua; color:black" id="btnpaket" data-attid="" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Paket Details Info</button>
                        </li> --}}
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade active show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <dl class="row mt-5">
                  

                                <dt class="col-sm-4 show_name">Surat Jalan </dt>
                                <dd class="col-sm-8 show_name">: <span name="name" id="surat_po"></dd>
                                    
                                    <dt class="alias_gudang col-sm-4">No Purchase </dt>
                                    <dd class="alias_gudang col-sm-8">: <span name="email" id="surat_jalan"></dd>
                                        

                            </dl>
                            
                            <i><b><p class=" mb-3" id="surat_jalan"></p></b></i>  </center> 
                            <table class="table table-striped" id="table_detail">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th class="title-code"></th>
                                        <th scope="col" class="title-detail"></th>
                                        <th scope="col" class="title-qty"></th>
                                        {{-- <th scope="col">Barang Bagus</th> --}}
                                        {{-- <th scope="col">Code Product</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    {{--  --}}
                                </tbody>
                            </table>
                            {{--  --}}
                        </div>
                    </div>
                </div>
                {{-- MODAL BODY --}}

                {{-- y --}}
                <div class="modal-footer"> 
                    <button id="closeModal" type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                        Close                        
                    </button>
                    @if ($haveaccessadd)
                        <span id="editvbtn" data-attid="" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>Edit Purchase Order</span>
                        <!-- <span id="editvbtnpaket" data-attid="" class="btn btn-info btn-sm"><i class="fa fa-edit"></i>Edit Purchase Paket</span> -->

                    @endif

                    @if ($haveaccessdelete)
                    
                    <button onClick="deleteyesshow()" data-attid="" data-deleteval="1" id="deletevbtn" class="btn btn-danger btn-sm"></a>
                        <button onClick="undeleteyesshow()" data-attid="" data-deleteval="0" id="undeletevbtn" class="btn btn-success btn-sm"></a>                    
                    @endif
                </div>

            </div>
        </div>
    </div>
    {{-- DETAIL --}}

@section('script')

<script type="text/javascript">

// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    // FUNCTION UNTUK SEARCH
    var url = "{{ asset('/api/purchaseorders/getdata') }}";
    function searcAjax(a, skip = 0) {
        if ($(a).val().length > global_length_src || skip == 1) {
            var getparam = getAllClassAndVal("src_class_user"); // helpers
            $('#datastable').DataTable().ajax.url(url + "?" + getparam).load();
        }else{
            $('#datastable').DataTable().ajax.url(url).load();
        }
    }
    // FUNCTION UNTUK SEARCH

    // FUNCTION SECARA GLOBAL
    $(".closeModalad").click(function(){
        $("#viewad").modal('hide');
    });
    // FUNCTION SECARA GLOBAL
    
// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    // FUNCTION UNTUK MENAMPIKAN DATA DI DALAM TABLE 
    $(document).ready(function() {
        var table = $('#datastable').DataTable({
            ajax: url,
            createdRow: function(row, data, dataIndex, cells) {
            

                if(data[4] == 1)
                $(row).addClass('warning');
                else
                $(row).removeClass('warning');
            },
            columnDefs: [
                // {
                //     'targets': 2,
                //     'searchable':false,
                //     'orderable':false,
                //     'className': 'dt-body-center',
                //     'render': function(data, type, full, meta) 
                //     {
                //         return '<tbody>' + full[2] + '</tbody>';
                //     }
                // },
                // {
                //     'targets': 3,
                //     'searchable':false,
                //     'orderable':false,
                //     'className': 'dt-body-center',
                //     'render': function(data, type, full, meta) 
                //     {
                //         return '<tbody>' + full[3] + '</tbody>';
                //     }
                // }, 
                // {
                //     'targets': 4,
                //     'searchable':false,
                //     'orderable':false,
                //     'className': 'dt-body-center',
                //     'render': function(data, type, full, meta) 
                //     {
                //         return '<tbody>' + full[4] + '</tbody>';
                //     }
                // },
                {
                    'targets': 4,
                    'className': 'dt-body-center',
                    'render': function(data, type, full, meta) 
                    {                 
                        if(full[4] == 0)
                            return '<span class="btn btn-success btn-sm">Ready</span>';
                        else 
                            return '<span class="btn btn-danger btn-sm">Deleted</span>';
                    }
                },
                {
                    'targets': 5,
                    'searchable':false,
                    'orderable':false,
                    'className': 'dt-body-center',
                    'render': function(data, type, full, meta) 
                    {
                        if(full[6] == 0)
                        return '<span class="btn btn-success btn-sm" onclick="showdetail('+full[5]+')">details</span>';             
                        else        
                        return '<span class="btn btn-info btn-sm" onclick="showdetailpaket('+full[5]+')">details</span>';     
                        // console.log(full);
                    }
                },
            ],
            searching: false,
        
        });
    });
    $('#closeModal').on('click', function(){
        $('#view').modal('hide');
    });
    // FUNCTION UNTUK MENAMPIKAN DATA DI DALAM TABLE 

// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    // UNTUK MEMBUKA MODAL ADD
    $("#btnAdd").click(function() 
    {
        clearInput("inpt-cst-add");

        $('#viewad').modal('show');
        $("#user_group").val("");

        $('#user_group').hide();
        $("#produkId").val("");
        $("#user_group_paket").val("");
        $("#paketId").val("");
        $("#id_paket").val("");
        $('.copy').html("");
        $('.produk_list').html("");
        $(".control-group after-add-more").html("");  

        $("#ModalLongTitle").html("Purchase Orders Tambah"); 
        $("#addvbtn").html('<i class="fa fa-plus"></i> Add Purchase Orders');
        $("#addkarantinavbtn").html('<i class="fa fa-plus"></i> Save Karantina');
        
        var table3 = document.querySelector("#listProdukTable tbody");
        table3.innerHTML= "";

    });
    // UNTUK MEMBUKA MODAL ADD

// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    // FUNCTION UNTUK SUBMIT
    $("#smbtn").submit(function(e)
    {
        /////////////////////////////
        e.preventDefault();
        var id = $("#id").val();

        var url = "{{ asset('api/purchaseorders/insertdata') }}";
        if(id != '') 
            var url = "{{ asset('api/purchaseorders/updatedata') }}/" + id;
        
        var form = $("#smbtn");
        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(),
            dataType: 'JSON',
            enctype: 'multipart/form-data',
            success: function(response) 
            {
                data = response.data;

                if (data == 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Save',
                        html:'Your data has been <b>Saved</b>'
                    });
                    $("#viewad").modal('hide'); // tutup modal sesudah create
                }
                else {
                    $.each(response.errors, function(key, value) {
                        Swal.fire({
                            title: 'Gagal',
                            text: value,
                            icon: 'error'
                        });
                    });
                }
                
                var url = "{{ asset('/api/purchaseorders/getdata') }}";
                $('#datastable').DataTable().ajax.url(url).load();
            },
            error: function(jqXHR, textStatus, errorThrown) 
            {
                console.log(textStatus, errorThrown);
            }
            
        });

    });
    // FUNCTION UNTUK SUBMIT

    $("#addkarantinavbtn").click(function(e)
    {
        e.preventDefault();
        var id = $("#id").val();

        var url = "{{ asset('api/purchaseorders/insertdatakarantina') }}";

        if(id != '') 
            var url = "{{ asset('api/purchaseorders/updatedatakarantina') }}/" + id;
        
        var form = $("#smbtn");
        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(),
            dataType: 'JSON',
            enctype: 'multipart/form-data',
            success: function(response) 
            {
                data = response.data;

                if (data == 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Save',
                        html:'Your data has been <b>Saved</b>'
                    });
                    $("#viewad").modal('hide'); // tutup modal sesudah create
                }
                else {
                    $.each(response.errors, function(key, value) {
                        Swal.fire({
                            title: 'Gagal',
                            text: value,
                            icon: 'error'
                        });
                    });
                }
                
                var url = "{{ asset('/api/purchaseorders/getdata') }}";
                $('#datastable').DataTable().ajax.url(url).load();
            },
            error: function(jqXHR, textStatus, errorThrown) 
            {
                console.log(textStatus, errorThrown);
            }
            
        });

    });
// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    // FITUR SEARCH
    $('#produkId').keyup(function() {
        var path = "{{ asset('/api/purchaseorders/search') }}"; // url untuk Request Search
        var query = $(this).val();  
        $('#produk_list_paket').hide(); 
        $('#produk_list').show(); 

        if(query != '')  
        {
            $.ajax({
                url: path,  
                method:"GET",  
                data:{query:query},  
                success:function(data) 
                {
                    htmls1 = '<label for = "id_user" class="close-select-paket">Search Product : </label><select class="list-unstyled form-control form-group col-sm-8" id="id_user" name="selectproduct" onchange="onchangeTabel(this)">';
                    $.each(data, function (key, item) {
                        // console.log(item);
                        htmls1 += "<option value=\""+item.id+"\">"+item.kode_products+"</option>";  
                    });

                    htmls1 += '<option value="" selected>-- Select Product --</option></select>';
                    $('#produk_list').html(htmls1);  

                } 
            });
        }

        if (query == '') {
            $('#produk_list').html('<select class="list-unstyled form-control"><option value="">-- Select Product --</option></select>')  
        }
        else{
            $('#produk_list').html('<select class="list-unstyled form-control"><option value="">-- Select Product --</option></select>')     
        }
    });

    $('#paketId').keyup(function() {
        var path = "{{ asset('/api/purchaseorders/searchpaket') }}"; // url untuk Request Search
        var query = $(this).val();  
        $('#produk_list').hide(); 
        $('#produk_list_paket').show(); 
        if(query != '')  
        {
            $.ajax({
                url: path,  
                method:"GET",  
                data:{query:query},  
                success:function(data) 
                {
                    // console.log(data);
                    htmls1 = '<label for = "id_paket" class="close-select-paket">Search Paket : </label><select class="list-unstyled close-select-paket form-control form-group col-sm-8" id="id_paket" name="selectproductpaket" onchange="onchangeTabelpaket(this)">';
                    $.each(data, function (key, item) {
                        // console.log(item);
                        htmls1 += "<option value=\""+item.id+"\">"+item.kode_package+"</option>";  
                    });

                    htmls1 += '<option value="" selected>-- Select Paket --</option></select>';
                    $('#produk_list_paket').html(htmls1);  
                    $('.close-product').show();

                } 
            });
        }

        if (query == '') {
            $('#produk_list_paket').html('<select class="list-unstyled form-control"><option value="">-- Select Paket --</option></select>')  
        }
        else{
            $('#produk_list_paket').html('<select class="list-unstyled form-control"><option value="">-- Select Paket --</option></select>')     
        }
    });
    // FITUR SEARCH

// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    // ONCHANGE TABEL
    function onchangeTabel(a) 
    {
        id = $(a).val();
        var hidden = $("#user_group").val();
        var tampung = hidden + ',p ' + id;

        nama = $("#id_user option:selected").text();
        const pattern = new RegExp('(p ' + id + ')', 'gm');
        let m;
        var table3 = document.querySelector("#listProdukTable tbody");
        if(m = pattern.exec(hidden) == null) 
        {
            $("#user_group").val(tampung);

            var url = "{{ asset('/api/purchaseorders/getdataId') }}/"+id; // Table Create
            $.ajax({
                url: url,
                type: "GET",
                success: function(response) {
                    var htmlinput = '<tr class="row-p'+response.data[0][7]+'" id="row-'+response.data[0][7]+'">\
                        <td><span class="badge bg-info deletee badge-sm me-3" style="color:black">Product</span>'+response.data[0][1]+'</td>\
                        <td>'+response.data[0][2]+'</td>\
                        <td class=" dt-body-center">\
                            <div class="form-group row">\
                                <div class="col-xs-2 divv"><input type="number"  placeholder="0" name="jumlah_produk[\'id\']['+response.data[0][7]+']" id="jumlah_produk-'+response.data[0][7]+'" class="class-oldd form-group form-control jumlah_produk"></div>\
                            </div>\
                        </td>\
                        <td class="  dt-body-center">\
                            <span class="btn btn-danger deletee btn-sm" onclick="kurangininput('+response.data[0][7]+')">\
                                <i class="fa-solid fa-trash-can"></i>\
                            </span>\
                        </td>\
                        </tr>';
                        
                        // const regex = new RegExp('(row-p' + id + ')', 'gm');
                        // let m;
                        
                        // if(regex.exec(table3.innerHTML) == null)
                        table3.innerHTML = table3.innerHTML + htmlinput;
                        
                        
                    }
                });
            } else {
            Swal.fire({
                icon: 'danger',
                title: 'Warning',
                html:'Data <b>Sudah ada</b>'
            });
        }
        
    }
    $('.class-oldd ').on('keyup', function (event) {
                if(event.isTrigger && event.keycode) this.value +=  String.fromCharCode(event.keycode);
                $('.divv').html($('.class-oldd ').val());
            });

            var e = $.Event('keyup', {
                keycode: 68
            });
            $('.class-oldd ').trigger(e);

    function onchangeTabelpaket(a) 
    {
        id = $(a).val();
        var hidden = $("#user_group").val();
        var tampung = hidden + ',pk ' + id;
        // nama = $( "#id_paket option:selected" ).text();
        const pattern = new RegExp('(pk ' + id + ')', 'gm');
        let m;
        var tablepaket = document.querySelector("#listProdukTable tbody");
        if(m = pattern.exec(hidden) == null) {
            $("#user_group").val(tampung);
        
        var url = "{{ asset('/api/purchaseorders/getdataIdPaket') }}/"+id; // Table Create
        $.ajax({
            url: url,
            type: "GET",
            cache: false,
            success: function(response) { 
            // console.log(response.data[0]);
                var htmlinput = '<tr class="row-pk'+response.data[0][5]+'" id="row-'+response.data[0][5]+'">\
                        <td><span class="badge bg-info deletee badge-sm me-3" style="color:black">Paket</span>'+response.data[0][1]+'</td>\
                        <td>'+response.data[0][2]+'</td>\
                        <td class=" dt-body-center">\
                        <div class="form-group row">\
                            <div class="col-xs-2"><input type="number" placeholder="0" name="jumlah_paket[\'id\']['+response.data[0][5]+']" id="jumlah_paket-'+response.data[0][5]+'" class="class-oldd form-group form-control jumlah_paket"></div>\
                        </div>\
                    </td>\
                        <td class="  dt-body-center"><span class="btn btn-danger deletee btn-sm" onclick="kurangininputpaket('+response.data[0][5]+')"><i class="fa-solid fa-trash-can"></i></span></td>\
                    </tr>';
                // const regex = new RegExp('(row-pk' + id + ')', 'gm');
                // let m;
                // if(regex.exec(tablepaket.innerHTML) == null)
                    tablepaket.innerHTML = tablepaket.innerHTML + htmlinput;
                }
            });
        }else {
                Swal.fire({
                    icon: 'error',
                    title: 'Warning',
                    html:'<b>Produk Sudah Ada</b>'
                });
            }
    }
    // ONCHANGE TABEL

// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //  
    function kurangininput(a) 
    { 
        var tampung = $("#user_group").val();
        tampung = tampung.replace(",p "+a, "");
        $("#user_group").val(tampung);
        var rowid = '.row-p'+a; // untuk hapus row 
        // var table = $('#listProdukTable').DataTable();
        $(".row-p"+a).remove();

        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            html:'Data Berhasil <b>Dihapus</b>'
        });
    }
 

    function kurangininputpaket(a) 
    { 
        var tampung = $("#user_group").val();
        tampung = tampung.replace(",pk "+a, "");
        $("#user_group").val(tampung);
        var rowid = '.row-pk'+a; // untuk hapus row 
        // var table = $('#listProdukTable').DataTable();
        $(".row-pk"+a).remove();
 
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            html:'Data Berhasil <b>Dihapus</b>'
        });
    }
// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    $(document).ready(function() {
        var tableRow = $('#listProdukTable').DataTable(); 

        $('#listProdukTable tbody').on('click', 'tr', function() {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
            } else {
                tableRow.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        });
        $('.del').click(function () {
            tableRow.row('.selected').remove().draw(false);
        });
    });

// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    function showdetail(idx) 
    {
        $('#addvbtn').attr('data-attid', idx);
        $('#btnpaket').attr('data-attid', idx);
        $('#btnproduct').attr('data-attid', idx);
        $('.title-qty').html('Qty Product');
        $('.title-detail').html('Nama Product');
        $('.title-code').html('Code Product');
        $('#view').modal('show');

        $('#deletevbtn').attr('data-attid', idx);
        $('#deletevbtn').html('<i class="fa fa-trash"></i>Delete Purchase Order');
        $('#undeletevbtn').hide();



        $('#undeletevbtn').attr('data-attid', idx);
        $('#undeletevbtn').html('<i class="fa fa-repeat"></i> Undelete Purchase Order');
        
        var table3 = document.querySelector("#table_detail tbody");
        table3.innerHTML= "";
        
        var url = "{{ asset('/api/purchaseorders/detail') }}/" + idx; // Table View Details
        
        $.ajax({
            url: url,
            type: "GET",
            success: function(response) {
                var htmlInputTable = "";
                // console.log(response);
                data = response.datas;
                $('#surat_po').html(response.data[1])
                $('#surat_jalan').html(response.data[2])
                // $('#surat_jalan').html(response.data[3]])

                $.each(data, function (item, key) {
                    // console.log(key[4]);
                    // console.log(key);
                    htmlInputTable += '<tr class="row-'+key[5]+'" id="row-'+key[5]+'">\
                        <td class="sorting_1"> '+key[0]+'</td>\
                        <td> <span class="badge bg-info deletee badge-sm me-3" style="color:black">'+key[8]+'</span>'+key[1]+'</td>\
                        <td>'+key[2]+'</td>\
                        <td>'+key[3]+'</td>\
                    </tr>';
                    if(key[8] == 1){
                        $('#editvbtn').hide();
                        $('#deletevbtn').hide();
                    }
                    else{
                        $('#editvbtn').show();
                        $('#deletevbtn').show();
                        
                    }
                });
                table3.innerHTML = table3.innerHTML + htmlInputTable;

                // console.log(response.data);
                if(response.data[4] == 0)
                {
                    $("#deletevbtn").show();
                    $("#undeletevbtn").hide();
                    data = '<span id="activspan">-</span>';
                }

               else
                {
                    $("#deletevbtn").hide();
                    $("#undeletevbtn").show();
                    data = '<span id="activspan" style="color: #dc3545">deleted</span>';
                }
            },

            error: function(jqXHR, textStatus, errorThrown) 
            {
                console.log(textStatus, errorThrown);
            }
        });
    }

    function showdetailpaket(idx) 
    {
        $('#addvbtn').attr('data-attid', idx);
        $('#btnpaket').attr('data-attid', idx);
        $('#btnproduct').attr('data-attid', idx);
        $('.title-qty').html('Qty Product');
        $('.title-detail').html('Nama Product');
        $('.title-code').html('Code Product');
        $('#view').modal('show');

        $('#deletevbtn').attr('data-attid', idx);
        $('#deletevbtn').html('<i class="fa fa-trash"></i>Delete Purchase Order');
        $('#undeletevbtn').hide();



        $('#undeletevbtn').attr('data-attid', idx);
        $('#undeletevbtn').html('<i class="fa fa-repeat"></i> Undelete Purchase Order');
        
        var table3 = document.querySelector("#table_detail tbody");
        table3.innerHTML= "";
        
        var url = "{{ asset('/api/purchaseorders/detail') }}/" + idx; // Table View Details
        
        $.ajax({
            url: url,
            type: "GET",
            success: function(response) {
                var htmlInputTable = "";
                // console.log(response.data[5]);
                data = response.datas;
                $('#surat_po').html(response.data[1])
                $('#surat_jalan').html(response.data[2])
                if(response.data[5] == 1)
                $('#editvbtn').hide()
                $('#deletevbtn').hide()

                
                // $('#surat_jalan').html(response.data[3]])

                $.each(data, function (item, key) {
                    // console.log(key[4]);
                    // console.log(key);
                    htmlInputTable += '<tr class="row-'+key[5]+'" id="row-'+key[5]+'">\
                        <td class="sorting_1"><span class="badge bg-info deletee badge-sm me-3" style="color:black">Paket</span>'+key[0]+'</td>\
                        <td>'+key[1]+'</td>\
                        <td>'+key[2]+'</td>\
                        <td>'+key[3]+'</td>\
                    </tr>';
                    // if(key[8] == 1){
                    //     $('#editvbtn').hide();
                    //     $('#deletevbtn').hide();
                    // }
                    // else{
                    //     $('#editvbtn').show();
                    //     $('#deletevbtn').show();
                        
                    // }
                });
                table3.innerHTML = table3.innerHTML + htmlInputTable;

                if(data.flag_delete == 0)
                {
                    $("#deletevbtn").show();
                    $("#undeletevbtn").hide();
                    data = '<span id="activspan">-</span>';
                }

                if(data.flag_delete == 1)
                {
                    $("#deletevbtn").hide();
                    $("#undeletevbtn").show();
                    data = '<span id="activspan" style="color: #dc3545">deleted</span>';
                }
            },

            error: function(jqXHR, textStatus, errorThrown) 
            {
                console.log(textStatus, errorThrown);
            }
        });
    }

    $("#btnproduct").click(function()
    {
        $('#addvbtn').attr('data-attid', idx);
        $('#btnpaket').attr('data-attid', idx);
        $('.title-detail').html('Nama Product');
        $('.title-code').html('Code Product');
        $('.title-qty').html('Qty Product');
        // $('#editvbtn').show();
        $('#editvbtnpaket').hide()
        // $('#btnproduct').attr('data-attid', idx);
        var idx = $("#btnproduct").attr("data-attid"); 
        $('#view').modal('show');

        $('#deletevbtn').attr('data-attid', idx);
        $('#deletevbtn').html('<i class="fa fa-trash"></i>Delete Purchase Order');
        $('#undeletevbtn').hide();



        $('#undeletevbtn').attr('data-attid', idx);
        $('#undeletevbtn').html('<i class="fa fa-repeat"></i> Undelete Purchase Order');
        
        var table3 = document.querySelector("#table_detail tbody");
        table3.innerHTML= "";
        
        var url = "{{ asset('/api/purchaseorders/detail') }}/" + idx; // Table View Details
        
        $.ajax({
            url: url,
            type: "GET",
            success: function(response) {
                var htmlInputTable = "";
                
                data = response.data;
                $.each(data, function (item, key) {
                    // console.log(k);
                    htmlInputTable += '<tr class="row-'+key[5]+'" id="row-'+key[5]+'">\
                    <td class="sorting_1">'+key[0]+'</td>\
                    <td>'+key[1]+'</td>\
                    <td>'+key[2]+'</td>\
                    <td>'+key[3]+'</td>\
                    </tr>';
                    
                    // console.log(key)
                    if(key[8] == 1){
            
                        $('#editvbtn').hide();
                        $('#deletevbtn').hide();
                    }
                    // else{
                    //     $('#editvbtn').show();
                    //     $('#deletevbtn').show();
            
                    // }
                });
                table3.innerHTML = table3.innerHTML + htmlInputTable;

                if(data.flag_delete == 0)
                {
                    $("#deletevbtn").show();
                    $("#undeletevbtn").hide();
                    data = '<span id="activspan">-</span>';
                }

                if(data.flag_delete == 1)
                {
                    $("#deletevbtn").hide();
                    $("#undeletevbtn").show();
                    data = '<span id="activspan" style="color: #dc3545">deleted</span>';
                }

            },

            error: function(jqXHR, textStatus, errorThrown) 
            {
                console.log(textStatus, errorThrown);
            }
        });
    })
    $("#btnpaket").click(function()
    {
        // $('#addvbtn').attr('data-attid', idx);
        $('.title-qty').html('Qty Paket');
        $('.title-detail').html('Nama Paket');
        $('.title-code').html('Code Paket');
        var idx = $("#btnpaket").attr("data-attid");   
        // $('#editvbtn').hide();    

        $('#view').modal('show');
        $('#editvbtnpaket').show();


        $('#deletevbtn').attr('data-attid', idx);
        $('#deletevbtn').html('<i class="fa fa-trash"></i>Delete Purchase Order');
        $('#undeletevbtn').hide();



        $('#undeletevbtn').attr('data-attid', idx);
        $('#undeletevbtn').html('<i class="fa fa-repeat"></i> Undelete Purchase Order');
        
        var table3 = document.querySelector("#table_detail tbody");
        table3.innerHTML= "";

        var url = "{{ asset('/api/purchaseorders/detailpaket') }}/" + idx; // Table View Details

        $.ajax({
            url: url,
            type: "GET",
            success: function(response) {
                var htmlInputTable = "";
                
                data = response.data;
                $.each(data, function (item, key) {
                    // console.log(k);
                    htmlInputTable += '<tr class="row-'+key[5]+'" id="row-'+key[5]+'">\
                        <td class="sorting_1">'+key[0]+'</td>\
                        <td>'+key[1]+'</td>\
                        <td>'+key[2]+'</td>\
                        <td>'+key[3]+'</td>\
                        <td>'+key[4]+'</td>\
                    </tr>';
                    
                });
                table3.innerHTML = table3.innerHTML + htmlInputTable;

                if(data.flag_delete == 0)
                {
                    $("#deletevbtn").show();
                    $("#undeletevbtn").hide();
                    data = '<span id="activspan">-</span>';
                }

                if(data.flag_delete == 1)
                {
                    $("#deletevbtn").hide();
                    $("#undeletevbtn").show();
                    data = '<span id="activspan" style="color: #dc3545">deleted</span>';
                }
            },

            error: function(jqXHR, textStatus, errorThrown) 
            {
                console.log(textStatus, errorThrown);
            }
        });
    })

// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    $("#editvbtn").click(function()
    {
        var idx = $("#addvbtn").attr("data-attid");       
        $("#ModalLongTitle").html("Purchase Orders Edit"); // title MODAL CREATE
        clearInput("inpt-cst-add"); 

        $('.produk_list').html("");
        $("#paketId").val('');
        $('#user_group').hide(); 
        $('.copy').html("");
        $("#editvbtnpaket").show();
        $("#produkId").val("");

        $("#addvbtn").html('<i class="fa fa-plus"></i> Edit Purchase Orders');
        $("#view").modal('hide');
        $('#viewad').modal('show');

        var table4 = document.querySelector("#listProdukTable tbody"); // listProdukTable adalah table untuk create dan edit
        table4.innerHTML = "";
        var tablepaket = document.querySelector("#listProdukTable tbody");
        tablepaket.innerHTML = "";

        var url = "{{ asset('api/purchaseorders/detail') }}/"+idx;

        $.ajax({
            url: url,
            type: "GET",
            success: function(response)
            {             
                data = response.data;
                datas = response.datas;
                // console.log(datas, data);
                $("#id").val(data[6]);
                // console.log(data)
                $("#no_purchase_order").val(data[1]);
                $("#deskripsi_po").val(data[3]);
                $("#suratjalan").val(data[2]);
                var tampungUser = inHtml= "";
                var tampungPaket = inHtml= "";
                var tampung2 = tampungUser + tampungPaket;
                // console.log(tampung2);
                var htmlinput = "";

              
                $.each(datas, function(key, item) {
                    htmlinput += 
                    '<tr class="row-'+item[9]+''+item[7]+'" id="row-'+item[7]+'">\
                        <td><span class="badge bg-info deletee badge-sm me-3" style="color:black">'+item[8]+'</span>'+item[1]+'</td>\
                        <td>'+item[2]+'</td>\
                        <td class=" dt-body-center">\
                            <div class="form-group row">\
                                <div class="col-xs-2"><input type="number" value="'+item[3]+'" name="jumlah_'+item[8]+'[\'id\']['+item[7]+']" id="jumlah_'+item[8]+'-'+item[7]+'" class="class-oldd form-group form-control"></div>\
                            </div>\
                        </td>\
                        <td class="dt-body-center">\
                            <span class="btn btn-danger tbproduk btn-sm" onclick="'+item[10]+'('+item[7]+')">\
                                <i class="fa-solid fa-trash-can"></i>\
                            </span>\
                        </td>\
                    </tr>'; 
                  
                    console.log(item);
                     
                    table4.innerHTML = htmlinput;
                    // if()
                    tampung2 = tampung2 + item[6] + item[7];
                    $("#user_group").val(tampung2); 

            });
            }
        });
    });
    function kurangininputedit(a) { 
        var url = "{{ asset('api/purchaseorders/detail') }}/"+a; 
        $.ajax({
            url: url,
            type: "GET",
            success: function(response)
            {             
                data = response.data;
                datas = response.datas;
                // console.log(datas);
                // $("#id").val(data[6]);
                // // console.log(data)
                // $("#no_purchase_order").val(data[1]);
                // $("#deskripsi_po").val(data[3]);
                // $("#suratjalan").val(data[2]);
                // var tampungUser = inHtml= "";
                // var tampungPaket = inHtml= "";
                // var tampung2 = tampungUser + tampungPaket;
                // // console.log(tampung2);
                // var htmlinput = "";

              
                $.each(datas, function(key, item) {
                    console.log(item);
                })
            }
        })
        console.log(a);
     }
   

// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //  FUNCTION delete yes show
    function deleteyesshow() {
        // $('#deletevbtn').hide();
        var idx= $("#addvbtn").attr("data-attid");       
        // console.log(idx);     
        test = '@csrf';
        token = $(test).val();

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) 
            {
                var url = "{{ asset('/api/purchaseorders/delete') }}/" + idx;
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        id : idx,
                        _token: token
                    },
                    success: function(response) 
                    {
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted',
                            html:'Your file has been <b>Deleted</b>'
                        });
                        var url = "{{ asset('/api/purchaseorders/getdata') }}";
                        // $("#view").modal('hide');

                        $('#datastable').DataTable().ajax.url(url).load();
                        $('#undeletevbtn').show();
                        $("#deletevbtn").hide();
                    // $("#undeletevbtn").hide();
                        $("#activspan").html('deleted');
                        $("#activspan").css('color', '#dc3545');
                    },
                    error: function(jqXHR, textStatus, errorThrown) 
                    {
                        alert('something wrong');
                        console.log(textStatus, errorThrown);
                    }
                    
                });
            } else {
                $('#deletevbtn').show();
                
            }
        });

    }
    // FUNCTION delete yes show

// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    // FUNCTION undelete yes show
    function undeleteyesshow()
    {
        $('#undeletevbtn').hide();
        var idx= $("#undeletevbtn").attr("data-attid");       
        test = '@csrf';
        token = $(test).val();

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, undelete it!'
        }).then((result) => {
            if (result.isConfirmed) 
            {
                var url = "{{ asset('/api/purchaseorders/delete') }}/" + idx;
                // console.log(url);
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        id : idx,
                        _token: token,
                        undeleted : 1
                    },
                    success: function(response) 
                    {
                        Swal.fire({
                            icon: 'success',
                            title: 'Undeleted',
                            html:'Your file has been <b>Undeleted</b>'
                        });
                        var url = "{{ asset('/api/purchaseorders/getdata') }}";
                        // $("#view").modal('hide');

                        $('#datastable').DataTable().ajax.url(url).load();
                        $('#deletevbtn').show();
                        $("#activspan").html('-');
                        $("#activspan").css('color', '#198754');
                    },
                    error: function(jqXHR, textStatus, errorThrown) 
                    {
                        console.log(textStatus, errorThrown);
                    }
                    
                });
            } else {
                $('#undeletevbtn').show();
                
            }
        });
    }
    // FUNCTION undelete yes show

// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

</script>

@endsection 
</x-app-layout>
