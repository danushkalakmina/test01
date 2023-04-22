const contactListArea = document.getElementById("contactList");
var numList = 1;

(()=>{
    const allSelect = document.querySelectorAll(".datadetails")
    allSelect.forEach(allSelect => {allSelect.options[0].disabled  = true})
})();

(()=>{
    contactListArea.innerHTML='<select name="contactLists" id="contactLists" size="0" class="form-control" hidden="hidden"></select>'
    districtCall()

})();

function districtCall() {

    const dListBox = document.getElementById("dslistBox")
    $.ajax({
        url:"datacall/regiSupport.datacall.php",
        type:'POST',
        dataType:'JSON',
        data:{loadFrmReg:"loadRegForm"},
        success:(status)=>{

            if (status[0]['disId']!='noData'){
                dListBox.innerHTML='';
                dListBox.innerHTML='<option value="">Select One</option>';
                dListBox.options[0].disabled  = true

                for (let i = 1; i <= status.length; i++) {

                    const option = document.createElement('option');
                    option.value= status[i-1]['disId'];
                    option.innerText=status[i-1]['disNam'];
                    dListBox.appendChild(option);




                    
                }


            }else if (status[0]['disId'] =='noData') {

                dListBox.innerHTML='';
                dListBox.innerHTML='<option value="">Contact Admin</option>';
                dListBox.options[0].disabled  = true
  
            }


        }
    })

    
    

    
};

document.getElementById("dslistBox").addEventListener('change', e =>{

    const disId = e.target.value
    const cListBox = document.getElementById("cylistBox")

    $.ajax({
        url:"datacall/regiSupport.datacall.php",
        type:'POST',
        dataType:'JSON',
        data:{cityList:disId},
        success:(status)=>{
            

            if (status[0]['cisId']!='noData'){
                cListBox.innerHTML='';
                cListBox.innerHTML='<option value="">Select One</option>';
                cListBox.options[0].disabled  = true

                for (let i = 1; i <= status.length; i++) {

                    const option = document.createElement('option');
                    option.value= status[i-1]['cisId'];
                    option.innerText=status[i-1]['cisNam'];
                    cListBox.appendChild(option);




                    
                }


            }else if (status[0]['disId'] =='noData') {

                cListBox.innerHTML='';
                cListBox.innerHTML='<option value="">Contact Admin</option>';
                cListBox.options[0].disabled  = true
  
            }


        }
    })



});

document.getElementById("contactAddBtn").addEventListener('click',()=>{

    const contName = document.getElementById("contactName")
    const contNumb = document.getElementById("contactNumbr")
    const contactList = document.getElementById("contactLists")

    if ((contName.value === '') || (contNumb.value === '') ) return


    if (contNumb.value.length == 10){
    contactList.removeAttribute('hidden')
    numList++
    contactList.setAttribute('size',numList)
    const option = document.createElement("option")
    option.innerText = contName.value + ' - ' + contNumb.value
    option.setAttribute('data-contName',contName.value )
    option.setAttribute('data-contNumb',contNumb.value)
    option.value = contName.value + ' - ' + contNumb.value
    contactList.appendChild(option)
    contName.value = ""
    contNumb.value = ""
    }

});

document.getElementById("contactLists").addEventListener("dblclick",e=>{

    if (!confirm("confrim to delete option ")) return
    const selectRow = e.target;
    selectRow.remove(selectRow.selectedIndex);
    --numList
    if(parseInt(numList) <= 1 ){
        document.getElementById("contactLists").setAttribute('hidden','hidden')
    }


});



