@extends('Layout.app')
@section('title','Review');
@section('content')

<div id="mainDivReview" class="container d-none">
<div class="row">
<div class="col-md-12 p-5">

<button id="addNewReviewBtnID" class=" btn my-3 btn-sm btn-danger">Add New</button>

<table id="ReviewDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Name</th>
      <th class="th-sm">Description</th>
      <th class="th-sm">Edit</th>
      <th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody id="review_table">
    
  </tbody>
</table>

</div>
</div>
</div>



<div id="loaderDivReview" class="container">
<div class="row">
<div class="col-md-12 text-center p-5">

    <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">

</div>
</div>
</div>

<div id="wrongDivReview" class="container d-none">
<div class="row">
<div class="col-md-12 text-center p-5">

    <h3>Something Went Wrong</h3>

</div>
</div>
</div>







<div class="modal top fade" id="deleteReviewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="true" data-keyboard="true">
  <div class="modal-dialog  ">
    <div class="modal-content">
    
      <div class="modal-body text-center p-3 ">
        <h5 class="mt-4">Do you want to Delete?</h5>
        <h5 id="ReviewDeleteID" class="mt-4 d-none"></h5>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">
          No
        </button>
        <button  id="ReviewDeleteConfirmBtm" type="button" class="btn btn-sm btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>


<div class="modal top fade" id="editReviewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="true" data-keyboard="true">
  <div class="modal-dialog ">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Update Review</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-5  text-center p-3 ">
        <h5 id="ReviewEditID" class="mt-4 d-none"></h5> 
        <div id="ReviewEditForm" class="w-100 d-none">
        <input id="ReviewNameID" class="form-control mb-4" type="text" placeholder="Review Name" />
        <input id="ReviewDesID" class="form-control mb-4" type="text" placeholder="Review" />
        </div>

        <img id="ReviewEditLoader" class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
        <h5 id="ReviewEditWrong" class="d-none">Something Went Wrong</h5>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">
          Cancel
        </button>
        <button  id="ReviewUpdateConfirmBtn" type="button" class="btn btn-sm btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>

<div class="modal top fade" id="addReviewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="true" data-keyboard="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-body p-5  text-center p-3 ">
          
        <div id="ReviewAddForm" class="w-100">
          <h6 class="mb-4">Add New Service</h6>
        <input id="ReviewNameAddID" class="form-control mb-4" type="text" placeholder="Review Name" />
        <input id="ReviewDesAddID" class="form-control mb-4" type="text" placeholder="Review" />
        <input id="ReviewImgAddID" class="form-control mb-4" type="text" placeholder="Review Image" />
        </div>

        </div>

        
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">
          Cancel
        </button>
        <button  id="ReviewAddConfirmBtm" type="button" class="btn btn-sm btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>


@endsection

@section('script')

<script type="text/javascript">
  
  getReviewData();

  



</script>

@endsection