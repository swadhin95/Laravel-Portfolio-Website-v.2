@extends('Layout.app')
@section('title','Course');
@section('content')

<div id="mainDivCourses"class="container d-none">
<div class="row">
<div class="col-md-12 p-5">

	<button id="addNewCourseBtnID" class=" btn my-3 btn-sm btn-danger">Add New</button>

<table id="CourseDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      
	  <th class="th-sm">Name</th>
	  <th class="th-sm">Fee</th>
	  <th class="th-sm">Class</th>
	  <th class="th-sm">Enroll</th>
	  <th class="th-sm">Edit</th>
	  <th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody id="course_table">
  
	
	
	
	
  </tbody>
</table>

</div>
</div>
</div>

<div id="loaderDivCourse" class="container">
<div class="row">
<div class="col-md-12 text-center p-5">

    <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">

</div>
</div>
</div>

<div id="wrongDivCourse" class="container d-none">
<div class="row">
<div class="col-md-12 text-center p-5">

    <h3>Something Went Wrong</h3>

</div>
</div>
</div>



<div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Add New Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
       <div class="container">
       	<div class="row">
       		<div class="col-md-6">
             	<input id="CourseNameId" type="text" id="" class="form-control mb-3" placeholder="Course Name">
          	 	<input id="CourseDesId" type="text" id="" class="form-control mb-3" placeholder="Course Description">
    		 	<input id="CourseFeeId" type="text" id="" class="form-control mb-3" placeholder="Course Fee">
     			<input id="CourseEnrollId" type="text" id="" class="form-control mb-3" placeholder="Total Enroll">
       		</div>
       		<div class="col-md-6">
     			<input id="CourseClassId" type="text" id="" class="form-control mb-3" placeholder="Total Class">      
     			<input id="CourseLinkId" type="text" id="" class="form-control mb-3" placeholder="Course Link">
     			<input id="CourseImgId" type="text" id="" class="form-control mb-3" placeholder="Course Image">
       		</div>
       	</div>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="CourseAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>


<div class="modal top fade" id="deleteCourseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="true" data-keyboard="true">
  <div class="modal-dialog  ">
    <div class="modal-content">
    
      <div class="modal-body text-center p-3 ">
        <h5 class="mt-4">Do you want to Delete?</h5>
        <h5 id="CourseDeleteID" class="mt-4 d-none"></h5>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">
          No
        </button>
        <button  id="CourseDeleteConfirmBtm" type="button" class="btn btn-sm btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="UpdateCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Update Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
      	<h5 id="courseEditID" class="mt-4 d-none"></h5> 
       <div class="container d-none"  id="courseEditForm" >
       	<div class="row">
       		<div class="col-md-6">
             	<input id="CourseNameUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Name">
          	 	<input id="CourseDesUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Description">
    		 	<input id="CourseFeeUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Fee">
     			<input id="CourseEnrollUpdateId" type="text" id="" class="form-control mb-3" placeholder="Total Enroll">
       		</div>
       		<div class="col-md-6">
     			<input id="CourseClassUpdateId" type="text" id="" class="form-control mb-3" placeholder="Total Class">      
     			<input id="CourseLinkUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Link">
     			<input id="CourseImgUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Image">
       		</div>
       	</div>
       </div>
       		<img id="courseEditLoader" class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
        	<h5 id="courseEditWrong" class="d-none">Something Went Wrong</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="CourseUpdateConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>


@endsection


@section('script')

<script type="text/javascript">

