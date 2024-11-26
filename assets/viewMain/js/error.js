//Alert for register
const registerbtn = document.querySelector('.registerbutton');
const fname = document.querySelector('#first-name');
const lname = document.querySelector('#last-name');
const email = document.querySelector('#email');
const password = document.querySelector('#pw');
const cpassword = document.querySelector('#cpw');
const tnc = document.querySelector('#tnc');
const closebtn = document.querySelector('#close-popup-btn');


registerbtn.addEventListener('click', ()=>{
    if(!fname.value.length && !lname.value.length && !email.value.length && !password.value.length && !cpassword.value.length && !tnc.checked){
        showAlert('Please fill in the form');
    }
    else if(fname.value.length<1){
        showAlert('Please fill in your first name');
    }
    else if (lname.value.length<1){
        showAlert('Please fill in your last name');
    }
    else if (!email.value.length){
        showAlert('Please fill in the email');
    }
    else if(password.value.length < 6){
        showAlert('Password should be 6 character long or more ');
    }
    else if(password.value !== cpassword.value){
        showAlert('The password is different, please check your passwords');
    }
    else if(!tnc.checked){
        showAlert('You must agree to the terms & condition to create an account.');
    }
    else{
        //submit
        showAlert('Success');
    }
})

//function (register)
const showAlert = (msg) =>{
    let alertBox = document.querySelector('.alert');
    let alertMsg = document.querySelector('.alert-msg')
    alertMsg.innerHTML = msg;
    alertBox.classList.add('show');
    

    closebtn.addEventListener("click", ()=>{
        alertBox.classList.remove('show');
    })
}


