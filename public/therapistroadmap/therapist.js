let toggleDiv=document.getElementById('timeline');
// document.getElementsByClassName('timeline');

// document.getElementById('toggle')

let toggleBtn=document.getElementById('toggleBtn');
let change=true;

toggleBtn.addEventListener("click", toggleMyDiv);
function toggleMyDiv(){
    if(toggleDiv.style.display=='none'){
        toggleDiv.style.display='block';
        console.log('toggle')
      }
      else{
        toggleDiv.style.display='none';
        console.log('block')
    
      }   
}




// const element = document.getElementById("myBtn");
// element.addEventListener("click", myFunction);

// function myFunction() {
//   document.getElementById("demo").innerHTML = "Hello World";
// }
