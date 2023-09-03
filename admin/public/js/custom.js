function getReviewData() {


    axios.get('/getReviewData')

        .then(function(response) {

            if (response.status == 200) {

                $('#mainDivReview').removeClass('d-none');
                $('#loaderDivReview').addClass('d-none');


                $('#ReviewDataTable').DataTable().destroy();
                $('#review_table').empty();


                var dataJSON = response.data;
                $.each(dataJSON, function(i, item) {
                    $('<tr>').html(
                        "<td>"+dataJSON[i].name+"</td>" +
                        "<td>"+dataJSON[i].des+"</td>" +
                        "<td><a class='ReviewEditBtn' data-id=" + dataJSON[i].id + "  ><i class='fas fa-edit'></i></a> </td>" +
                        "<td><a class='ReviewDeleteBtn' data-id=" + dataJSON[i].id + "  ><i class='fas fa-trash-alt'></i></a> </td>"
                    ).appendTo('#review_table');
                });


                //Review Table Delete Icon Click 
                $('.ReviewDeleteBtn').click(function() {
                    var id = $(this).data('id');
                    $('#ReviewDeleteID').html(id);
                    $('#deleteReviewModal').modal('show');
                })

                //Review Table Delete Icon Click 
                $('.ReviewEditBtn').click(function() {
                    var id = $(this).data('id');
                    ReviewUpdateDetails(id);
                    $('#ReviewEditID').html(id);
                    $('#editReviewModal').modal('show');
                })

                $('#ReviewDataTable').DataTable({"order":false});
                $('.dataTables_length').addClass('bs-select');

            } else {

                $('#loaderDivReview').addClass('d-none');
                $('#wrongDivReview').removeClass('d-none');

            }
        }).catch(function(error) {

            $('#loaderDivReview').addClass('d-none');
            $('#wrongDivReview').removeClass('d-none');

        });
}

$('#addNewReviewBtnID').click(function(){
    $('#addReviewModal').modal('show');
});


$('#ReviewAddConfirmBtm').click(function(){
   var ReviewName = $('#ReviewNameAddID').val();
   var ReviewDes = $('#ReviewDesAddID').val();
   var ReviewImg = $('#ReviewImgAddID').val();

   ReviewAdd(ReviewName,ReviewDes,ReviewImg);
})

function ReviewAdd(ReviewName,ReviewDes,ReviewImg) {


    if(ReviewName.length==0){

        toastr.error('Review  Name Is Empty');

    }else if(ReviewDes.length==0){

        toastr.error('Review  Description Is Empty');

    }else if(ReviewImg.length==0){

        toastr.error('Review  Image Is Empty');

    }
    else
    {
        $('#ReviewAddConfirmBtm').html("<div class='spinner-border spinner-border-sm' role='status'></div>");//Animation
        axios.post('/ReviewAdd', {
            name: ReviewName, 
            des: ReviewDes,
            img: ReviewImg
        })
        .then(function(response) {
            $('#ReviewAddConfirmBtm').html("Save"); 

            if(response.status==200){
                 
                if (response.data == 1) {
                    $('#addReviewModal').modal('hide');
                    toastr.success('Add Success');
                    getReviewData();
                } else {
                    $('#addReviewModal').modal('hide');
                    toastr.error('Add Fail');
                    getReviewData();
                }
            }
            else{
                $('#addReviewModal').modal('hide');
                    toastr.error('Something Went Wrong');
            }

        })
        .catch(function(error) {

                $('#addReviewModal').modal('hide');
                toastr.error('Something Went Wrong');
        });

    }
}


//Review Delete Model Yes Btn
$('#ReviewDeleteConfirmBtm').click(function() {
    var id = $('#ReviewDeleteID').html();
    ReviewDelete(id);
})


//Review Delete
function ReviewDelete(deleteID) {
    $('#ReviewDeleteConfirmBtm').html("<div class='spinner-border spinner-border-sm' role='status'></div>");//Animation
    
    axios.post('/ReviewDelete', {
            id: deleteID
        })
        .then(function(response) {

            $('#ReviewDeleteConfirmBtm').html("Yes");

            if(response.status==200){
                if (response.data == 1) {
                $('#deleteReviewModal').modal('hide');
                toastr.success('Delete Success');
                getReviewData();
                } else {
                    $('#deleteReviewModal').modal('hide');
                    toastr.error('Delete Fail');
                    getReviewData();
                }
            }
            else{
                $('#deleteReviewModal').modal('hide');
                toastr.error('Update Fail');
            }

        })
        .catch(function(error) {

            $('#deleteReviewModal').modal('hide');
            toastr.error('Update Fail');

        });
}

//Each Review Update Details
function ReviewUpdateDetails(detailsID) {
    axios.post('/ReviewDetails', {
            id: detailsID
        })
        .then(function(response) {
            if (response.status == 200) {
                $('#ReviewEditForm').removeClass('d-none');
                $('#ReviewEditLoader').addClass('d-none');


                var dataJSON = response.data;
                $('#ReviewNameID').val(dataJSON[0].name);
                $('#ReviewDesID').val(dataJSON[0].des);
            } else {
                $('#ReviewEditLoader').addClass('d-none');
                $('#ReviewEditWrong').removeClass('d-none');
            }


        })
        .catch(function(error) {
            $('#ReviewEditLoader').addClass('d-none');
            $('#ReviewEditWrong').removeClass('d-none');

        });

}


//Review Edit Model Save Btn
$('#ReviewUpdateConfirmBtn').click(function() {
    var ReviewID = $('#ReviewEditID').html();
    var ReviewName = $('#ReviewNameID').val();
    var ReviewDes = $('#ReviewDesID').val();
    ReviewUpdate(ReviewID, ReviewName, ReviewDes);
})

function ReviewUpdate(ReviewID, ReviewName, ReviewDes) {


    if(ReviewName.length==0){

        toastr.error('Review  Name Is Eampty');

    }else if(ReviewDes.length==0){

        toastr.error('Review  Description Is Eampty');

   
    }
    else{
        $('#ReviewUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");//Animation
        axios.post('/ReviewUpdate', {
            id: ReviewID,
            name: ReviewName,
            des: ReviewDes,

        })
        .then(function(response) {

            if(response.status==200){
                $('#ReviewUpdateConfirmBtn').html("Save");  
                if (response.data == 1) {
                    $('#editReviewModal').modal('hide');
                    toastr.success('Update Success');
                    getReviewData();
                } else {
                    $('#editReviewModal').modal('hide');
                    toastr.error('Update Fail');
                    getReviewData();
                }
            }
            else{
                $('#editReviewModal').modal('hide');
                    toastr.error('Update Fail');
            }

        })
        .catch(function(error) {

                $('#editReviewModal').modal('hide');
                toastr.error('Update Fail');
        });

    }


}
