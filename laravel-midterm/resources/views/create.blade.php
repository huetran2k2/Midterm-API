<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Food</title>
</head>
<body>
    <div class="container">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <form action = {{$action=='create' ? '/store': "/update/".$id}}  method="POST">
            @csrf
            <div class="form-group">
              <label for="">Name</label>
              <input type="text" name="name" class="form-control"  >
                
            </div>
            <div class="form-group">
                <label for="">Price</label>
                <input type="text" name="price" class="form-control"   >
              

            </div>
            <div class="form-group">
                <label for="">Old Price</label>
                <input type="text" name="old_price" class="form-control"  >
                
              </div>
              <div class="form-group">
                <label for="">Description</label>
                <input type="text" name="description" class="form-control"  >
               
              </div>
              <div class="form-group">
                <label for="">image</label>
                <input type="file" name="image" class="form-control"  >
              </div>
              <div class="form-group">
                <label for="">Category</label>
                <select name="category_id" class="form-control form-control-lg">
                    @foreach ($list as $category)
                    <option {{isset($T_foods) && $T_foods->category_id === $category->id ? 'selected' : ""}} value ={{$category->id}}>{{$category->categories}}</option>
                    @endforeach
                  </select>
              </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
    </div>
</body>
</html>