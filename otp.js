const inputs = document.querySelectorAll(".otp-inputs input");

inputs.forEach((input, index) => {

    input.addEventListener("input", () => {

        input.value = input.value.replace(/[^0-9]/g,"");

        if(input.value && index < inputs.length-1){
            inputs[index+1].focus();
        }

    });

    input.addEventListener("keydown",(e)=>{

        if(e.key==="Backspace" && input.value==="" && index>0){
            inputs[index-1].focus();
        }

    });

});

document.querySelector("form").addEventListener("submit", function (e) {

    let otp = "";

    inputs.forEach(input => {
        otp += input.value;
    });

    if (otp.length !== 4) {
        e.preventDefault();
        alert("Please enter 4 digit OTP");
    }

});