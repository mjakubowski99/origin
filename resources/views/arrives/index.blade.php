@extends('arrives.layout')

@section('jumbotronContent')
    <h1 class="display-4">Obsluga</h1>
    <p class="lead"> Wpisujemy date przyjazdu i odjazdu w . Wyszukujemy interesujący nas pociąg, który ma jechać na interesującej nas trasie</p>
    <hr class="my-4">
    <p> Kazde pole musi być uzupełnione inaczej formularz nie przejdzie. Zostaniesz poinformowany o tym czy sukcesywnie
    udało ci się dodać przejazd do bazy danych.</p>
@endsection

@section('errorsChecker')
    @if ($errors->any())
        <div class="alert alert-danger text-center">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    @if (Session::has('success'))
        <div class="alert alert-success">
            <p>{{ Session::get('success') }}</p>
        </div>
    @endif

    @if (Session::has('error'))
        <div class="alert alert-danger">
            <p>{{ Session::get('error') }}</p>
        </div>
    @endif
@endsection

@section('beginArriveFormPart')
    <div class="col-md-3 col-xs-6" id="date-1">
        <label for="begin-at"> Data odjazdu </label><br>
        <input type="text" name="begin-at" id="datepicker1" class="form-control" required>
        <label for="begin-at-hour"> Godzina odjazdu </label>
        <input type="text" name="begin-at-hour" placeholder="gg:mm" class="form-control" required><br>
    </div>
@endsection

@section('arriveToPart')
    <div class="col-md-3 col-xs-6" id="date-2">
        <label for="arrive-at"> Data przyjazdu </label><br>
        <input type="text" name="arrive-at" id="datepicker2" class="form-control" required>
        <label for="arrive-at-hour"> Godzina przyjazdu </label>
        <input type="text" name="arrive-at-hour" placeholder="gg:mm" class="form-control" required><br>
    </div>
@endsection

@section('trainSearcher')
    <div class="col-md-3 col-xs-6 text-center">
        <label for="train-search"> Wyszukaj pociąg </label><br>
        <input type="text" id="train-search" name="train-search" class="form-control" required/>
        <ul class="list-group text-center text-dark" id="trains" > </ul>
    </div>
@endsection

@section('traceSearcher')
    <div class="col-md-3 col-xs-6 text-center">
        <label for="trace-search"> Wyszukaj trase </label><br>
        <input type="text" id="trace-search" name="trace-search" class="form-control" required/>
        <ul class="list-group text-center text-dark" id="traces"> </ul>
    </div>
@endsection


@section('searcherScript')
        <script type="text/javascript">
            $( document ).ready(function() {
                console.log( "ready!" );
                let trains =  <?php echo json_encode($trains) ?>;
                let traces =  <?php echo json_encode($traces) ?>;
                let inputTrain = document.getElementById('train-search');
                let inputTrace = document.getElementById('trace-search');
                let trainsCollapse = document.getElementById('trains');
                let tracesCollapse = document.getElementById('traces');

                function setEventToSearcher1(input, collapse, jsonObj){
                    input.addEventListener( 'keyup', (e) => {
                            $(collapse).empty();
                            $(jsonObj).each( (index, element) => {
                                if( e.target.value != '' && element.name.startsWith( e.target.value ) ){
                                    let listElement = document.createElement('button');
                                    listElement.innerHTML = element.name;
                                    listElement.setAttribute('class', 'list-group-item text-center')
                                    listElement.setAttribute('type', 'button');
                                    listElement.addEventListener('click', ()=>{
                                        input.value = element.name
                                    } );
                                    collapse.appendChild(listElement);
                                }
                            });
                    });
                }

                function setEventToSearcher2(input, collapse, jsonObj){
                    input.addEventListener( 'keyup', (e) => {
                            $(collapse).empty();
                            $(jsonObj).each( (index, element) => {
                                if( e.target.value != '' && element.NAME.startsWith( e.target.value ) ){
                                    let listElement = document.createElement('button');
                                    listElement.innerHTML = element.NAME;
                                    listElement.setAttribute('class', 'list-group-item text-center')
                                    listElement.setAttribute('type', 'button');
                                    listElement.addEventListener('click', ()=>{
                                        input.value = element.NAME
                                    } );
                                    collapse.appendChild(listElement);
                                }
                            });
                    });
                }

                setEventToSearcher1(inputTrain, trainsCollapse, trains);
                setEventToSearcher2(inputTrace, tracesCollapse, traces);

                $( function() {
                        $( "#datepicker1" ).datepicker();
                        $( "#datepicker2" ).datepicker();
                } );
            });

    </script>
@endsection