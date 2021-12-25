
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href=" {{ asset('admin/css/style.css') }} ">
    <link rel="stylesheet" href=" {{ asset('admin/css/admin.css') }} ">
    <title>CRU</title>
</head>
<body>

    @extends('Sidebar.Sidebar')
   
   
   @extends('crus.layout')
    

    @section('content')

        
            <div class="col-lg-12 text-center" style="margin-top:10px;margin-bottom: 10px;">
                <a class="btn btn-success " href="{{ route('crus.create') }}"> Add cru</a>
            </div>
        </div>



        @if(sizeof($crus) > 0)
            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>x</th>
                    <th>y</th>
                    <th width="280px">More</th>
                </tr>
                @foreach ($crus as $cru)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $cru->product_name }}</td>
                        <td>{{ $cru->product_desc }}</td>
                        <td>{{ $cru->product_qty }}</td>
                        <td>
                            <form action="{{ route('crus.destroy',$cru->id) }}" method="POST">

                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
         
        @endif

  

    @endsection
    
    <script src="{{ asset('admin/js/script.js') }} "></script>
</body>
</html>


