<template>
    <div v-show="name">
        <a :href="urlFile" target="_blank">{{ name }} </a>     
        <button class="btn btn-danger btn-xs " type="button" @click="removeFile()" v-if="!loader && !read"> <slot>Delete</slot></button>
            
 
    </div>
</template>

<script>
   

    export default {
        //props:['partnerId','privateCode'],
         props: {
            urlFile: {
		      type: String,
		      default: ''
            },
             filename: {
		      type: String,
		      default: ''
            },
		    url: {
		      type: String,
		       default: '/purchases/file'
            },
             transactionId: {
              type: Number,
              
		      
            },
             read: {
              type: Boolean,
              default:false
		      
            },
           
        },
        data () {
            return {

             
                loader:false,
                errors:[],
                name:''

            }
          
        },

        methods:{
           
            removeFile() {
                this.loader = true;
                axios.delete(`${this.url}/${this.transactionId}`)
                    .then(response => {
                        bus.$emit('alert', 'File Deleted','success');
                        this.loader = false;
                        this.errors = [];
                        this.name = ""
                        
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
            this.name =  this.filename
            console.log('Component deleteFilePurchase.')
        }
    }
</script>
