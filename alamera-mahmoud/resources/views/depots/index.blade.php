
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href=" {{ asset('admin/css/style.css') }} ">
    <link rel="stylesheet" href=" {{ asset('admin/css/admin.css') }} ">
    <title>Depot</title>
</head>
<body>

    @extends('Sidebar.Sidebar')
   
   
   @extends('depots.layout')
    

    @section('content')

        
            <div class="col-lg-12 text-center" style="margin-top:10px;margin-bottom: 10px;">
                <a class="btn btn-success " href="{{ route('depots.create') }}"> Add depot</a>
            </div>
        </div>



        @if(sizeof($depots) > 0)
            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>x</th>
                    <th>y</th>
                    <th width="280px">More</th>
                </tr>
                @foreach ($depots as $depot)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $depot->product_name }}</td>
                        <td>{{ $depot->product_desc }}</td>
                        <td>{{ $depot->product_qty }}</td>
                        <td>
                            <form action="{{ route('depots.destroy',$depot->id) }}" method="POST">

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


