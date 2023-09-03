@extends('Layout.app')

@section('content')

<div id="mainDiv" class="container d-none">
<div class="row">
<div class="col-md-12 p-5">

<button id="addNewBtnID" class=" btn my-3 btn-sm btn-danger">Add New</button>

<table id="ServiceDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Image</th>
      <th class="th-sm">Name</th>
      <th class="th-sm">Description</th>
      <th class="th-sm">Edit</th>
      <th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody id="service_table">
    
  </tbody>
</table>

</div>
</div>
</div>



<div id="loaderDiv" class="container">
<div class="row">
<div class="col-md-12 text-center p-5">

    <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">

</div>
</div>
</div>

<div id="wrongDiv" class="container d-none">
<div class="row">
<div class="col-md-12 text-center p-5">

    <h3>Something Went Wrong</h3>

</div>
</div>
</div>







<div class="modal top fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="true" data-keyboard="true">
  <div class="modal-dialog  ">
    <div class="modal-content">
    
      <div class="modal-body text-center p-3 ">
        <h5 class="mt-4">Do you want to Delete?</h5>
        <h5 id="serviceDeleteID" class="mt-4 d-none"></h5>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">
          No
        </button>
        <button  id="serviceDeleteConfirmBtm" type="button" class="btn btn-sm btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>


<div class="modal top fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="true" data-keyboard="true">
  <div class="modal-dialog ">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Update Service</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-5  text-center p-3 ">
        <h5 id="serviceEditID" class="mt-4 d-none"></h5> 
        <div id="serviceEditForm" class="w-100 d-none">
        <input id="ServiceNameID" class="form-control mb-4" type="text" placeholder="Service Name" />
        <input id="ServiceDesID" class="form-control mb-4" type="text" placeholder="Service Description" />
        <input id="ServiceImgID" class="form-control mb-4" type="text" placeholder="Service Image Link" />
        </div>

        <img id="serviceEditLoader" class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
        <h5 id="serviceEditWrong" class="d-none">Something Went Wrong</h5>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">
          Cancel
        </button>
        <button  id="serviceEditConfirmBtm" type="button" class="btn btn-sm btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>

<div class="modal top fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="true" data-keyboard="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-body p-5  text-center p-3 ">
          
        <div id="serviceAddForm" class="w-100">
          <h6 class="mb-4">Add New Service</h6>
        <input id="ServiceNameAddID" class="form-control mb-4" type="text" placeholder="Service Name" />
        <input id="ServiceDesAddID" class="form-control mb-4" type="text" placeholder="Service Description" />
        <input id="ServiceImgAddID" class="form-control mb-4" type="text" placeholder="Service Image Link" />
        </div>

        
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">
          Cancel
        </button>
        <button  id="serviceAddConfirmBtm" type="button" class="btn btn-sm btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>


@endsection

@section('script')

<script type="text/javascript">
  
  getServicesData();

  

//For Services Table
function getServicesData() {


    axios.get('/getServicesData')
        .then(function(response) {

            if (response.status == 200) {

                $('#mainDiv').removeClass('d-none');
                $('#loaderDiv').addClass('d-none');

                $('#ServiceDataTable').DataTable().destroy();
                $('#service_table').empty();


                var dataJSON = response.data;
                $.each(dataJSON, function(i, item) {
                    $('<tr>').html(
                        "<td><img class='table-img' src=" + dataJSON[i].service_img + "> </td>" +
                        "<td>" + dataJSON[i].service_name + " </td>" +
                        "<td>" + dataJSON[i].service_des + " </td>" +
                        "<td><a class='ServiceEditBtn' data-id=" + dataJSON[i].id + "  ><i class='fas fa-edit'></i></a> </td>" +
                        "<td><a class='ServiceDeleteBtn' data-id=" + dataJSON[i].id + "  ><i class='fas fa-trash-alt'></i></a> </td>"
                    ).appendTo('#service_table');
                });

                //Service Table Delete Icon Click 
                $('.ServiceDeleteBtn').click(function() {
                    var id = $(this).data('id');
                    $('#serviceDeleteID').html(id);
                    $('#deleteModal').modal('show');
                })


                //Service Table Edit Icon Click 
                $('.ServiceEditBtn').click(function() {
                    var id = $(this).data('id');
                    $('#serviceEditID').html(id);

                    ServiceUpdateDetails(id);

                    $('#editModal').modal('show');
                })


                $('#ServiceDataTable').DataTable({"order":false});
                $('.dataTables_length').addClass('bs-select');


            } else {

                $('#loaderDiv').addClass('d-none');
                $('#wrongDiv').removeClass('d-none');

            }
        }).catch(function(error) {

            $('#loaderDiv').addClass('d-none');
            $('#wrongDiv').removeClass('d-none');

        });
}


//Service Delete Model Yes Btn
$('#serviceDeleteConfirmBtm').click(function() {
    var id = $('#serviceDeleteID').html();
    ServicesDelete(id);
})


