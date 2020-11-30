<template>
    <div>
        <div class="d-flex justify-content-center">
            <places :csrf="this.$props.csrf" 
                    :splitedPlacesArray="this.splitedPlacesArray" 
                    :placesArray="this.$props.places" 
                    :pay-for-ticket-route="this.$props.payForTicketRoute"
            />
        </div>
    </div>
</template>

<script>
    import places from './PlacesViewComponent.vue'
    export default {
        props: ['places', 'payForTicketRoute', 'csrf'],
        data() {
           return{
                splitedPlacesArray: this.splitPlaceFromDifferentCar( 
                    this.splitPlacesFromDifferentAttribute( this.convertToArray(this.$props.places), 'train_id') 
                ),
           }
        },
        components: {
            'places': places
        },
        methods: {
            convertToArray(places){
                console.log( this.$props.payForTicketRoute );
                return JSON.parse(places);
            }, 
            comparePlaceAttributes(place1, place2, attribute){
                if( attribute == 'car' )
                    return place1.car == place2.car;
                else if( attribute == 'train_id' )
                    return place1.TRAIN_ID == place2.TRAIN_ID;
            },
            splitPlacesFromDifferentAttribute(places, attribute){
                let splited_arrays = [];
                for(let i=0; i<places.length-1; i++){
                    let same_train_places = [ places[i] ];
                    let j=i;
                    while( j+1<places.length && this.comparePlaceAttributes(places[j], places[j+1], attribute) ){
                        same_train_places.push( places[j+1] );
                        j++;
                    }
                    splited_arrays.push(same_train_places);
                    i+=j;
                }

                return splited_arrays;
            },
            splitPlaceFromDifferentCar(splitedPlacesArray){
                let splited = [];
                splitedPlacesArray.forEach( (element) => {
                    splited.push( this.splitPlacesFromDifferentAttribute(element, 'car') );
                });
                
                return splited;
            },
        },
    }
</script>
