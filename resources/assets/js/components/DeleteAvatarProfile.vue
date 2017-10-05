<template>
    
                
    <button class="btn btn-danger btn-xs btn-block" type="button" @click="removeAvatar()" v-if="!loader"> Delete</button>
            
 
    
</template>

<script>
    import vSelect from "vue-select"

    export default {
        //props:['partnerId','privateCode'],
         props: {
		    url: {
		      type: String,
		       default: '/superadmin/profile/avatars'
            },
             userId: {
              type: Number,
              
		      
            },
           
        },
        data () {
            return {

             
                loader:false,
                errors:[],
              

            }
          
        },

        methods:{
           
            removeAvatar() {
                this.loader = true;
                axios.delete(`${this.url}/${this.userId}`)
                    .then(response => {
                        bus.$emit('alert', 'Photo Deleted','success');
                        this.loader = false;
                        this.errors = [];
                        
                        window.location.href = "/profile/";
                       
                    })
                    .catch(e => {
                        console.log(e)
                        this.errors = e.response.data.errors;
                        this.loader = false;
                       
                    })
                                
                 

		    }
        },
        created() {

            console.log('Component deleteAvatarProfile.')
        }
    }
</script>
