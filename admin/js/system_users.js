function companyData(companyId) {

    $.ajax({
        type:'POST',
        url:'datacall/datacalljs.datacall.php',
        data:{'companyId':companyId},
        dataType:'JSON',
        success: (status)=>{

            console.log(status)

            const companyDeatils = document.getElementById("userDeatils")
            companyDeatils.innerHTML = `<div class="container">
            <div class="row">
                <div class="col-sm">
                <label for="" class="form-label"><b>Company Name</b></label>
                </div>
                
            </div>

            <div class="row">
                <div class="col-sm">
                <label for="" class="form-label">${status[0]['companyName']}</label>
                </div>
                
            </div>

            <div class="row">
                <div class="col-sm">
                <label for="" class="form-label"><b>Company Address</b></label>
                </div>
            </div>

            <div class="row">
                <div class="col-sm">
                <label for="" class="form-label">${status[0]['companyAddress']}</label>
                </div>
            </div>

            <div class="row">
                <div class="col-sm">
                <label for="" class="form-label"><b>Contact Person </b></label>
                </div>
                <div class="col-sm">
                <label for="" class="form-label"><b>Contact Number </b></label>
                </div>
            </div>

            <div class="row">
                <div class="col-sm">
                <label for="" class="form-label">${status[0]['companyPerson']}</label>
                </div>
                <div class="col-sm">
                <label for="" class="form-label">${status[0]['companyContact']}</label>
                </div>
            </div>





            <div class="row">
                <div class="col-sm">
                <label for="" class="form-label"><b>Company Proof</b></label>
                </div>
            </div>

            <div class="row">
                <div class="col-sm">
                <img src="../profile/${status[0]['companyBR']}" class="img-fluid" alt="">
                </div>
            </div>
            


        </div>`


        }
    })
    
}