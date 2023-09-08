@extends('Layout.app')
@section('title','Contact');
@section('content')

<div id="mainDiv" class="container d-none">
<div class="row">
<div class="col-md-12 p-5">



<table id="ContactDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Name</th>
      <th class="th-sm">Mobile</th>
      <th class="th-sm">Email</th>
      <th class="th-sm">Message</th>
      <th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody id="contact_table">
    
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







<div class="modal top fade" id="deleteContactModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="true" data-keyboard="true">
  <div class="modal-dialog  ">
    <div class="modal-content">
    
      <div class="modal-body text-center p-3 ">
        <h5 class="mt-4">Do you want to Delete?</h5>
        <h5 id="ContactDeleteID" class="mt-4 d-none"></h5>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">
          No
        </button>
        <button  id="ContactDeleteConfirmBtm" type="button" class="btn btn-sm btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>






@endsection

@section('script')

<script type="text/javascript">
  
  getContactData();

  

//For Services Table
function getContactData() {


    axios.get('/getContactData')
        .then(function(response) {

            if (response.status == 200) {

                $('#mainDiv').removeClass('d-none');
                $('#loaderDiv').addClass('d-none');

                $('#ContactDataTable').DataTable().destroy();
                $('#contact_table').empty();


                var dataJSON = response.data;
                $.each(dataJSON, function(i, item) {
                    $('<tr>').html(
                        
                        "<td>" + dataJSON[i].contact_name + " </td>" +
                        "<td>" + dataJSON[i].contact_mobile + " </td>" +
                        "<td>" + dataJSON[i].contact_email + " </td>" +
                        "<td>" + dataJSON[i].contact_msg + " </td>" +
                        "<td><a class='ContactDeleteBtn' data-id=" + dataJSON[i].id + "  ><i class='fas fa-trash-alt'></i></a> </td>"
                    ).appendTo('#contact_table');
                });

                //Service Table Delete Icon Click 
                $('.ContactDeleteBtn').click(function() {
                    var id = $(this).data('id');
                    $('#ContactDeleteID').html(id);
                    $('#deleteContactModal').modal('show');
                })


                


                $('#ContactDataTable').DataTable({"order":false});
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


//Contact Delete Model Yes Btn
$('#ContactDeleteConfirmBtm').click(function() {
    var id = $('#ContactDeleteID').html();
    ContactDelete(id);
})


//Service Delete
function ContactDelete(deleteID) {
    $('#ContactDeleteConfirmBtm').html("<div class='spinner-border spinner-border-sm' role='status'></div>");//Animation
    
    axios.post('/ContactDelete', {
            id: deleteID
        })
        .then(function(response) {

            $('#ContactDeleteConfirmBtm').html("Yes");

            if(response.status==200){
                if (response.data == 1) {
                $('#deleteContactModal').modal('hide');
                toastr.success('Delete Success');
                getContactData();
                } else {
                    $('#deleteContactModal').modal('hide');
                    toastr.error('Delete Fail');
                    getContactData();
                }
            }
            else{
                $('#deleteContactModal').modal('hide');
                toastr.error('Delete Fail');
            }

        })
        .catch(function(error) {

            $('#deleteContactModal').modal('hide');
            toastr.error('Delete Fail');

        });
}



</script>

@endsection