getCoursesData();
function getCoursesData() {


    axios.get('/getCoursesData')

        .then(function(response) {

            if (response.status == 200) {

                $('#mainDivCourses').removeClass('d-none');
                $('#loaderDivCourse').addClass('d-none');


                $('#CourseDataTable').DataTable().destroy();
                $('#course_table').empty();


                var dataJSON = response.data;
                $.each(dataJSON, function(i, item) {
                    $('<tr>').html(
                        "<td>"+dataJSON[i].course_name+"</td>" +
                        "<td>"+dataJSON[i].course_fee+"</td>" +
                        "<td>"+dataJSON[i].course_totalclass+"</td>" +
                        "<td>"+dataJSON[i]. course_totalenroll+"</td>" +
                        "<td><a class='CourseEditBtn' data-id=" + dataJSON[i].id + "  ><i class='fas fa-edit'></i></a> </td>" +
                        "<td><a class='CourseDeleteBtn' data-id=" + dataJSON[i].id + "  ><i class='fas fa-trash-alt'></i></a> </td>"
                    ).appendTo('#course_table');
                });


                //Course Table Delete Icon Click 
                $('.CourseDeleteBtn').click(function() {
                    var id = $(this).data('id');
                    $('#CourseDeleteID').html(id);
                    $('#deleteCourseModal').modal('show');
                })

                //Course Table Delete Icon Click 
                $('.CourseEditBtn').click(function() {
                    var id = $(this).data('id');
                    CourseUpdateDetails(id);
                    $('#courseEditID').html(id);
                    $('#UpdateCourseModal').modal('show');
                })

                $('#CourseDataTable').DataTable({"order":false});
                $('.dataTables_length').addClass('bs-select');

            } else {

                $('#loaderDivCourse').addClass('d-none');
                $('#wrongDivCourse').removeClass('d-none');

            }
        }).catch(function(error) {

            $('#loaderDivCourse').addClass('d-none');
            $('#wrongDivCourse').removeClass('d-none');

        });
}

$('#addNewCourseBtnID').click(function(){
    $('#addCourseModal').modal('show');
});


$('#CourseAddConfirmBtn').click(function(){
   var CourseName = $('#CourseNameId').val();
   var CourseDes = $('#CourseDesId').val();
   var CourseFee = $('#CourseFeeId').val();
   var CourseEnroll = $('#CourseEnrollId').val();
   var CourseClass = $('#CourseClassId').val();
   var CourseLink = $('#CourseLinkId').val();
   var CourseImg = $('#CourseImgId').val();

   CourseAdd(CourseName,CourseDes,CourseFee,CourseEnroll,CourseClass,CourseLink,CourseImg);
})

