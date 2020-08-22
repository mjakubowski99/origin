
/*Info about wrong hour*/
function createInfoDiv(){
    const infoDiv = document.createElement('div');
    infoDiv.setAttribute('class', 'alert alert-danger');
    infoDiv.innerHTML = 'Podales złą godzinę. Podaj godzine w formacie [0-24]:[0:60]';
    return infoDiv;
}

//function which check if hour match to regex
/* params hours - hour input value, hoursEl - input html element */

function checkHour(hours, hoursEl){
    let hoursRegex = /^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/gm;
    if( hoursRegex.exec(hours) == null){
        const el = hoursEl;
        const infoDiv = createInfoDiv();
        if( el.children.length < 7 ){
            el.parentElement.appendChild( infoDiv );
            setTimeout( () => {
                el.parentElement.removeChild(infoDiv);
            }, 3000);
        }
        return false;
    }
    return true;
}

export { checkHour };