//Service Delete
function ServicesDelete(deleteID) {
    $('#serviceDeleteConfirmBtm').html("<div class='spinner-border spinner-border-sm' role='status'></div>");//Animation
    
    axios.post('/ServiceDelete', {
            id: deleteID
        })
        .then(function(response) {

            $('#serviceDeleteConfirmBtm').html("Yes");

            if(response.status==200){
                if (response.data == 1) {
                $('#deleteModal').modal('hide');
                toastr.success('Delete Success');
                getServicesData();
                } else {
                    $('#deleteModal').modal('hide');
                    toastr.error('Delete Fail');
                    getServicesData();
                }
            }
            else{
                $('#editModal').modal('hide');
                toastr.error('Update Fail');
            }

        })
        .catch(function(error) {

            $('#editModal').modal('hide');
            toastr.error('Update Fail');

        });
}



//Each Services Update Details
function ServiceUpdateDetails(detailsID) {
    axios.post('/ServiceDetails', {
            id: detailsID
        })
        .then(function(response) {
            if (response.status == 200) {
                $('#serviceEditForm').removeClass('d-none');
                $('#serviceEditLoader').addClass('d-none');


                var dataJSON = response.data;
                $('#ServiceNameID').val(dataJSON[0].service_name);
                $('#ServiceDesID').val(dataJSON[0].service_des);
                $('#ServiceImgID').val(dataJSON[0].service_img);
            } else {
                $('#serviceEditLoader').addClass('d-none');
                $('#serviceEditWrong').removeClass('d-none');
            }


        })
        .catch(function(error) {
            $('#serviceEditLoader').addClass('d-none');
            $('#serviceEditWrong').removeClass('d-none');

        });
}


//Service Edit Model Save Btn
$('#serviceEditConfirmBtm').click(function() {
    var id = $('#serviceEditID').html();
    var name = $('#ServiceNameID').val();
    var des = $('#ServiceDesID').val();
    var img = $('#ServiceImgID').val();
    ServiceUpdate(id, name, des, img);
})

function ServiceUpdate(serviceID, serviceName, serviceDes, serviceImg) {


    if(serviceName.length==0){

        toastr.error('Service  Name Is Eampty');

    }else if(serviceDes.length==0){

        toastr.error('Service  Description Is Eampty');

    }else if(serviceImg.length==0){
        
        toastr.error('Service  Img Is Eampty');

    }
    else{
        $('#serviceEditConfirmBtm').html("<div class='spinner-border spinner-border-sm' role='status'></div>");//Animation
        axios.post('/ServiceUpdate', {
            id: serviceID,
            name: serviceName,
            des: serviceDes,
            img: serviceImg,

        })
        .then(function(response) {

            if(response.status==200){
                $('#serviceEditConfirmBtm').html("Save");  
                if (response.data == 1) {
                    $('#editModal').modal('hide');
                    toastr.success('Update Success');
                    getServicesData();
                } else {
                    $('#editModal').modal('hide');
                    toastr.error('Update Fail');
                    getServicesData();
                }
            }
            else{
                $('#editModal').modal('hide');
                    toastr.error('Update Fail');
            }

        })
        .catch(function(error) {

                $('#editModal').modal('hide');
                toastr.error('Update Fail');
        });

    }

    

}

//Service Add Model Save Btn
$('#serviceAddConfirmBtm').click(function() {
    var name = $('#ServiceNameAddID').val();
    var des = $('#ServiceDesAddID').val();
    var img = $('#ServiceImgAddID').val();
    ServiceAdd(name, des, img);
})

//Add new Btn Click
$('#addNewBtnID').click(function(){
    $('#addModal').modal('show');
});

//Service Add Method
function ServiceAdd(serviceName, serviceDes, serviceImg) {


    if(serviceName.length==0){

        toastr.error('Service  Name Is Eampty');

    }else if(serviceDes.length==0){

        toastr.error('Service  Description Is Eampty');

    }else if(serviceImg.length==0){
        
        toastr.error('Service  Img Is Eampty');

    }
    else{
        $('#serviceAddConfirmBtm').html("<div class='spinner-border spinner-border-sm' role='status'></div>");//Animation
        axios.post('/ServiceAdd', {
            name: serviceName,
            des: serviceDes,
            img: serviceImg,

        })
        .then(function(response) {
            $('#serviceAddConfirmBtm').html("Save"); 

            if(response.status==200){
                 
                if (response.data == 1) {
                    $('#addModal').modal('hide');
                    toastr.success('Add Success');
                    getServicesData();
                } else {
                    $('#addModal').modal('hide');
                    toastr.error('Add Fail');
                    getServicesData();
                }
            }
            else{
                $('#addModal').modal('hide');
                    toastr.error('Something Went Wrong');
            }

        })
        .catch(function(error) {

                $('#addModal').modal('hide');
                toastr.error('Something Went Wrong');
        });

    }
}


</script>

@endsection