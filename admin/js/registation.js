function profNeed(userType) {

    const picBox = `<label for="" class="form-label">Upload Your Proof</label><br>
<span class="small">Upload your proofing documents about your company / organization</span>
<div class="custom-file" id="image_file">
<input type="file" class="custom-file-input" id="profFile" name="profFile"
   aria-describedby="inputGroupFileAddon01" required>
<label class="custom-file-label" for="profFile">Choose file</label>
</div>`;

    const prof = userType.options[userType.selectedIndex].dataset.prof
    const profLoad = document.getElementById('profLoad')

    if (prof != 1) {
        profLoad.innerHTML = '';

    } else {

        profLoad.innerHTML = picBox;
    }



}

function passCheck() {

    $ePass = document.getElementById('usrEPass')
    $rPass = document.getElementById('usrRPass')

    if ($ePass.value != $rPass.value) {

        document.getElementById('msg').innerHTML = 'Not Match'
        document.getElementById('msg').style.color = "red";
        document.getElementById('submitBtn').disabled = true;

    } else {

        document.getElementById('msg').innerHTML = 'Match'
        document.getElementById('msg').style.color = "Green";
        document.getElementById('submitBtn').disabled = false;

    }

}

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
                document.getElementById('emailInfo').innerText= ' You alredy have an Account'
                document.getElementById('emailInfo').style.color = "red";
                document.getElementById('usrEPass').disabled = true;
            }else{
                document.getElementById('emailInfo').innerText=''
                document.getElementById('usrEPass').disabled = false;

            }



        }
    })


    
}

