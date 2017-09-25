<template>
     <div class="form-group ">
        <div class="input-group  "  v-show="!edit">
            <span class="h5 animated zoomIn" :class="colorLabel">{{ country.name }} </span> 
            <button class="btn btn-default btn-xs" type="button" @click="edit = true" > Edit</button>
           
        
        </div>
        <div class="bg-white" style="padding: .5rem;" v-show="edit">
            
                <v-select :value.sync="country" :on-change="selectCountry" :options="countries" label="name"></v-select>
                <!-- <select name="country" id="country" v-model="country" class="js-select2 form-control input-lg" style="width:100%" data-placeholder="Country">
                   
                    @foreach ($countries as $c)
                    <option  v-for="c in countries" :value="c.id" > {{ c.name }}</option>
                    @endforeach
                    
                </select> -->
                <button class="btn btn-success btn-sm" type="button" @click="update()" :disabled="loader"><span class="fa fa-cog fa-spin" v-if="loader"></span> <span v-else>Update</span></button>
                
                <button class="btn btn-danger btn-sm" type="button" @click="edit = false" v-if="!loader"> Cancel</button>
            
        </div>
    </div>
    
</template>

<script>
    import vSelect from "vue-select"

    export default {
        //props:['partnerId','privateCode'],
         props: {
		    userId: {
		      type: Number
		      
            },
             colorLabel: {
              type: String,
              default: ''
		      
            },
            currentCountry: {
              type: Object,
              default: {}
		      
            },
            countries:{
                type: Array,
                
            }
        },
        components: {vSelect},
        data () {
            return {

                country : "",
                loader:false,
                errors:[],
                edit: false

            }
          
        },

        methods:{
            selectCountry(country){
                
                if(country)
                    this.country = country

            },
            update() {
                this.loader = true;
                axios.put(`/superadmin/users/${this.userId}/country`,{country_id: this.country.id})
                    .then(response => {
                        bus.$emit('alert', 'Country Updated','success');
                        this.loader = false;
                        this.errors = [];
                        this.edit = false;
                        //this.currentCountry = this.country
                    })
                    .catch(e => {
                        console.log(e)
                        this.errors = e.response.data.errors;
                        this.loader = false;
                       
                    })
                                
                 

		    }
        },
        created() {
            if(this.currentCountry)
                this.country = this.currentCountry;

            console.log('Component Updatecountry.'+ this.userId)
        }
    }
</script>
