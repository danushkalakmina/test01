
document.getElementById('cusLBtn').addEventListener('click',()=>{

    const cusEmail = document.getElementById('inputEmail')
    const cusPass = document.getElementById('inputPassword')
    const cusCheck = document.getElementById('inputPassword')
    const cusMsg = document.getElementById('errMsg')

    const allElements = [...document.querySelectorAll("input")]
    const allDataValid = allElements.every(value => value.reportValidity())
    

    if (!allDataValid)return

    $.ajax({
        type: "POST",
        url: 'datacall/datalogin.datacall.php',
        dataType: 'JSON',
        data: {emailId: allElements[0].value,emailPass: allElements[1].value},
        success: (status) => {

            console.log(status)

            if(status){

                location.replace("index.php");

            }else{

                if (status) {
                    
                }else{

                    const userCookie = document.cookie; 
           
                        var userCookieCollect = userCookie.split(";")
                        var attemt = ''
                        var email = md5(allElements[0].value)
      



                        for (let index = 1; index <= userCookieCollect.length; index++) {

         

                            var attemts = userCookieCollect[index-1].split("=");



                            if(attemts[0].match(email)){

                                attemt = attemts[1]

                            }
                    
                        }
                        var message = ''

                        if (parseInt(attemt)>0) {
                             message = `<center>Login Unsuccessful! <br> Invalid userid or password.<br>You are left with ${attemt} more attempts</center>`;
                        }else{
                             message = `<center>Login Unsuccessful! <br> Invalid userid or password.<br>User Blocked Contact Admin</center>`;
                        }
                        cusMsg.innerHTML = message
                        cusEmail.value=''
                        cusPass.value=''

                }


                
            }

        }
    })


})