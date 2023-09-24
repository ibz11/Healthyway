<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <div class="m-5 col-md-4 col-md-offset-4">
<h1 class="text-center"> Welcome  to Admin Dashboard</h1>
@if(Session::has('success'))
 <div class="alert alert-success">{{Session::get('success')}}</div>
 
 @endif

 @if(Session::has('Error'))
 <div class="alert alert-danger">{{Session::get('Error')}}</div>
 @endif
<hr>
<table class="table">
    <thead>
        <th>Name</th>
        <th>Email</th>
        <th>Action</th>
        <th>Enable 2FA</th>
        <th>Disable 2FA</th>
    </thead>

<tr>
<td>{{$data->full_name}}</td>
<td>{{$data->email}}</td>
<td><a class="btn btn-danger"href="{{URL('logout')}}">Logout</a></td>


@if($data->twoFA_enabled==1)
<td>
<a class="btn btn-outline-danger"href="{{URL('disable2FA',$data->id)}}">Disable</a>

</td>
@elseif($data->twoFA_enabled=0)
<td><a class="btn btn-success"href="{{URL('enable2FA',$data->id)}}">Enable</a></td>
@else
<td><a class="btn btn-success"href="{{URL('enable2FA',$data->id)}}">Enable</a></td> 

@endif


</tr>
</table>
@if($data->twoFA_enabled==1)
<h2>2FA is ON</h2>
@else
<h2>2FA is OFF</h2>
@endif
</div>   
</body>
</html>