@extends('_include.master')

@section('content')
  <div class="app-page-title">
    <div class="page-title-wrapper">
      <div class="page-title-heading">
        <div class="page-title-icon">
          <i class="pe-7s-rocket icon-gradient bg-mean-fruit">
          </i>
        </div>
        <div>
          Product
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 col-xl-12">
      <div class="card">
        <div class="card-body">
          <div class="feature-btn mb-3">
            <a href="javascript:void(0)" class="btn btn-primary " id="addProduct">Tambah</a> 
            <div class="modal fade mt-5" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form id="productForm" name="productForm">
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Title Product:</label>
                        <input type="text" class="form-control" name="title" id="title" required>
                      </div>
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Brands:</label>
                        <select name="brands" class="form-control "id="brands" required>
                          <option value="">-- Select Brand --</option>
                          <option value="Honda">Honda</option>
                          <option value="Yamaha">Yamaha</option>
                          <option value="Kawasaki">Kawasaki</option>
                          <option value="Suzuki">Suzuki</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Gender:</label>
                        <select name="gender" class="form-control" id="gender" required>
                          <option value="">-- Select Gender --</option>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Category:</label>
                          <select name="category" class="form-control" required  id="category">
                            <option value="">-- Select Category --</option>
                            @foreach ($categories as $category)
                             <option value="{{ $category->id }}">{{ $category->name }} </option>
                            @endforeach
                          </select>
                      </div>
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">SubCategory:</label>
                        <select name="subcategory" class="form-control"  required id="subcategory">
                          <option value="">-- Select Sub Category --</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <textarea class="form-control" required name="description" id="description"></textarea>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="btn-save" value="create_product">Save Changes</button>
                      </div>
                    </form>
                  </div>
                  
                </div>
              </div>
            </div>

            <a href="/product/export" target="_blank" class="btn btn-info">Export</a>
          </div>
          <table class="table table-striped table-hover text-center" id="dataTables" width="100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Title Product</th>
                <th>Brands</th>
                <th>Gender</th>
                <th>Category</th>
                <th>Sub Category</th>
                <th class="no-sort">Action</th>
              </tr>
            </thead>
            <tbody id="table_product">

              @foreach ($products as $product)
              <tr id="id_{{$product->id}}">
                <td>{{$loop->iteration}}</td>
                <td>
                  <input type="hidden" id="product_id" value="{{$product->id}}" >
                  {{$product->title}}
                </td>
                <td>{{$product->brands}}</td>
                <td>{{$product->gender}}</td>
                <td>{{$product->category ? $product->category->name : ""}}</td>
                <td>{{$product->subcategory ? $product->subcategory->parent : ""}}</td>
                <td>
                  <a href="javascript:void(0)" class="btn btn-info" id="show_btn_product" data-id="{{ $product->id }}"><i class="fa fa-eye"></i></a>
                  <a href="javascript:void(0)"class="btn btn-danger delete-product" id="delete-product" data-id="{{ $product->id }}"><i class="fa fa-trash"></i></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade mt-5" id="showProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <h4 class="text-center" id="id"></h4>
        </div>
      </div>
    </div>
  </div>
  <script>
    //tambahProduct 
    $('#addProduct').click(function () {
      $('#btn-save').val("create_product");
      $('#productForm').trigger("reset");
      $('#exampleModal').modal('show');
    });
    if ($("#productForm").length > 0) {
      $("#productForm").validate({
        submitHandler: function(form) {
          var actionType = $('#btn-save').val("create_product");
          $('#btn-save').html('Sending..');
          
          $.ajax({
            type: "POST",
            url: "{{route('add_product')}}",
            data: $('#productForm').serialize(),
            dataType: 'json',
            success: function (data) {
              var products = 
              '<tr id="id_' + data.id + '"><td>'+ data.id + '</td><td>'+ data.title + '</td><td>'+ data.brands + '</td><td>'+ data.gender + '</td><td>'+ data.category.name + '</td><td>'+ data.subcategory.parent + '</td>'
                products +='<td colspan="2"><a href="javascript:void(0)"" class="btn btn-info" id="show_btn_product" data-id="'+data.id+'"><i class="fa fa-eye"></i></a>';
                products +='<a href="javascript:void(0)" id="delete-product" data-id="' + data.id + '" class="btn btn-danger delete-product"><i class="fa fa-trash"></i></a></td></tr>';
              if (actionType) {
                $('#table_product').prepend(products);
              } else {
                $("#id_" + data.id).replaceWith(products);
              }
              $('#productForm').trigger("reset");
              $('#exampleModal').modal('hide');
              $('#btn-save').html('Save Changes');
              alert("Data Saved")
                
              
            
          },
          error: function (data) {
            console.log('Error:', data);
            $('#btn-save').html('Save Changes');
          }
        });
        }
      });
    }
    //akhirtambahproduct
</script>
@endsection
