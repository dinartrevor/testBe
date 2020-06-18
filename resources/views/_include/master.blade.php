<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Content-Language" content="en">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
	<title>Admin</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
	<meta name="description" content="This is an example dashboard created using build-in elements and components.">
	<meta name="msapplication-tap-highlight" content="no">
	<link href="{{ asset('assets-admin/main.css') }}" rel="stylesheet">
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('DataTables/datatables.css') }}">
 
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="{{ asset('assets-admin/scripts/jquery-3.4.1.js') }}"></script>
	<script src="{{ asset('DataTables/datatables.js') }}"></script>
	<script src="{{ asset('js/jquery-ui.js') }}"></script>
	<script src="{{ asset('js/popper.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/jquery.validate.js') }}"></script>
	
	<style type="text/css">
		/* Chart.js */
		@-webkit-keyframes chartjs-render-animation{
			from{
				opacity:0.99}to{opacity:1}
					}
			@keyframes chartjs-render-animation{
				from{opacity:0.99}to{opacity:1}
				}
			.chartjs-render-monitor{
				-webkit-animation:chartjs-render-animation 0.001s;
				animation:chartjs-render-animation 0.001s;
				}
		/* CKEditor */
		.ck-editor__editable{
			min-height: 300px;
		}
		.help-block{
			color: red;
		}
</style>
</head>
<body>
	<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
		@include('_include.header')
		<div class="app-main">
			@include('_include.sidebar')
			<div class="app-main__outer">
				<div class="app-main__inner">
					@yield('content')
				</div>
				<div class="app-wrapper-footer">
					<div class="app-footer">
						<div class="app-footer__inner">
							<div class="app-footer-left">
								<ul class="nav">
									<li class="nav-item">
										<a href="javascript:void(0);" class="nav-link">
										CopyRight Dinar
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@yield('footer')
<div class="jvectormap-tip"></div>
<script type="text/javascript" src="{{ asset('assets-admin/scripts/main.js') }}"></script>
<script>
  $(document).ready(function() {
    $('#dataTables').DataTable([{
			responsive : true,
			
	}]);
	
	
  });
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$( "#datepicker" ).datepicker({dateFormat:"dd MM yy"}).datepicker("setDate",new Date());
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		//deleteproduct
		$('body').on('click', '.delete-product', function () {
			var id = $(this).data("id");
			if(confirm("Apakah Kamu yakin untuk menghapus?")) {
			$.ajax({
				type: "DELETE",
				url: "/product/delete/"+id,
				data: {
					"_token": "{{ csrf_token() }}",
					"id": id
					},
				success: function (data) {
					$("#id_" + id).remove();
					alert("Data Deleted");
				},
				error: function (data) {
					console.log('Error:', data);
				}
			});
		   }
		});   

		//akhirdeleteproduct

		//deleteCategory
		$('body').on('click', '.category_btn', function () {
			var category_id = $(this).data("id");
			if(confirm("Apakah Kamu yakin untuk menghapus?")) {
			$.ajax({
				type: "DELETE",
				url: "/kategori/delete/"+category_id,
				data: {
					"_token": "{{ csrf_token() }}",
					"id": category_id
					},
				success: function (data) {
					$("#category_id_" + category_id).remove();
					alert("Data Deleted");
				},
				error: function (data) {
					console.log('Error:', data);
				}
			});
		   }
		});   
		//akhirdeletecategory

		//deleteSubCategory
		$('body').on('click', '.subcategory_btn', function () {
			var subcategory_id = $(this).data("id");
			if(confirm("Apakah Kamu yakin untuk menghapus?")) {
			$.ajax({
				type: "DELETE",
				url: "/subcategory/delete/"+subcategory_id,
				data: {
					"_token": "{{ csrf_token() }}",
					"id": subcategory_id
					},
				success: function (data) {
					$("#subcategory_id_" + subcategory_id).remove();
					alert("Data Deleted");
					//location.reload();
				},
				error: function (data) {
					console.log('Error:', data);
				}
			});
		   }
		});   
		//akhirdeleteScategory

		//showtitleproduct
		$('body').on('click', '#show_btn_product', function () {
			var id = $(this).data('id');
			$.get('product/' + id +'/detail', function (data) {
				$('#showProduct').modal('show');
				$('#id').text(data.title);
			})
		 });
		//akhirshowtitleproduct
		 
		//categorySubcategory
		$('#category').on('change',function(e){
	
			var category_id = e.target.value;
			$.get('/product/subcategory?category_id=' + category_id, function(data){
				$('#subcategory').empty();
				$.each(data, function(index, subcatObj){
					$('#subcategory').append('<option value="'+subcatObj.id+'">'+subcatObj.parent+'</option>');
				});
			});
		});
		//akhircategorySubcategory
	});
  </script>
 
  <script>

  </script>
</body>
</html>