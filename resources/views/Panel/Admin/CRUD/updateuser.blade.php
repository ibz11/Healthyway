@include('./Panel/Admin/header')
<!-- Update Form -->

<form action="{{URL('updateuser',$user->id)}}" 
style="
color:white;
background:linear-gradient(to right,#141E30,#243B55);
border-radius:.4em;
width:fit-content;
height: fit-content;
padding: 2em;
margin:2em;
"
method="POST" id="editform"enctype="multipart/form-data">
@csrf
    
    <div   class="mb-3 mt-3">
    <h1 >Update User</h1>
    </div>
    <div   class="mb-3 mt-3">
    <label for="email" class="text-light form-label"><strong>Full name</strong> </label>
    <input type="text" class="bg-dark text-light form-control w-100" id="name" value="{{$user->full_name}}" name="full_name">
  </div> 
  <div   class="mb-3 mt-3">
    <label for="email" class="text-light form-label"><strong>Email</strong> </label>
    <input type="text" class="bg-dark text-light form-control w-100" id="name" value="{{$user->email}}" name="email">
  </div> 
  <div   class="mb-3 mt-3">
    <label for="email" class="text-light form-label"><strong>Phone Number</strong> </label>
    <input type="text" class="bg-dark text-light form-control w-100" id="name" value="{{$user->phone}}" name="phone">
  </div> 


  <!-- <div   class="mb-3 mt-3">
    <label for="date" class="text-light form-label"><strong>Label 2</strong> </label>
    <input type="date" class="bg-dark text-light form-control w-100" id="name" value="" name="">
  </div>  -->
  <div   class="mb-3 mt-3">
    <label for="date" class="text-light form-label"><strong>User Role</strong> </label>
    <select class="w-100 bg-dark text-light form-select" name="role" aria-label="Default select example">
        <option value="{{$user->role}}">Current Role:( {{$user->role}} ) </option>
        <option value="admin">admin</option>
        <option value="therapist">therapist</option>
        <option value="student">Three</option>
      </select>
  </div> 

  
<button type="submit"
style=" background:linear-gradient(to right,#159957,#155799);"
class="btn btn-success"><strong>Update</strong></button>

<a href="{{URL('users')}}" class="btn btn-outline-warning">Back</a>
  
          
</form>
</div>


@include('Panel/Admin/footer')