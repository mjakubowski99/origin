import { checkHour } from "./arrives_validation_modules.js";
import { xmlRequestSend } from "./arrives_xml_modules.js";

//function which run hour checker
function validateForm(){ 
    const inputsHours = document.getElementsByClassName('hour');
    console.log(inputsHours);
    let datesValid = true;
    for(let i=0; i<inputsHours.length; i++){
        datesValid = datesValid && checkHour( inputsHours[i].value , inputsHours[i] );
    }
    return datesValid;
}

$(document).ready( function() {
    const stationGetterButton = document.getElementById('stations-request-sender');

    //event which allow you to get stations
    stationGetterButton.addEventListener('click', () => {
        const trace_name = document.getElementById('trace-search').value;
        let url = 'http://localhost:8000/getStations/';
        url = url.concat(trace_name);

        const xhr = new XMLHttpRequest();
        xhr.responseType = "json"

        xmlRequestSend(url);
        document.getElementById('form-sender').hidden = false;
    });
});


