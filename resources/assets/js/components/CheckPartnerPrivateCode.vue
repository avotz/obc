<template>
    <div>
        <input class="form-control" type="text" v-model="associate_private_code" name="associate_private_code"  @keydown="keydown()">
    </div>
</template>

<script>
    export default {
        data () {
            return {

                associate_private_code : "",
                partner:{},
                loader:false


            }
          
        },
        methods:{
            keydown() {
                console.log(this.associate_private_code)

                if(this.associate_private_code)
                    this.searchPartner(this.associate_private_code)
            },
            searchPartner: _.debounce(function(search,loading) {
                
                axios.get(`/partners/${search}/check/`)
                    .then(response => {
                    
                        loading(false)
                    })
                    .catch(e => {
                        console.log(e)
                        loading(false)
                    })
                                
                 

		    }, 500),
        },
        mounted() {
            console.log('Component CheckPartnerPrivateCode.')
        }
    }
</script>
