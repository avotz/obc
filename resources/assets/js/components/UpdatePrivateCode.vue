<template>
    <div class="input-group col-sm-4 col-md-4 col-lg-3">
        <input class="form-control input-sm" type="text" id="private_code" v-model="private_code">
        <span class="input-group-btn">
            <button class="btn btn-default btn-sm" type="button" @click="update()" :disabled="loader"><span class="fa fa-cog fa-spin" v-if="loader"></span> <span v-else>Update</span></button>
        </span>
       
    </div>
</template>

<script>
    

    export default {
        //props:['partnerId','privateCode'],
         props: {
		    partnerId: {
		      type: Number
		      
            },
            privateCode: {
              type: String,
              default: null
		      
            },
        },
        data () {
            return {

                private_code : "",
                loader:false,
                errors:[]

            }
          
        },

        methods:{
           
            update() {
                this.loader = true;
                axios.put(`/partner/${this.partnerId}/privatecode`,{private_code: this.private_code})
                    .then(response => {
                        bus.$emit('alert', 'Private Code Updated','success');
                        this.loader = false;
                        this.errors = [];
                    })
                    .catch(e => {
                        console.log(e)
                        this.errors = e.response.data.errors;
                        this.loader = false;
                       
                    })
                                
                 

		    }
        },
        created() {
            if(this.privateCode)
                this.private_code = this.privateCode;

            console.log('Component UpdatePrivateCode.'+ this.partnerId)
        }
    }
</script>
