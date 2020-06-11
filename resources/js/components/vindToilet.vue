<template>
    <form method="POST" enctype="multipart/form-data" @submit.prevent="submit">
        <!--<input type="hidden" id="lattitude" name="lattitude">
        <input type="hidden" id="longitude" name="longitude">-->
        <button type="submit" class="btn btn-primary btn-lg"><i class="fal fa-toilet"></i> Zoek toiletten!</button>
    </form>
</template>

<script>
    export default {
        name: "vindToilet",
        data: function(){
            return{
                latitude: null,
                longitude: null,

            }
        },
        created(){
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(this.showPosition);
                console.log('gelukt');
            } else {
                //iets
            }

        },
        methods:{
            showPosition(position){
                this.latitude = position.coords.latitude;
                this.longitude = position.coords.longitude;

            },

            submit(){
                debugger
                axios.post('/toiletten',this.data).then(response=>console.log(response));

            }
        }
    }
</script>

<style scoped>

</style>
