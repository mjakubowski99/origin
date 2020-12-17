<template>
    <div>
        Pamiętaj aby wybrać tą samą liczbę miejsc!
        <div v-for="(placesArray, id) in this.$props.splitedPlacesArray" :key="id"> 
            Pociąg {{ id+1 }}
            <div v-for="(trainPlaces,index) in placesArray" :key="index" class="text-center mt-3 mr-3">
                Wagon numer: {{ index+1 }} 
                <div class="row">
                    <div v-for="(placeInCar,placeID) in trainPlaces" :key="placeID" v-on:click="markAsClicked(placeInCar.id, placeInCar.TRAIN_ID)">
                        <div class="place m-2 col-sm-3" :class="'place-'+placeInCar.id">
                                {{ placeInCar.number }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['splitedPlacesArray'],
        data(){
            return{
                clicked: [],
                clicked_train_id: [],
            }
        },
        methods: {
            markAsClicked(index, trainID){
                let clickedIndex = this.clicked.indexOf(index);
                if( clickedIndex != -1 ){
                    document.getElementsByClassName('place-'+index)[0].style.backgroundColor = 'green';
                    this.clicked.splice(clickedIndex, 1);
                    this.clicked_train_id.splice(clickedIndex, 1);
                }
                else{
                    document.getElementsByClassName('place-'+index)[0].style.backgroundColor = 'blue';
                    this.clicked.push(index);
                    this.clicked_train_id.push(trainID);
                }

                this.$emit('setClicked', { clicked: this.clicked, clicked_train_id: this.clicked_train_id } );
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