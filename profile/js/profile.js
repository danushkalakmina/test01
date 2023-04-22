var imageStatus = "";
var userChange = "";
function allTypes() {

    const typeAll = document.getElementById('typeAll')

    userChange = "change"

    $.ajax({

        type:'POST',
        url:'datacall/profile.datacall.php',
        dataType: 'JSON',
        data:{'dataTypes':'dataTypes'},
        success:(status)=>{

            typeAll.innerHTML = ''

            typeAll.innerHTML = `<select class="form-select form-control data_Pass" id="typeList" required>
            <option selected disabled value="">Select Type</option>
          </select>`;
          typeListPass = document.getElementById('typeList')


            for (let index = 0; index < status.length; index++) {

                const option = document.createElement('option')
                option.value = status[index]['typeId']
                option.setAttribute('data-typeId',status[index]['typeId'])
                option.innerText = status[index]['typeName']
                typeListPass.appendChild(option)

            }

        }
    })
    
};

function allDistric() {

    const districAll = document.getElementById('districAll')

    console.log(districAll)

    userChange = "change"

    $.ajax({

        type:'POST',
        url:'datacall/profile.datacall.php',
        dataType: 'JSON',
        data:{'datadistricAll':'districAll'},
        success:(status)=>{

            console.log(status)
            districAll.innerHTML = ''

            districAll.innerHTML = `<select class="form-select form-control data_Pass" id="districAllElement" onchange="allCity();" required>
            <option selected disabled value="">Select Type</option>
          </select>`;
          districListPass = document.getElementById('districAllElement')


            for (let index = 0; index < status.length; index++) {

                const option = document.createElement('option')
                option.value = status[index]['districId']
                option.setAttribute('data-districID',status[index]['districId'])
                option.innerText = status[index]['districName']
                districListPass.appendChild(option)

            }

        }
    })

    
    
};

function allCity() {


    const cityAll = document.getElementById('cityAll')

    userChange = "change"

        try {
        const dList = document.getElementById('districAllElement')
        var districAll = districAll = dList.options[dList.selectedIndex].text
        
        }
        catch(err) {

        var districAll = document.getElementById('districAllElement').innerText

        }
        

    



    console.log(districAll)

    cityAll.innerHTML = ''

            cityAll.innerHTML = `<select class="form-select form-control data_Pass" id="cityList" required>
            <option selected disabled value="">Select Type</option>
          </select>`;
          cityListPass = document.getElementById('cityList')

    $.ajax({

        type:'POST',
        url:'datacall/profile.datacall.php',
        dataType: 'JSON',
        data:{'datacityAll':districAll},
        success:(status)=>{

            console.log(status)
            


            for (let index = 0; index < status.length; index++) {

                const option = document.createElement('option')
                option.value = status[index]['cityId']
                option.setAttribute('data-cityID',status[index]['cityId'])
                option.innerText = status[index]['cityName']
                cityListPass.appendChild(option)

            }

        }
    })
    

};

document.getElementById("userName").addEventListener('keyup',e=>{

    e.target.removeAttribute("data-userName")
    e.target.setAttribute("data-userName",e.target.value)
    userChange = "change"


});


document.getElementById("userName").addEventListener('keyup',e=>{

    e.target.removeAttribute("data-userName")
    e.target.setAttribute("data-userName",e.target.value)
    userChange = "change"


});

document.getElementById("userContact").addEventListener('keyup',e=>{

    e.target.removeAttribute("data-cntNum")
    e.target.setAttribute("data-cntNum",e.target.value)
    userChange = "change"


});

document.getElementById("companyName").addEventListener('keyup',e=>{

    e.target.removeAttribute("data-companyName")
    e.target.setAttribute("data-companyName",e.target.value)
    userChange = "change"


});

document.getElementById("companyAddress").addEventListener('keyup',e=>{

    e.target.removeAttribute("data-address")
    e.target.setAttribute("data-address",e.target.value)

    userChange = "change"

});


document.getElementById("profileBtn").addEventListener('click',()=>{


    if (userChange == "change") {
        
    

    const allElements = [...document.querySelectorAll(".data_Pass")]
    
    console.log(allElements)

    const userID = allElements[0].dataset['userid']
    const userName = allElements[0].dataset['username']
    const userEmail = allElements[1].dataset['email']
    const userContact = allElements[2].dataset['cntnum']

    try {

        const typePass= allElements[3]
        var companyType =  typePass.options[typePass.selectedIndex].dataset['typeid']
  
    } catch (err) {

        var companyType =  allElements[3].dataset['typeid']

    }

    const companyName = allElements[4].dataset['companyname']
    const companyAddress = allElements[5].dataset['address']

    try {

        const dList = allElements[6]
        var distric = dList.options[dList.selectedIndex].dataset['districid']
        
    } catch (error) {

        var distric = allElements[6].dataset['districid']
        
    }

    try {

        const cList = allElements[7]
        var city = cList.options[cList.selectedIndex].dataset['cityid']
        
    } catch (error) {
        
        var city = allElements[7].dataset['cityid']
    }

    if( userID != "" && userName != "" && userEmail != "" && userContact != "" && companyType != "" && companyName != "" && companyAddress != "" && distric != "" && city != "")
    {
        
        if(allElements[8].files.length > 0 ){

            document.getElementById("msg").innerText = ''

        uploadFile(allElements[8],(ststus)=>{
            
            
            if (ststus == 'uploaded') {

                $.ajax({
                    type:'POST',
                    url:'datacall/profile.datacall.php',
                    data:{'userIDUpadte':userID,
                            'userName':userName,
                            'userEmail':userEmail,
                            'userContact':userContact,
                            'companyType':companyType,
                            'companyName':companyName,
                            'companyAddress':companyAddress,
                            'distric':distric,
                            'city':city

                        },
                    success:(status)=>{

                        console.log(status)

                        if(status == 'Updated'){

                            alert ("Details Updated")
                            location.replace('login.php');

                        }else {

                            document.getElementById("msg").innerText = "Not Update , Data Issue"
                        }


                    }
                })
                
            }else{

                document.getElementById("msg").innerText = "Not Update , Data Issue"
            }

        })
    }else{
        document.getElementById("msg").innerText = "You must Upload the Proof"
    }




        

        
    }else{

        document.getElementById("msg").innerText = "Not Update , Data Issue"


    }

}



});


function uploadFile(element,callback) {
    var fileInput = element;
    var file = fileInput.files[0];
    var formData = new FormData();
    formData.append("fileToUpload", file);

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "datapass/proofUpload.datapass.php", true);
    xhr.onload = function () {
        if (xhr.responseText == "uploaded") {
            callback(xhr.responseText);
        } else {
            callback(xhr.responseText);
        }
    };
    xhr.send(formData);
}

