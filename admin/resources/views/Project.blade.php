@extends('Layout.app')

@section('content')

<div id="mainDiv" class="container d-none">
<div class="row">
<div class="col-md-12 p-5">

<button id="addNewProjectBtnID" class=" btn my-3 btn-sm btn-danger">Add New</button>

<table id="ProjectDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Name</th>
      <th class="th-sm">Description</th>
      <th class="th-sm">Edit</th>
      <th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody id="project_table">
    
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



<div class="modal top fade" id="deleteProjectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="true" data-keyboard="true">
  <div class="modal-dialog  ">
    <div class="modal-content">
    
      <div class="modal-body text-center p-3 ">
        <h5 class="mt-4">Do you want to Delete?</h5>
        <h5 id="projectDeleteID" class="mt-4 d-none"></h5>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">
          No
        </button>
        <button  id="projectDeleteConfirmBtm" type="button" class="btn btn-sm btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>




<div class="modal top fade" id="editProjectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="true" data-keyboard="true">
  <div class="modal-dialog ">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Update Project</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-5  text-center p-3 ">
        <h5 id="ProjectEditID" class="mt-4 d-none"></h5> 
        <div id="ProjectEditForm" class="w-100 d-none">
        <input id="ProjectNameID" class="form-control mb-4" type="text" placeholder="Project Name" />
        <input id="ProjectDesID" class="form-control mb-4" type="text" placeholder="Project Description" />
        <input id="ProjectLinkID" class="form-control mb-4" type="text" placeholder="Project Description" />
        <input id="ProjectImgID" class="form-control mb-4" type="text" placeholder="Project Image Link" />
        </div>

        <img id="ProjectEditLoader" class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
        <h5 id="ProjectEditWrong" class="d-none">Something Went Wrong</h5>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">
          Cancel
        </button>
        <button  id="ProjectEditConfirmBtm" type="button" class="btn btn-sm btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>




<div class="modal top fade" id="addProjectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="true" data-keyboard="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-body p-5  text-center p-3 ">
        <div id="projectAddForm" class="w-100">
          <h6 class="mb-4">Add New Project</h6>
        <input id="ProjectNameAddID" class="form-control mb-4" type="text" placeholder="Project Name" />
        <input id="ProjectDesAddID" class="form-control mb-4" type="text" placeholder="Project Description" />
        <input id="ProjectLinkAddID" class="form-control mb-4" type="text" placeholder="Project Description" />
        <input id="ProjectImgAddID" class="form-control mb-4" type="text" placeholder="Project Description" />
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">
          Cancel
        </button>
        <button  id="projectAddConfirmBtm" type="button" class="btn btn-sm btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>


@endsection
@section('script')

<script type="text/javascript">
  
  getProjectsData();

  //For Projects Table
