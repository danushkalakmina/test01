function cityList(district) {
    const citys = document.getElementById("select-city")
    $.ajax({
        type: "POST",
        url: 'datacall/datacalljs.datacall.php',
        dataType: 'JSON',
        data: {functionname: 'cityList', district: district},
        success: (status) => {
            if (status[0]['cityId'] !== 'NoData') {
                citys.innerHTML = '';
                citys.innerHTML = '<option value="">Select One</option>';
                citys.options[0].disabled = true
                for (let i = 1; i <= status.length; i++) {
                    const option = document.createElement('option');
                    option.value = status[i - 1]['cityId'];
                    option.innerText = status[i - 1]['cityName'];
                    citys.appendChild(option);
                }
            } else if (status[0]['cityId'] === 'NoData') {
                citys.innerHTML = '';
                citys.innerHTML = '<option value="">Contact Admin</option>';
                citys.options[0].disabled = true
            }
        }
    });
}
function cityList(district,cityID) {
    const citys = document.getElementById("select-city")
    $.ajax({
        type: "POST",
        url: 'datacall/datacalljs.datacall.php',
        dataType: 'JSON',
        data: {functionname: 'cityList', district: district},
        success: (status) => {
            if (status[0]['cityId'] !== 'NoData') {
                citys.innerHTML = '';
                citys.innerHTML = '<option value="">Select One</option>';
                citys.options[0].disabled = true
                for (let i = 1; i <= status.length; i++) {
                    const option = document.createElement('option');
                    option.value = status[i - 1]['cityId'];
                    option.innerText = status[i - 1]['cityName'];
                    option.selected = (status[i - 1]['cityId'] === cityID+"");
                    citys.appendChild(option);
                }
            } else if (status[0]['cityId'] === 'NoData') {
                citys.innerHTML = '';
                citys.innerHTML = '<option value="">Contact Admin</option>';
                citys.options[0].disabled = true
            }
        }
    });
}
function copyToClipboard(element) {
    alert(element)
    // Get the text field
    var copyText = document.getElementById(element);

    // Select the text field
    copyText.select();
    copyText.setSelectionRange(0, 99999); // For mobile devices

    // Copy the text inside the text field
    navigator.clipboard.writeText(copyText.value);

    // Alert the copied text
    alert("Copied the text: " + copyText.value);
}