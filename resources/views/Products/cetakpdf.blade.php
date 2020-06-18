<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Product</title>
</head>
<body>
    <div style="text-align: Center">
        <h2>
          PRODUCT
        </h2>
    </div>
    <hr>
    <table border="1" style="text-align: center; margin-top: 25px; margin-bottom: 25px;" >
        <thead>
          <tr>
            <th width="100px">Total Product</th>
            <th width="100px">{{$countProduct->count()}}</th>
          </tr>
        </thead>
        <tbody>
    
        </tbody>
      </table>
    <table border="1" style="text-align: center;" >
        <thead>
          <tr>
            <th width="20px">No</th>
            <th width="120px">Title Product</th>
            <th width="120px">Brands</th>
            <th width="120px">Gender</th>
            <th width="120px">Category</th>
            <th width="120px">Sub Category</th>
          </tr>
        </thead>
        <tbody>

          @foreach($products as $product)
            <tr>
              <td>{{$loop->iteration}}</td>
              <td >{{$product->title}}</td>
              <td >{{$product->brands}}</td>
              <td >{{$product->gender}}</td>
              <td >{{$product->category->name}}</td>
              <td >{{$product->subcategory->parent}}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
      
</body>
</html>