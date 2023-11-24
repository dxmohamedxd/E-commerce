


 

var form = document.querySelector("form")
if(form){

form.addEventListener("submit",function (event){

    if(!form.checkValidity()){
        event.preventDefault()
        form.classList.add("was-validated")
    }
});
}
// console.log("hello")
function showModel(){
    var  myModal = new bootstrap.Modal(document.querySelector('#myModal'))
    myModal.show()
 }


