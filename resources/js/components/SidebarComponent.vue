

<template>
    <div id="sidebar">
        <button id="close-button" class="btn btn-dark"> Close </button>
        <img v-bind:src="this.photoLink" id="profileImg" />
        <div class="sidebar-links">
                <h1>  {{ this.userName }} </h1>
                <div style="color: gray"> {{ this.userEmail }} </div>
                <div class="h5 list-group mt-5 pt-5 pb-5" id="sidebar-list">
                    <div id="sidebar-icons">
                        <div class="mb-3"> <mail-component/> </div> 
                        <div class="mb-3"> <contact-component/> </div> 
                        <div class="mb-3"> <dot-component/> </div> 
                        <div class="mb-3"> <dot-component/> </div>
                        <div class="mb-3"> <dot-component/> </div> 
                    </div>

                    <div id="sidebar-text">
                        <div class="sidebar-text-item mb-3"> Mailbox </div>
                        <div class="sidebar-text-item mb-3">  Contact </div>
                        <div class="sidebar-text-item mb-3">  Lorem   </div>
                        <div class="sidebar-text-item mb-3">  Ipsum  </div>
                        <div class="sidebar-text-item mb-3">  Text  </div>
                    </div>

                </div>

                <div class="mt-5">
                    TrainService@2020
                </div> 
        </div>
    </div>
</template>

<script>
    import mailComponent from './SidebarIconComponents/MailPhotoComponent.vue'
    import contactComponent from './SidebarIconComponents/ContactPhotoComponent.vue'
    import dotComponent from './SidebarIconComponents/DotComponent.vue'

    export default {
        props: ['userName', 'userEmail', 'photoLink'],
        mounted() {
            console.log(mailComponent)
        },
        components:{
            mailComponent,
            contactComponent,
            dotComponent,
        }
    }
</script>