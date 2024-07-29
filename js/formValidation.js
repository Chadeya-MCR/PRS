const form = document.querySelector('form');
const password = document.getElementById("password");
//console.log("hello world")

function checkInputs(){
    const userInputs = document.querySelectorAll(".form-input")
    
        for(const input of userInputs){
            if(input.value === ""){
                input.classList.add("error");
                input.parentElement.classList.add("error");
            }
            //call the checkEmail() func to validate the email
            if(userInputs [2].value !=""){checkEmailFormat();}
            userInputs[2].addEventListener("keyup", () => checkEmailFormat())

            input.addEventListener("keyup", () => {
                if(input.value !==""){
                    input.classList.remove("error");
                    input.parentElement.classList.remove("error");
                    //input.classList.add("correct")
                    //input.parentElement.classList.add("correct")
                }
                else{
                    input.classList.add("error");
                    input.parentElement.classList.add("error");
                }
            });
        }
}
//check passowrd lenght
function checkPasswordLengt(){
    if(!password){
        
    }
}

const  checkEmailFormat =()=>{
    const emailRegex = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/
    const emailErrTxt = document.querySelector(".emailError");
    if(!email.value.match(emailRegex)){
        email.classList.add("error")
        email.parentElement.classList.add("error");
            if(email.value !=""){
                emailErrTxt.innerText = "Looks like something is bad"
            }else{
                emailErrTxt.innerText = "Email address can't be blank!"
            }
    }else{
        email.classList.remove("error")
        email.parentElement.classList.remove("error");
    }
}
form.addEventListener("submit", (e)=>{
    //console.log('hello world')
    e.preventDefault();
    checkInputs()
})