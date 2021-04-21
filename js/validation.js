const  formLogin = document.getElementById('formlogin');
const  formSignup = document.getElementById('formsignup');
const  formAccount = document.getElementById('formaccount');

const expressions = {
    username:/^[a-z0-9]{6,}$/,
    password:/^[a-zA-Z-]{6,}$/,
    email:/[-a-zA-Z0-9@:%_\+.~#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~#?&//=]*)?/,
    phone:/^[0-9]{10,}$/,
    date: /^(\d{4})\.\d{2}\.\d{2}$/
}

let correctUsername = false;
let correctPassword = false;
let correctEmail = false;
let correctPhone = false;
let correctDate = false;


const validateForm = (e)=> {
    switch(e.target.name){
        case "username":
            if(expressions.username.test(e.target.value)){
                if(e.target.value.replace(/[^a-z]/g,"").length >= 4 && e.target.value.replace(/[^0-9]/g,"").length >= 2){
                    correctUsername = true;
                 }else{
                     correctUsername = false;
                 }
                
            }else{
                correctUsername = false; 
            }
        break;
        case "password":
            if(expressions.password.test(e.target.value)){
                if(e.target.value.replace(/[^-]/g,"").length === 1 && e.target.value.replace(/[^A-Z]/g,"").length === 1){
                    correctPassword = true;
                }else{
                    correctPassword = false;
                }
                
            }else{
                correctPassword = false; 
            }
        break;
        case "email":
            if(expressions.email.test(e.target.value)){
                correctEmail = true;
            }else{
                correctEmail = false; 
            }
        break;
        case "phone":
            if(expressions.phone.test(e.target.value)){
                correctPhone = true;
            }else{
                correctPhone = false; 
            }
        break;
        case "date":
            if(expressions.date.test(e.target.value)){
                correctDate = true;
            }else{
                correctDate = false; 
            }
        break;
        
    }

}

// Validation Login form

if(formLogin){
 var inputs = formLogin.querySelectorAll('input:not([type="submit"])');
 var submit = formLogin.querySelector('input[name="submit"]');

 formLogin.addEventListener('submit', (e) =>{
    e.preventDefault();
});

 inputs.forEach((input) =>{
     input.addEventListener('keyup',validateForm);
 });

 submit.addEventListener('click',(e) =>{
     if (!correctUsername || !correctPassword){
        e.preventDefault();
         alert("You must complete all fields correctly");
     }
 });
 
}

// Validation Signup form

if(formSignup){
 var inputs = formSignup.querySelectorAll('input:not([type="submit"])');
 var submit = formSignup.querySelector('input[name="submit"]');

 formSignup.addEventListener('submit', (e) =>{
    e.preventDefault();
});

 inputs.forEach((input) =>{
     input.addEventListener('keyup',validateForm);
 });

 submit.addEventListener('click',(e) =>{
     if (!correctUsername || !correctPassword || !correctEmail || !correctPhone){
        e.preventDefault();
         alert("You must complete all fields correctly");
     }
 });
 
}
// Validation  form

if(formAccount){
 var inputs = formLogin.querySelectorAll('input:not([type="submit"])');
 var submit = formLogin.querySelector('input[name="submit"]');

 formLogin.addEventListener('submit', (e) =>{
    e.preventDefault();
});

 inputs.forEach((input) =>{
     input.addEventListener('keyup',validateForm);
 });

 submit.addEventListener('click',(e) =>{
     if (!correctDate){
        e.preventDefault();
         alert("You must complete all fields correctly");
     }
 });
 
}