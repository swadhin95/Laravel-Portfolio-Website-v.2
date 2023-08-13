$(document).ready(function () {
$('#VisitorDt').DataTable();
$('.dataTables_length').addClass('bs-select');
});


function getServicesData(){


	axios.get('/getServicesData')
	.then(function(response){

		if(response.status==200){

			$('#mainDiv').removeClass('d-none');
			$('#loaderDiv').addClass('d-none');


		var dataJSON=response.data;
		$.each(dataJSON,function(i,item){
			$('<tr>').html(
				"<td><img class='table-img' src="+dataJSON[i].service_img+"> </td>"+
				"<td>"+dataJSON[i].service_name+" </td>"+
				"<td>"+dataJSON[i].service_des+" </td>"+
				"<td><a href='' ><i class='fas fa-edit'></i></a> </td>"+
				"<td><a class='ServiceDeleteBtn' data-id="+dataJSON[i].id+"  ><i class='fas fa-trash-alt'></i></a> </td>"
				).appendTo('#service_table');
		});

		$('.ServiceDeleteBtn').click(function(){
			var id =$(this).data('id');
			
		$('#ServiceDeleteId').html(id);
		$('#deleteModal').modal('show');

		})


		}
		else{

			$('#loaderDiv').addClass('d-none');
			$('#wrongDiv').removeClass('d-none');

		}
	}).catch(function (error) {

			$('#loaderDiv').addClass('d-none');
			$('#wrongDiv').removeClass('d-none');

		});
}



