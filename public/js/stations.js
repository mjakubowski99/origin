
let $stations = document.getElementById('stations')
let $stationsButton = document.getElementById('add-station')
let $stationCounter = 0
let $set = false;
let $hidden = false;

function createInputStation(){
    let $newInput = document.createElement('input')
    $newInput.setAttribute('name', 'station-' + $stationCounter)
    $newInput.setAttribute('type', 'text')
    $newInput.setAttribute('class', 'mr-3 mt-3 form-control w-50 d-inline-block')
    return $newInput;
}

$stationsButton.addEventListener('click', () => {
    let $newInput = createInputStation();
    $stationCounter++;
    if ($stationCounter > 1 && !$set){
        document.getElementById('submiter').removeAttribute('hidden');
        $set = true;
    }

    $div = document.createElement('div');
    $div.innerHTML = $stationCounter + '.   ';
    $stations.appendChild($div);
    $div.appendChild($newInput);
});

$(".alert-success").delay(5000).fadeOut(500); 
$(".alert-danger").delay(5000).fadeOut(500);

