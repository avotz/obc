<template>
    <div v-show="name">
        <a :href="urlFile" target="_blank"><img :src="showImage" alt="photo" style="height:60px" /></a>     
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
                name:'',
                preview:''

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
                                
                 

            },
          readFile(){
              let request = new XMLHttpRequest();
                request.open('GET', this.urlFile, true);
                request.responseType = 'blob';
                request.onload = () => {
                    var reader = new FileReader();
                    reader.readAsDataURL(request.response);
                    reader.onload =  (event) => {
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
            
            this.name =  this.filename

            var extension = this.filename.split('.').pop().toLowerCase();
            
            if(extension == 'pdf')
                this.preview = '/img/pdf.jpg';
            else if(extension == 'xlsx' || extension == 'xls')
                this.preview = '/img/excel.jpg';
            else if(extension == 'docx' || extension == 'doc')
                this.preview = '/img/word.jpg';
            else
                this.readFile();
           
            console.log('Component deleteFilePurchase.')
        }
    }
</script>
