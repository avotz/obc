<template>
    <div v-show="img">
        <img :src="img" alt="photo" style="height:90px" />            
        <button class="btn btn-danger btn-xs " type="button" @click="removePhoto()" v-if="!loader"> <slot>Delete</slot></button>
            
 
    </div>
</template>

<script>
   

    export default {
        //props:['partnerId','privateCode'],
         props: {
            urlImg: {
		      type: String,
		      default: ''
            },
		    url: {
		      type: String,
		       default: '/user/requests/photo'
            },
             transactionId: {
              type: Number,
              
		      
            },
           
        },
        data () {
            return {

             
                loader:false,
                errors:[],
                img:''

            }
          
        },

        methods:{
           
            removePhoto() {
                this.loader = true;
                axios.delete(`${this.url}/${this.transactionId}`)
                    .then(response => {
                        bus.$emit('alert', 'Photo Deleted','success');
                        this.loader = false;
                        this.errors = [];
                        this.img = ""
                        
                       // window.location.href = "/profile/";
                       
                    })
                    .catch(e => {
                        console.log(e)
                        this.errors = e.response.data.errors;
                        this.loader = false;
                       
                    })
                                
                 

		    }
        },
        created() {
            this.img =  this.urlImg
            console.log('Component deletePhotoProduct.')
        }
    }
</script>
