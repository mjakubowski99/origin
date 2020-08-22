//html template to create stations fields
const dateHtml = `<td>
                    <input type="text" class="form-control date" required>
                  </td>
                  <td>
                    <input type="text" placeholder="gg:mm" class="form-control hour" required>
                  </td>
                  <td>
                    <input type="text" class="form-control date" required>
                  </td>
                  <td>
                    <input type="text" placeholder="gg:mm" class="form-control hour" required>
                  </td>`;

const tableHeader = `<thead class="thead-dark">
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Data odjazdu</th>
                            <th scope="col">Godzina odjazdu</th>
                            <th scope="col">Data przyjazdu </th>
                            <th scope="col">Godzina przyjazdu </th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>`


function createRowTable(stationName){
    let row = document.createElement('tr');
    row.appendChild(stationName);
    row.innerHTML+=dateHtml;

    return row;
}

function createStation(el){
    let stationName = document.createElement('th');
    stationName.setAttribute('scope', 'row');
    stationName.innerHTML = el.NAME;

    return stationName;
}

//params inputDate - input where you pass date, inputHour - input where you pass hour, number - id for input and date
function inputSetNameIdAndDatePicker(inputDate, inputHour, number){
    inputDate.setAttribute('id', ['datepicker-',number].join('') );
    inputDate.setAttribute('name', ['date-',number].join('') );
    inputHour.setAttribute('name', ['hour-', number].join('') );
    $( inputDate ).datepicker({
        dateFormat: "yy-mm-dd"
    });
}



function loadXmlResponseToWebsite(jsonResponse){
    const stationsDiv = document.getElementById('stations');
    $(stationsDiv).empty();

    let number = 0;
    const tableStations = document.createElement('table');
    tableStations.setAttribute('class', 'table table-bordered table-info table-hover');
    tableStations.innerHTML = tableHeader;
    const tbody = tableStations.querySelector('tbody');

    $.each(jsonResponse, (index, el) => {
        let stationName = createStation(el);
        let row = createRowTable(stationName);
        const inputsDates = row.getElementsByClassName('date');
        const inputsHours = row.getElementsByClassName('hour');

        for(let i = 0; i<inputsDates.length; i++ ){
            inputSetNameIdAndDatePicker(inputsDates[i], inputsHours[i], number);
            number++;
        }
        
        tbody.appendChild(row);
    });
    stationsDiv.appendChild(tableStations);
}


//params: url - url from resource will be downloaded
function xmlRequestSend(url){
    const xhr = new XMLHttpRequest();
    xhr.responseType = "json"

    xhr.addEventListener("load", function() {
        if (xhr.status === 200) {
            loadXmlResponseToWebsite(xhr.response);
        }
        else{
            alert('Nie ma takiej trasy! Wpisz poprawną trasę')
        }
    });

    xhr.open("GET", url, true);
    xhr.send();
}

export { xmlRequestSend };