function getProjectsData() {


    axios.get('/getProjectsData')
        .then(function(response) {

            if (response.status == 200) {

                $('#mainDiv').removeClass('d-none');
                $('#loaderDiv').addClass('d-none');

                $('#ProjectDataTable').DataTable().destroy();
                $('#project_table').empty();


                var dataJSON = response.data;
                $.each(dataJSON, function(i, item) {
                    $('<tr>').html(
                        "<td>" + dataJSON[i].project_name + " </td>" +
                        "<td>" + dataJSON[i].project_des + " </td>" +
                        "<td><a class='ProjectEditBtn' data-id=" + dataJSON[i].id + "  ><i class='fas fa-edit'></i></a> </td>" +
                        "<td><a class='ProjectDeleteBtn' data-id=" + dataJSON[i].id + "  ><i class='fas fa-trash-alt'></i></a> </td>"
                    ).appendTo('#project_table');
                });

                //Project Table Delete Icon Click 
                $('.ProjectDeleteBtn').click(function() {
                    var id = $(this).data('id');
                    $('#projectDeleteID').html(id);
                    $('#deleteProjectModal').modal('show');
                })


                //Service Table Edit Icon Click 
                $('.ProjectEditBtn').click(function() {
                    var id = $(this).data('id');
                    $('#ProjectEditID').html(id);

                    ProjectUpdateDetails(id);

                    $('#editProjectModal').modal('show');
                })


                $('#ProjectDataTable').DataTable({"order":false});
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


//Project Delete Model Yes Btn
$('#projectDeleteConfirmBtm').click(function() {
    var id = $('#projectDeleteID').html();
    ProjectsDelete(id);
})


//Project Delete
function ProjectsDelete(deleteID) {
    $('#projectDeleteConfirmBtm').html("<div class='spinner-border spinner-border-sm' role='status'></div>");//Animation
    
    axios.post('/ProjectDelete', {
            id: deleteID
        })
        .then(function(response) {

            $('#projectDeleteConfirmBtm').html("Yes");

            if(response.status==200){
                if (response.data == 1) {
                $('#deleteProjectModal').modal('hide');
                toastr.success('Delete Success');
                getProjectsData();
                } else {
                    $('#deleteProjectModal').modal('hide');
                    toastr.error('Delete Fail');
                    getProjectsData();
                }
            }
            else{
                $('#deleteProjectModal').modal('hide');
                toastr.error('Update Fail');
            }

        })
        .catch(function(error) {

            $('#deleteProjectModal').modal('hide');
            toastr.error('Update Fail');

        });
}



//Each Project Update Details
function ProjectUpdateDetails(detailsID) {
    axios.post('/ProjectDetails', {
            id: detailsID
        })
        .then(function(response) {
            if (response.status == 200) {
                $('#ProjectEditForm').removeClass('d-none');
                $('#ProjectEditLoader').addClass('d-none');


                var dataJSON = response.data;
                $('#ProjectNameID').val(dataJSON[0].project_name);
                $('#ProjectDesID').val(dataJSON[0].project_des);
                $('#ProjectLinkID').val(dataJSON[0].project_link);
                $('#ProjectImgID').val(dataJSON[0].project_img);
            } else {
                $('#ProjectEditLoader').addClass('d-none');
                $('#ProjectEditWrong').removeClass('d-none');
            }


        })
        .catch(function(error) {
            $('#ProjectEditLoader').addClass('d-none');
            $('#ProjectEditWrong').removeClass('d-none');

        });
}


//Service Edit Model Save Btn
$('#ProjectEditConfirmBtm').click(function() {
    var id = $('#ProjectEditID').html();
    var name = $('#ProjectNameID').val();
    var des = $('#ProjectDesID').val();
    var link = $('#ProjectLinkID').val();
    var img = $('#ProjectImgID').val();
    ProjectUpdate(id, name, des,link , img);
})

function ProjectUpdate(ProjectID, ProjectName, ProjectDes,ProjectLink , ProjectImg) {


    if(ProjectName.length==0){

        toastr.error('Project  Name Is Eampty');

    }else if(ProjectDes.length==0){

        toastr.error('Project  Description Is Eampty');

    }else if(ProjectLink.length==0){
        
        toastr.error('Project  Img Is Eampty');

    }else if(ProjectImg.length==0){
        
        toastr.error('Project  Img Is Eampty');

    }
    else{
        $('#ProjectEditConfirmBtm').html("<div class='spinner-border spinner-border-sm' role='status'></div>");//Animation
        axios.post('/ProjectUpdate', {
            id: ProjectID,
            project_name: ProjectName,
            project_des: ProjectDes,
            project_link: ProjectLink,
            project_img: ProjectImg,

        })
        .then(function(response) {

            if(response.status==200){
                $('#ProjectEditConfirmBtm').html("Save");  
                if (response.data == 1) {
                    $('#editProjectModal').modal('hide');
                    toastr.success('Update Success');
                    getProjectsData();
                } else {
                    $('#editProjectModal').modal('hide');
                    toastr.error('Update Fail');
                    getProjectsData();
                }
            }
            else{
                $('#editProjectModal').modal('hide');
                    toastr.error('Update Fail');
            }

        })
        .catch(function(error) {

                $('#editProjectModal').modal('hide');
                toastr.error('Update Fail');
        });

    }

    

}

//Service Add Model Save Btn
$('#projectAddConfirmBtm').click(function() {
    var name = $('#ProjectNameAddID').val();
    var des = $('#ProjectDesAddID').val();
    var link = $('#ProjectLinkAddID').val();
    var img = $('#ProjectImgAddID').val();
    ProjectAdd(name, des, link, img);
})

//Add new Btn Click
$('#addNewProjectBtnID').click(function(){
    $('#addProjectModal').modal('show');
});

//Project Add Method
function ProjectAdd(projectName, projectDes, projectLink, projectImg) {


    if(projectName.length==0){

        toastr.error('Project  Name Is Eampty');

    }else if(projectDes.length==0){

        toastr.error('Project  Description Is Eampty');

    }else if(projectLink.length==0){

        toastr.error('Project  Link Is Eampty');
    }else if(projectImg.length==0){

        toastr.error('Project  Image Is Eampty');
    }
    else{
        $('#projectAddConfirmBtm').html("<div class='spinner-border spinner-border-sm' role='status'></div>");//Animation
        axios.post('/ProjectAdd', {
            project_name: projectName,
            project_des: projectDes,
            project_link: projectLink,
            project_img: projectImg,

        })
        .then(function(response) {
            $('#projectAddConfirmBtm').html("Save"); 

            if(response.status==200){
                 
                if (response.data == 1) {
                    $('#addProjectModal').modal('hide');
                    toastr.success('Add Success');
                    getProjectsData();
                } else {
                    $('#addProjectModal').modal('hide');
                    toastr.error('Add Fail');
                    getProjectsData();
                }
            }
            else{
                $('#addProjectModal').modal('hide');
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