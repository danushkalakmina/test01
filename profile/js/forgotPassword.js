function emailCheck(email) {

    const mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

    if (!email.value.match(mailformat)) return

     console.log(email.value)

    $.ajax({
        type: "POST",
        url: 'datacall/datacalljs.datacall.php',
        dataType: 'JSON',
        data: {emailid: email.value},
        success: (status) => {

            if(status){

                document.getElementById('emailInfo').innerText=''
                document.getElementById('restPass').disabled = false;
            }else{
                document.getElementById('emailInfo').innerText= 'You dont have an account'
                document.getElementById('emailInfo').style.color = "red";
                document.getElementById('restPass').disabled = true;

            }



        }
    })


    
}

document.getElementById("restPass").addEventListener('click',()=>{

    const email = document.getElementById("userMail").value
    const mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

    if (!email.match(mailformat)) return

    $.ajax({
        type:"POST",
        url:"datacall/datacalljs.datacall.php",
        data: {emailPassOTP: email},
        success: (status) => {


        }
    })




});