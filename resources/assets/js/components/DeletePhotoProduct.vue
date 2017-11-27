<template>
    <div v-show="img">
        <img :src="showImage" alt="photo" style="height:60px" />            
        <button class="btn btn-danger btn-xs " type="button" @click="removePhoto()" v-if="!loader && !read" title="Eliminar"> <slot>Delete</slot></button>
            
 
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
		       default: '/requests/photo'
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
                img:'',
                preview:''

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
                                
                 

            },
            readFile(){
              let request = new XMLHttpRequest();
                request.open('GET', this.urlImg, true);
                request.responseType = 'blob';
                request.onload = () => {
                    let reader = new FileReader();
                    reader.readAsDataURL(request.response);
                    reader.onload = (event) => {
                        this.preview = event.target.result;
                        
                    };
                };
                request.send();
              
          }
        },
        computed: {
            showImage() {
               
                let image = this.preview || this.value;
              
                if (!image) {
                    return null;
                }
                let typeFile = image.split(',')[0];
              
                if(typeFile == 'data:application/pdf;base64')
                  image = '/img/pdf.jpg'
                if(typeFile == 'data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64' || typeFile == 'data:application/vnd.ms-excel;base64')
                  image = '/img/excel.jpg'
                if(typeFile == 'data:application/vnd.openxmlformats-officedocument.wordprocessingml.document;base64' || typeFile == 'data:application/msword;base64')
                  image = '/img/word.jpg'

                return `${image}`;
            }
        },
        created() {
            this.img =  this.urlImg
            
            this.readFile();

            console.log('Component deletePhotoProduct.')
        }
    }
</script>
