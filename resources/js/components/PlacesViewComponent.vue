<template>
    <div>
        <places-in-train-view :splitedPlacesArray="this.$props.splitedPlacesArray" @setClicked="setClickedValues($event)"> </places-in-train-view>
        
       <form method="POST" @submit="checkIfSameCountOfPlacesWasChoosen" :action="this.$props.payForTicketRoute" class="mb-2 flex-row text-center mb-5">
            <input type="hidden" name="_token" v-bind:value="this.$props.csrf">
            <input type="hidden" name="clicked" v-bind:value="JSON.stringify(this.clicked)">
            <input type="hidden" name="arrive_ids" v-bind:value="this.$props.arriveIds">
            <button type="submit" class="btn btn-sm btn-success"> Zatwierdz wybor </button>
        </form> 
    </div>
</template>

<script>
    import PlacesInTrainView from './PlacesInTrainView.vue';

    export default {
        props: ['splitedPlacesArray', 'placesArray', 'payForTicketRoute', 'csrf', 'arriveIds'],
        data(){
            return{
                clicked: [],
                clicked_train_id: []
            }
        },
        components: {
            'placesInTrainView': PlacesInTrainView,
        },
        methods: {
            setClickedValues(data){
                this.clicked = data.clicked;
                this.clicked_train_id = data.clicked_train_id;
            },
            checkIfSameCountOfPlacesWasChoosen(e){
                let count = new Map();
                this.clicked_train_id.forEach( (el) => {
                    if( count.has(el) )
                        count.get(el).count++;
                    else
                        count.set(el, {count: 1});
                });

                if( this.$props.splitedPlacesArray.length != count.size ){
                    alert('Wybierz ta sama ilość miejsc!');
                    e.preventDefault();
                }
                
                let check_if_all_the_same = true;
                let first = -1;
                count.forEach( (value, key) => {
                    if( first == -1 )
                        first = value.count;
                    else if( first != value.count )
                        check_if_all_the_same = false;
                });
                
                if( !check_if_all_the_same ){
                    alert('Wybierz ta sama ilość miejsc!');
                    e.preventDefault();
                }
                else 
                    return true;
            },
        }
    }
</script>

<style scoped>
    @media screen and (min-width: 1000px){
        .place{
            width: 50%;
        }
    } 
    @media screen and (max-width: 1000px){
        .place{
            width: 50%;
        }
    }
    .place{
        border: 1px solid black;
        background-color: green;
    }

    .place:hover{
        background-color: darkgreen;
    }
</style>
