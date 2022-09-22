
@section('title')
<title>{{ $datas['title'] }}</title>
@endsection
@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

@endsection

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight hetf2"><i class="bi bi-box2-fill"></i>
        {{ __('Admin Tiket') }}  <button class="btn btn-success btn-sm" id="btn_addcustomer" onclick="addModal()"><i class="fa fas-plus"></i> Add</button> 
        </h2>
    </x-slot>
                                                    {{-- HEADER --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="table-responsive">
                    <table id="karyawanTable" class="table text-start table-striped align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr>
                                    <th class="align-center">Id Tiket</th>
                                    <th class="align-center">Nama</th>
                                    <th class="align-center">Email</th>
                                    <!-- <th class="align-center">Jenis</th> -->
                                    <th class="align-center">Action</th>                                    
                                </tr>
                                
                            </thead>
                            <tfoot>
                                <tr>
                                    <th class="align-center">Id Tiket</th>
                                    <th class="align-center">Nama</th>
                                    <th class="align-center">Email</th>
                                    <!-- <th class="align-center">Jenis</th> -->
                                    <th class="align-center">Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>                             
                                                                    <!-- MODAL add -->
    <div class="modal fade" id="modaladd" tabindex="-1" role="dialog" aria-labelledby="modaladdTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-lg-start">
                    <h4><i class="icoon"></i></h4>
                    <h4><i class="titlemodal"></i> </h4>
                </div>
                <div class="modal-body">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade active show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <form id="formm" enctype="multipart/form-data">
                                @csrf
                                <dl class="row mb-0">
                           

                                    <dt class="col-sm-4">Nama</dt>
                                    <dd class="col-sm-8">: <input required type="text" name="nama" id="nama" class="form-group nama_paket">

                                    <dt class="col-sm-4">Email</dt>
                                    <dd class="col-sm-8">: <input required type="text" name="email" id="email" class="form-group nama_paket">

                                    
                                    </select>
                                    <dt class="col-sm-4">Jenis Kelamin</dt>
                                    <dd class="col-sm-8">:  <select required name="jk" id="jk_id" class="form-group input-sm" id="jk" >
                                        <option value="">-- Jenis Kelamin --</option>
                                        <option value="laki-laki">Laki-laki</option>
                                        <option value="perempuan">Perempuan</option>
                                        </select>
                                  
                                    <input type="hidden" name="id" class="editt" data-id="" id="hidenId">
                                </dl>
                            
                            </div>
                                <div class="modal-footer">
                                    <button id="closeModalmodaladd" type="button" class="btn btn-secondary closeModalmodaladd btn-sm" data-dismiss="modal">Close</button>
                                    <button type="submit" id="save" class="btn btn-success btn-sm">Save</button>
                                </div>
                            </form>
                        </div>               
                    </div>
                </div>
            </div>
        </div>
    </div>

                                                          <!-- MODAL View -->
    <div class="modal fade" id="modalview" tabindex="-1" role="dialog" aria-labelledby="modaladdTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-lg-start">
                    <h4><i class="icoon"></i></h4>
                    <h4><i class="titlemodal"></i> </h4>
                </div>
                <div class="modal-body">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade active show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <form id="formm" enctype="multipart/form-data">
                                @csrf
                                <dl class="row mb-0">
                                    <dt class="col-sm-4">Id Tiket</dt>
                                    <dd class="col-sm-8">: <span name="id_tiket" id="idtiket" class="form-group nama_paket">

                                    <dt class="col-sm-4">Nama</dt>
                                    <dd class="col-sm-8">: <span name="nama" id="show_nama" class="form-group nama_paket">

                                    <dt class="col-sm-4">Email</dt>
                                    <dd class="col-sm-8">: <span name="email" id="show_email" class="form-group nama_paket">

                                    <dt class="col-sm-4">Jenis Kelamin</dt>
                                    <dd class="col-sm-8">: <span href="" name="jk" id="jenisK" class="form-group nama_paket"></span>
                                  
                                    <input type="hidden" name="id" class="editt" data-id="" id="hiddenId">
                                </dl>
                            
                            </div>
                                <div class="modal-footer">
                                    <button id="closeModalmodaladd" type="button" class="btn btn-secondary closeModalmodaladd btn-sm" data-dismiss="modal">Close</button>
                                    <button type="button" id="editbtn" onclick="editshow()" class="btn btn-success btn-sm">Edit</button>
                                </div>
                            </form>
                        </div>               
                    </div>
                </div>
            </div>
        </div>
    </div>
              

    @section('script')
<script type="text/javascript">
    var url = "{{ asset('/getdata') }}";
    function searcAjax(a, skip = 0){
        if($(a).val().length > global_length_src || skip == 1) {
            var getparam = getAllClassAndVal("src_class_user"); // helpers
            $('#karyawanTable').DataTable().ajax.url(url+"?"+getparam).load();
        }
        else {
          $('#karyawanTable').DataTable().ajax.url(url).load();
        }
    }

    $(document).ready(function(){
        var getndate = getNowdate(); // helpers
        $("#daterangepicker").val(getndate + ' - ' + getndate );
        $(".datepicker").val(getndate);
        $('.datepicker').daterangepicker({
            singleDatePicker: true,
            timePicker: false,
            locale: {
              format: "DD/MM/YYYY"
            }
        });

        $("#daterangepicker").daterangepicker({
            timePicker: false,
            locale: {
              format: "DD/MM/YYYY"
            }
        });


        var table = $('#karyawanTable').DataTable({
            ajax: url,
            
            columnDefs: [
                 {
                   'targets': 3,
                   'searchable':false,
                   'orderable':false,
                   'className': 'dt-body-center',
                   'render': function (data, type, full, meta){
                       return '<span class="btn btn-info btn-sm" onclick="showdetail('+full[3]+')">details</span>';
                   }
                }, 
             
            ],
            searching: true,
        }); 

        $('.closeModalmodaladd').on('click', function(){
            $('#modaladd').modal('hide');
        });
    });



    ////////////////////////////// Add Modal
    function addModal(){
        $("#jk_id").val("");
        $("#email").val("");
        $("#nama").val("");
        $("#modaladd").modal('show');
        $(".icoon").html("<i class='bi bi-person-plus-fill'></i>");
        $(".titlemodal").html("Add User Ticket");
        $("#addvbtn").hide();
        $("#deletevbtn").hide();
        $("#undeletevbtn").hide();

        $("#hidenId").val("");

    }
    $(document).ready(function(){

$( "#formm" ).submit(function(e) {
  var idx = $("#hidenId").val();
var url= "{{ asset('UserTiket/store') }}" ;
if(idx != "")
var url = "{{ asset('/UserTiket/update') }}/" + idx ;


e.preventDefault();
let formData = new FormData(this);
var form = $('#formm');
        $.ajax({
            type: "POST",
            url: url,
            // processData:
            enctype: 'multipart/form-data',
            data: formData,
            contentType: false,
           processData: false,
            success: function (response) {

                data = response.data;
                if(data == 'success') {
                    Swal.fire({
                        title: 'Selamat!',
                        text: "Data Berhasil Disimpan",
                        icon: 'success'
                    });
                    $('#modaladd').modal('hide');
                    reloaddata();
                    $('.alert-danger').hide();
                }
                else {
                    $.each(response.errors, function(key, value){
                    Swal.fire({
                        title: 'Gagal!',
                        text: value,
                        icon: 'error'
                    });
                });
                    
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });  
});

    function showdetail(id) {
        $('.titlemodal').html('Show User Tiket')
      
            $('#saveee').attr('data-attid', id);

        var url = "{{ asset('/UserTiket/detail') }}/" + id;
        // console.log(url);
        var form = $('#viewCustomer');
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                        data = response.data;
  
                        // console.log(data);
                        if (data) {
                            $("#idtiket").html(data.id_tiket);
                            $("#show_nama").html(data.nama);
                            $("#show_email").html(data.email);
                            $("#jenisK").html(data.jk);
                            $('#hiddenId').val(data.id)
                           }
                                reloaddata();
                                $('#modalview').modal('show'); 
                    }
                }); 
            $('#deletevbtn').attr('data-attid', id);
            $('#editbtn').attr('data-attid', id);
            $("#hidenId").val(id);
            $("#titledetailmodal").html("Detail Customer")
    }
       
    function editshow(){
        idx = $('#editbtn').attr('data-attid',);
        // $("#hidenId").val();
        $("#iconn").html("<i class='bi bi-pencil-square'></i>");
        $(".titlemodal").html("Edit User Tiket");
        
        var url = "{{ asset('/UserTiket/edit') }}/" + idx;
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                        data = response.data;
                        // if(data) {
                            $("#jk_id option[value='"+data.jk+"']").attr("selected","selected");

                            $("#id_tiket").val(data.id_tiket);
                            $("#nama").val(data.nama);
                            $("#jk").val(data.jk);
                            $("#email").val(data.email);
                            $('#hiddenId').val(data.id)
                            
                            // }
                            // $("#closemodaledit").modal('hide');
                            $('#modaladd').modal('show');
                            $('#modalview').modal('hide');
                                
                            }
                        
                });
    }
    
    function reloaddata() {
        $('#karyawanTable').DataTable().ajax.url(url).load();
    }

    
</script>
@endsection    
</x-app-layout>

