<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
        <a class="navbar-brand text-light" v-bind:href="this.mainHref">Train Service </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
            <a class="nav-link text-light" v-bind:href="this.homeHref">Home <span class="sr-only">(current)</span></a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        </div>
    </nav>
</template>

<script>
    export default {
        props: ['homeHref', 'mainHref'],
        created(){
            console.log(this.homeHref)
            console.log(this.mainHref)
        }
    }
</script>