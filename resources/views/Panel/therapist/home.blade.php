@extends('therapist.layout')


<div class="container-fluid">
<div class="text-center mt-5">
<h1 style="color:white;font-size:40px;"><strong>Hello! <span style="color:aqua;">{{(Auth::user()->full_name)}}  </span>. Welcome to the Admin Dashboard</strong></h1>
</div>
<div class="row">

    <!-- <div class="col-sm-4 mt-1">
      <div class="card bg-dark text-light ">
    
        <div class="card-body d-flex align-items-center justify-content-center">
        <div>

        <h1 class="card-title number">90</h1>     
        <h3>USERS</h3>

        <div class="icon"> 
        <i class="icon fa-solid fa-chart-line"></i>
        </div> 
        <!-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> 
        <a href="#" class="mt-1 btn btn-outline-light">View</a>
</div>
</div>
</div>
</div> -->




<div class="col-sm-4 mt-1">
    <div class="card bg-dark text-light ">
      <!--  -->
      <div class="card-body d-flex align-items-center justify-content-center">
      <div>

      <h1 class="card-title number">90</h1>     
      <h3 class="mt-3">Pedestrians</h3>
      </div>
      <div class="">
      <div class="m-2 icon"> 
      <i class="icon fa-solid fa-chart-line"></i>
      </div> 
      <!-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> -->
      <a href="#" class="m-2 btn btn-outline-light">View</a>
     </div>
</div>
</div>
</div>


<div class="col-sm-4 mt-1">
    <div class="card bg-dark text-light ">
      <!--  -->
      <div class="card-body d-flex align-items-center justify-content-center">
      <div>

      <h1 class="card-title number">90</h1>     
      <h3 class="mt-3">Pedestrians</h3>
      </div>
      <div class="">
      <div class="m-2 icon"> 
      <i class="icon fa-solid fa-chart-line"></i>
      </div> 
      <!-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> -->
      <a href="#" class="m-2 btn btn-outline-light">View</a>
     </div>
</div>
</div>
</div>

<div class="col-sm-4 mt-1">
    <div class="card bg-dark text-light ">
      <!--  -->
      <div class="card-body d-flex align-items-center justify-content-center">
      <div>

      <h1 class="card-title number">90</h1>     
      <h3 class="mt-3">Pedestrians</h3>
      </div>
      <div class="">
      <div class="m-2 icon"> 
      <i class="icon fa-solid fa-chart-line"></i>
      </div> 
      <!-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> -->
      <a href="#" class="m-2 btn btn-outline-light">View</a>
     </div>
</div>
</div>
</div>

<!---Tables-->
<div  style="border-radius:10px;margin:1em;" class="mt-3 text-light bg-dark table-responsive">
<table style="border-radius:.3em;"class=" bg-dark text-light table">
<thead>
<tr>

<th scope="col">User id</th>
<th scope="col">Full Name</th>
<th scope="col">Create</th>
<th scope="col">Update</th>
<th scope="col">Delete</th>
</tr>

</thead>
<tbody>
<tr>

<th scope="row">My ID</th>
<td>My name</td>
        

     
     <!--    <td>
       @if($user->role == 'admin')
       <span class="badge bg-danger">{{$user->role}}</span>
       @elseif($user->role == 'tenant') 
       <span class="badge bg-warning">{{$user->role}}</span> 
        @else
        @endif 
        </td> -->
<td>  
<a href="" 
style=" background:linear-gradient(to right,#1FA2FF,#0d2f35 ,#155799,#12D8FA);"

class="btn btn-primary"><strong>Create</strong></a>
</td>

<td>
<a href="" 
style=" background:linear-gradient(to right,#159957,#155799);"
class="btn btn-success"><strong>Update</strong></a>
</td>

<td>
<a href=""
style=" background:linear-gradient(to right,#833ab4,#fd1d1d,#fcb045);"
    class="btn btn-danger"><strong>Delete</strong></a>
</td>
 

    </tr>
</table>
</div>  

<!-- Update Form -->
<form action="" 
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
    
    <div   class="mb-3 mt-3">
    <h1 >Update Content</h1>
    </div>
    <div   class="mb-3 mt-3">
    <label for="email" class="text-light form-label"><strong>Label 1</strong> </label>
    <input type="text" class="bg-dark text-light form-control w-100" id="name" value="Text" name="">
  </div> 
  <div   class="mb-3 mt-3">
    <label for="date" class="text-light form-label"><strong>Label 2</strong> </label>
    <input type="date" class="bg-dark text-light form-control w-100" id="name" value="{{$rm->Date_created}}" name="">
  </div> 
  <div   class="mb-3 mt-3">
    <label for="date" class="text-light form-label"><strong>Label 2</strong> </label>
    <select class="w-100 bg-dark text-light form-select" aria-label="Default select example">
        <option selected>Open this select menu</option>
        <option value="1">One</option>
        <option value="2">Two</option>
        <option value="3">Three</option>
      </select>
  </div> 

  
<button type="submit"
style=" background:linear-gradient(to right,#159957,#155799);"
class="btn btn-success"><strong>Update</strong></button>

<a href="{{URL('rentmonth')}}" class="btn btn-outline-warning">Back</a>
  
          
</form>
 

<!-- Expert system Form -->
<form action="" 
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
    
<div   class="mb-3 mt-3">
<h1>Expert system Form</h1>
<p>Explain test here</p>
</div>
   
<div style ="display: flex; flex-direction:row; justify-content: space-between;"class="mb-3 mt-3">
<div class="m-2">
    <label for="date" class="text-light form-label"><strong>Q.1 Using a telephone in public</strong> </label>
</div>
<div class="m-2">
    <select class="w-10 bg-dark text-light form-select" aria-label="Default select example">
        <option selected>Fear</option>
        <option value="0">0 None</option>
        <option value="1">1 Mild</option>
        <option value="2">2 Moderate</option>
        <option value="3">3 Severe</option>
      </select>
    </div>

  <div class="m-2">
      <select class="w-100 bg-dark text-light form-select" aria-label="Default select example">
        <option selected>Avoidance</option>
        <option value="0">0 Never</option>
        <option value="1">1 Occasionally</option>
        <option value="2">2 Often</option>
        <option value="3">3 Usually</option>
      </select>
    </div>
  </div> 

<button type="submit"
style=" background:linear-gradient(to right,#1FA2FF,#0d2f35 ,#155799,#12D8FA);"

class="btn btn-primary"><strong>Submit</strong></button>

            
</form>


<div style=" border-radius:.5em;background:white;" class="m-1">
<canvas style="" id="myChart"></canvas>
</div>


  
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
<script>
    const ctx = document.getElementById('myChart');
    let mydata=[12, 19, 3, 5, 2, 3]
    let deta=[]
    for (let i in mydata){
    deta.push(mydata[i])
    console.log(mydata[i])
    }
    
  
    new Chart(ctx, {
      type: 'line',
      data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
          label: '# of Votes',
          data: deta ,
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>




</div> 
@endsection