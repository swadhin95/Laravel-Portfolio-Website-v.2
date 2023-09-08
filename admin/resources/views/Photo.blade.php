@extends('Layout.app')
@section('title','Photo Gallery');
@section('content')

<div id="mainDivPhoto"class="container">
    <div class="row">
        <div class="col-md-12 p-5">
        
          <button id="addNewPhotoBtnID" data-target="#addPhotoModal" class=" btn my-3 btn-sm btn-danger">Add New</button>
      
        </div>
    </div>
</div>
<div class="container">
    <div class="row photoRow">
        

    </div>
    <button class="btn btn-sm btn-primary" id="LoadMoreId">Load More</button>
</div>

<div class="modal fade" id="addPhotoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Add New Photo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
       <div class="container">
       	<div class="row">
       		<div class="col-md-12">

                <input class="form-control" type="file" id="imgInput">
                <img class="imgPreview mt-3" src="" id="imgPreview" src="{{asset('images/defaultImage.jpg')}}">
       		
     			
       		</div>
       	</div>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="savePhotoBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>


@endsection




@section('script')

<script type="text/javascript">


$('#imgInput').change(function(){
    var reader=new FileReader();
    reader.readAsDataURL(this.files[0]);
    reader.onload= function(event){
        var ImgSource = event.target.result;
        $('#imgPreview').attr('src',ImgSource)

    }

})

$('#addNewPhotoBtnID').click(function(){
    $('#addPhotoModal').modal('show');
});


$('#savePhotoBtn').on('click',function(){

    $('#savePhotoBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
    var PhotoFile = $('#imgInput').prop('files')[0];
    var formData = new FormData();
    formData.append('photo',PhotoFile);

    axios.post("/PhotoUoload",formData).then(function(response){

        if(response.status==200 && response.data==1){
            $('#savePhotoBtn').html("Save");
            toastr.success('Photo Upload Success');
            $('#addPhotoModal').modal('hide');
        }else{
            toastr.error('Photo Upload Fail');
            $('#addPhotoModal').modal('hide');
        }
        
    }).catch(function(error){
        toastr.error('Photo Upload Fail');
        $('#addPhotoModal').modal('hide');
    })
})

LoadPhoto();

function LoadPhoto(){
    let URL="/PhotoJSON";
    axios.get(URL).then(function(response){
        $.each(response.data, function(i, item) {
                    $("<div class='col-md-3 p-1'>").html(
                        "<img data-id="+item['id']+" class='imgOnRow' src="+item['location']+">"
                        
                    ).appendTo('.photoRow');
                });
    }).catch(function(error){

    })
}
var ImgID=0;

function LoadByID(FirstImageId,LoadMoreId){
    ImgID=ImgID+4;
    let PhotoID=ImgID+FirstImageId;

    let URL="/PhotoJSONByID/"+PhotoID;

    LoadMoreId.html("<div class='spinner-border spinner-border-sm' role='status'></div>");

    axios.get(URL).then(function(response){
        LoadMoreId.html("Load More");
        $.each(response.data, function(i, item) {
                    $("<div class='col-md-3 p-1'>").html(
                        "<img data-id="+item['id']+" class='imgOnRow' src="+item['location']+">"
                        
                    ).appendTo('.photoRow');
                });
    }).catch(function(error){

    })

    

}


$('#LoadMoreId').on('click',function(){
    let FirstImageId= $(this).closest('div').find('img').data('id')

    let LoadMoreId=$(this);
    LoadByID(FirstImageId,LoadMoreId);
})




</script>

@endsection