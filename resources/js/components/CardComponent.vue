<template>
    <div class="card col-md-3 col-xs-6 mb-2 mr-3" style="width: 18rem;">
            <img class="card-img-top" v-bind:src="this.photoLink" alt="Card image cap">
            <div class="card-body">
                <p class="card-text"> {{ this.cardText }} <br/> 
                    <a class="btn text-light mr-2"
                            v-bind:href="this.hrefLink" style="background-color: #ff33cc">
                          {{ this.buttonText }} 
                    </a> 
                </p>
            </div>
    </div>
</template>

<script>
    export default {
        props: ['photoLink', 'buttonText', 'cardText', 'hrefLink']
    }
</script>