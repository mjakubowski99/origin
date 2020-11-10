/*    <ul>
            <li v-for="p in place" :key="p.PLACE_ID"> 
                {{ p.PLACE_ID }}
            </li>
        </ul> */


<template>
    <div>
    </div>
</template>

<script>
    export default {
        props: ['places'],
        data() {
           return{
                place: this.splitPlacesFromDifferentTrain( this.convertToArray(this.$props.places)  )
           }
        },
        mounted(){
            console.log(this.place);
        },
        methods: {
            convertToArray(places){
                return JSON.parse(places);
            }, 
            splitPlacesFromDifferentTrain(places){
                let splited_arrays = [];
                for(let i=0; i<places.length-1; i++){
                    let same_train_places = [ places[i] ];
                    let j=i;
                    while( places[i].TRAIN_ID == places[i+1].TRAIN_ID ){
                        same_train_places.push( places[i+1] );
                        j++;
                    }
                    splited_arrays.push(same_train_places);
                    i+=j;
                }

                return splited_arrays;
            }
        }
    }
</script>