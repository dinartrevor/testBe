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
          Kategori
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 col-xl-12">
      <div class="card">
        <div class="card-body">
          <div class="feature-btn mb-3">
            <a href="javascript:void(0)" class="btn btn-primary " id="addSubCategory">Tambah</a> 
            <div class="modal fade mt-5" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Sub Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form id="subcategoryForm">
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Category:</label>
                        <select name="category_id" class="form-control" required>
                            <option value="">-- Select Category --</option>
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Sub Category:</label>
                        <input type="text" name="parent" class="form-control" required>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="btn-save" value="create_subcategory">Send message</button>
                      </div>
                    </form>
                  </div>

                </div>
              </div>
            </div>
            
          </div>
          <table class="table table-striped table-hover" id="dataTables" width="100%">
            <thead class="text-center">
              <tr>
                <th>No</th>
                <th>Category</th>
                <th>Parent</th>
                <th class="no-sort">Action</th>
              </tr>
            </thead>
            <tbody id="table_subcategory">
                @foreach ($sub as $s)
                  <tr id="subcategory_id_{{$s->id}}">
                      <td>{{$s->id}}</td>
                      <td>
                        {{$s->category ? $s->category->name : ""}}
                      </td>
                      <td>{{$s->parent}}</td>
                      <td>
                      <a href="javascript:void(0)"class="btn btn-danger subcategory_btn" data-id="{{$s->id}}"><i class="fa fa-trash"></i></a>
                      </td>
                  </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <script>
    //tambahSubCategory
    $('#addSubCategory').click(function () {
      $('#btn-save').val("create_subcategory");
      $('#subcategoryForm').trigger("reset");
      $('#exampleModal1').modal('show');
    });
    if ($("#subcategoryForm").length > 0) {
      $("#subcategoryForm").validate({
        submitHandler: function(form) {
          var actionType = $('#btn-save').val("create_subcategory");
          $('#btn-save').html('Sending..');
          
          $.ajax({
            type: "POST",
            url: "{{route('add_subcategory')}}",
            data: $('#subcategoryForm').serialize(),
            dataType: 'json',
            success: function (data) {
              var subcategory = 
              '<tr id="subcategory_id_' + data.id + '"><td>'+ data.id + '</td><td>'+ data.category.name + '</td><td>'+data.parent+'</td>'
                subcategory +='<td><a href="javascript:void(0)" id="subcategory_btn" data-id="' + data.id + '" class="btn btn-danger subcategory_btn"><i class="fa fa-trash"></i></a></td></tr>';
              if (actionType) {
                $('#table_subcategory').prepend(subcategory);
              } else {
                $("#subcategory_id_" + data.id).replaceWith(subcategory);
              }
              $('#subcategoryForm').trigger("reset");
              $('#exampleModal1').modal('hide');
              $('#btn-save').html('Save Changes');
              alert("Data Saved");
            
          },
          error: function (data) {
            console.log('Error:', data);
            $('#btn-save').html('Save Changes');
            alert("Data Not Saved");
          }
        });
        }
      });
    }
    //akhirtambahSubCategory
  </script>
@endsection
