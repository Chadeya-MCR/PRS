const form = document.querySelector('form');
const firstname = document.getElementById("firstname");
const lastname = document.getElementById("lastname");
const email = document.getElementById("email");
const password = document.getElementById("password");
const confirmed_password = document.getElementById("cpassword");
const button = document.getElementById("button")

//console.log("hello world")

function checkInputs (){
    const userInputs = document.querySelectorAll(".form-input");
    //loop thru all the inputs to check if they are empty
    for(let input of userInputs){
        if(input ===""){
            console.log("userinputs are empty")
            input.classList.add("error");
            input.parentElement.add("error");
        }
        input.addEventListener("keyup", ()=>{
            if(input !=""){
                input.classList.remove("error");
                input.parentElement.remove("error");
            }else{
                input.classList.add("error");
                input.parentElement.add("error");
            }
        })
    }
}

function validateEmail () {
    const emailregex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
};
button.addEventListener("click", (e)=>{
    console.log('hello world')
    e.preventDefault();
    checkInputs()
})

