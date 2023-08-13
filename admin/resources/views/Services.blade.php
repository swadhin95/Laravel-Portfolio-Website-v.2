@extends('Layout.app')

@section('content')

<div id="mainDiv" class="container d-none">
<div class="row">
<div class="col-md-12 p-5">
<table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
    
      <div class="modal-body text-center p-3 mt-4">
        <h5>Do you want to Delete?</h5>
        <h6 id="ServiceDeleteId" class="mt-4"> </h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">
          No
        </button>
        <button type="button" class="btn btn-sm btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')

<script type="text/javascript">
  
  getServicesData();

</script>

@endsection