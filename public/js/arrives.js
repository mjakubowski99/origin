function createInfoDiv(){
    const infoDiv = document.createElement('div');
    infoDiv.setAttribute('class', 'alert alert-danger');
    infoDiv.innerHTML = 'Podales złą godzinę. Podaj godzine w formacie [0-24]:[0:60]';
    return infoDiv;
}

function checkHour(hours, date){
    let hoursRegex = /^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/gm;
    if( hoursRegex.exec(hours) == null){
        const el = document.getElementById(date);
        const infoDiv = createInfoDiv();
        if( el.children.length < 7 ){
            el.appendChild( infoDiv );
            setTimeout( () => {
                el.removeChild(infoDiv);
            }, 3000);
        }
        return false;
    }
    return true;
}

function validateForm(){
    const hoursBegin = document.forms['form-arrives']['begin-at-hour'].value;
    const hoursArrive = document.forms['form-arrives']['arrive-at-hour'].value;   
    return checkHour(hoursBegin, 'date-1') && checkHour(hoursArrive, 'date-2');
}