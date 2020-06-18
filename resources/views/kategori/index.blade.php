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
           <a href="javascript:void(0)" class="btn btn-primary " id="addCategory">Tambah</a> 
            <div class="modal fade mt-5" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form id="categoryForm" >
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Name:</label>
                        <input type="text" class="form-control" name="name" required id="name">
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="btn-save" value="create_category">Send message</button>
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
                <th class="no-sort">Action</th>
              </tr>
            </thead>
            <tbody id="table_category">
              @foreach ($categories as $category)
              <tr id="category_id_{{$category->id}}">
                <td>{{$category->id}}</td>
                <td>
                  {{$category->name}}
                </td>
                <td>
                  <a href="javascript:void(0)"class="btn btn-danger category_btn"  data-id="{{ $category->id }}"><i class="fa fa-trash"></i></a>
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
    //tambahKategori
    $('#addCategory').click(function () {
      $('#btn-save').val("create_category");
      $('#categoryForm').trigger("reset");
      $('#exampleModal2').modal('show');
    });
    if ($("#categoryForm").length > 0) {
      $("#categoryForm").validate({
        submitHandler: function(form) {
          var actionType = $('#btn-save').val("create_category");
          $('#btn-save').html('Sending..');
          
          $.ajax({
            type: "POST",
            url: "{{route('add_category')}}",
            data: $('#categoryForm').serialize(),
            dataType: 'json',
            success: function (data) {
              var category = 
              '<tr id="category_id_' + data.id + '"><td>'+ data.id + '</td><td>'+ data.name + '</td>'
                category +='<td><a href="javascript:void(0)" id="category_btn" data-id="' + data.id + '" class="btn btn-danger category_btn"><i class="fa fa-trash"></i></a></td></tr>';
              if (actionType) {
                $('#table_category').prepend(category);
              } else {
                $("#category_id_" + data.id).replaceWith(category);
              }
              $('#categoryForm').trigger("reset");
              $('#exampleModal2').modal('hide');
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
    //akhirtambahkategori
  </script>
@endsection