function CourseAdd(CourseName,CourseDes,CourseFee,CourseEnroll,CourseClass,CourseLink,CourseImg) {


    if(CourseName.length==0){

        toastr.error('Course  Name Is Empty');

    }else if(CourseDes.length==0){

        toastr.error('Course  Description Is Empty');

    }else if(CourseFee.length==0){
        
        toastr.error('Course  Img Is Empty');

    }else if(CourseEnroll.length==0){
        
        toastr.error('Course  Img Is Empty');

    }else if(CourseClass.length==0){
        
        toastr.error('Course  Img Is Empty');

    }else if(CourseLink.length==0){
        
        toastr.error('Course  Link Is Empty');

    }else if(CourseImg.length==0){
        
        toastr.error('Course  Img Is Empty');

    }
    else{
        $('#CourseAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");//Animation
        axios.post('/CoursesAdd', {
            course_name: CourseName, 
            course_des: CourseDes, 
            course_fee: CourseFee, 
            course_totalenroll: CourseEnroll,
            course_totalclass: CourseClass, 
            course_link: CourseLink, 
            course_img: CourseImg

        })
        .then(function(response) {
            $('#CourseAddConfirmBtn').html("Save"); 

            if(response.status==200){
                 
                if (response.data == 1) {
                    $('#addCourseModal').modal('hide');
                    toastr.success('Add Success');
                    getCoursesData();
                } else {
                    $('#addCourseModal').modal('hide');
                    toastr.error('Add Fail');
                    getCoursesData();
                }
            }
            else{
                $('#addCourseModal').modal('hide');
                    toastr.error('Something Went Wrong');
            }

        })
        .catch(function(error) {

                $('#addCourseModal').modal('hide');
                toastr.error('Something Went Wrong');
        });

    }
}


//Course Delete Model Yes Btn
$('#CourseDeleteConfirmBtm').click(function() {
    var id = $('#CourseDeleteID').html();
    CourseDelete(id);
})


//Course Delete
function CourseDelete(deleteID) {
    $('#CourseDeleteConfirmBtm').html("<div class='spinner-border spinner-border-sm' role='status'></div>");//Animation
    
    axios.post('/CoursesDelete', {
            id: deleteID
        })
        .then(function(response) {

            $('#CourseDeleteConfirmBtm').html("Yes");

            if(response.status==200){
                if (response.data == 1) {
                $('#deleteCourseModal').modal('hide');
                toastr.success('Delete Success');
                getCoursesData();
                } else {
                    $('#deleteCourseModal').modal('hide');
                    toastr.error('Delete Fail');
                    getCoursesData();
                }
            }
            else{
                $('#deleteCourseModal').modal('hide');
                toastr.error('Update Fail');
            }

        })
        .catch(function(error) {

            $('#deleteCourseModal').modal('hide');
            toastr.error('Update Fail');

        });
}

//Each Courses Update Details
function CourseUpdateDetails(detailsID) {
    axios.post('/CoursesDetails', {
            id: detailsID
        })
        .then(function(response) {
            if (response.status == 200) {
                $('#courseEditForm').removeClass('d-none');
                $('#courseEditLoader').addClass('d-none');


                var dataJSON = response.data;
                $('#CourseNameUpdateId').val(dataJSON[0].course_name);
                $('#CourseDesUpdateId').val(dataJSON[0].course_des);
                $('#CourseFeeUpdateId').val(dataJSON[0].course_fee);
                $('#CourseEnrollUpdateId').val(dataJSON[0].course_totalenroll);
                $('#CourseClassUpdateId').val(dataJSON[0].course_totalclass);
                $('#CourseLinkUpdateId').val(dataJSON[0].course_link);
                $('#CourseImgUpdateId').val(dataJSON[0].course_img);
            } else {
                $('#courseEditLoader').addClass('d-none');
                $('#courseEditWrong').removeClass('d-none');
            }


        })
        .catch(function(error) {
            $('#courseEditLoader').addClass('d-none');
            $('#courseEditWrong').removeClass('d-none');

        });

}


//Course Edit Model Save Btn
$('#CourseUpdateConfirmBtn').click(function() {
    var CourseID = $('#courseEditID').html();
    var CourseName = $('#CourseNameUpdateId').val();
    var CourseDes = $('#CourseDesUpdateId').val();
    var CourseFee = $('#CourseFeeUpdateId').val();
    var CourseEnroll = $('#CourseEnrollUpdateId').val();
    var CourseTotalClass = $('#CourseClassUpdateId').val();
    var CourseLink = $('#CourseLinkUpdateId').val();
    var CourseImg = $('#CourseImgUpdateId').val();
    CourseUpdate(CourseID, CourseName, CourseDes, CourseFee, CourseEnroll, CourseTotalClass, CourseLink,CourseImg);
})

function CourseUpdate(CourseID, CourseName, CourseDes,CourseFee,CourseEnroll,CourseTotalClass,CourseLink,CourseImg) {


    if(CourseName.length==0){

        toastr.error('Course  Name Is Eampty');

    }else if(CourseDes.length==0){

        toastr.error('Course  Description Is Eampty');

    }else if(CourseFee.length==0){
        
        toastr.error('Course Fee Is Eampty');

    }else if(CourseEnroll.length==0){
        
        toastr.error('Course Enroll Is Eampty');

    }else if(CourseTotalClass.length==0){
        
        toastr.error('Course Class Is Eampty');

    }else if(CourseLink.length==0){
        
        toastr.error('Course Link Is Eampty');

    }else if(CourseImg.length==0){
        
        toastr.error('Course Img Is Eampty');

    }
    else{
        $('#CourseUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");//Animation
        axios.post('/CoursesUpdate', {
            id: CourseID,
            course_name: CourseName,
            course_des: CourseDes,
            course_fee: CourseFee,
            course_totalenroll: CourseEnroll,
            course_totalclass: CourseTotalClass,
            course_link: CourseLink,
            course_img:CourseImg,

        })
        .then(function(response) {

            if(response.status==200){
                $('#CourseUpdateConfirmBtn').html("Save");  
                if (response.data == 1) {
                    $('#UpdateCourseModal').modal('hide');
                    toastr.success('Update Success');
                    getCoursesData();
                } else {
                    $('#UpdateCourseModal').modal('hide');
                    toastr.error('Update Fail');
                    getCoursesData();
                }
            }
            else{
                $('#UpdateCourseModal').modal('hide');
                    toastr.error('Update Fail');
            }

        })
        .catch(function(error) {

                $('#UpdateCourseModal').modal('hide');
                toastr.error('Update Fail');
        });

    }

    

}

</script>

@endsection