<template>
    <div>
        <div class="form-group" :class="errors.associate_private_code ? 'has-error' : '' ">
            <div class="col-xs-12">
                <div class="form-material form-material-success">
                    <input class="form-control" type="text" v-model="associate_private_code" name="associate_private_code"  @keydown="keydown()">
                    
                    <label for="associate_private_code">Associate private code</label><span class="fa fa-cog fa-spin" v-show="loader"></span>
                    <form-error v-if="errors.associate_private_code" :errors="errors">
                        {{ errors.associate_private_code[0] }}
                    </form-error>
                </div>
            </div>
        </div>
        <div class="form-group" v-show="company.company_name">
            <div class="col-xs-12">
                <div class="form-material form-material-success">
                    {{ company.company_name }}
                    <label for="company_name">Company Name</label>
                </div>
            </div>
        </div>
        <div class="form-group" v-show="company.identification_number">
            <div class="col-xs-12">
                <div class="form-material form-material-success">
                    {{ company.identification_number }}
                    <label for="identification_number">Company identification number</label>
                </div>
            </div>
        </div>
        <div class="form-group" v-show="company.activity">
            <div class="col-xs-12">
                <div class="form-material form-material-success">
                    {{ company.activity }}
                    <label for="activity">Activity on the OBC platform</label>
                </div>
            </div>
        </div>
        <div class="form-group" v-show="company.phones">
            <div class="col-xs-12">
                <div class="form-material form-material-success">
                    {{ company.phones }}
                    <label for="phones">Phones</label>
                </div>
            </div>
        </div>
        <div class="form-group" v-show="company.physical_address">
            <div class="col-xs-12">
                <div class="form-material form-material-success">
                    {{ company.physical_address }}
                    <label for="physical_address">Physical address</label>
                </div>
            </div>
        </div>
        <div class="form-group" v-show="company.country">
            <div class="col-xs-12">
                <div class="form-material form-material-success">
                    
                        <div v-for="item in company.countries">
                            {{ item.name }}
                        </div>
                    
                    <label for="country">Country</label>
                </div>
            </div>
        </div>
        <div class="form-group" v-show="company.towns">
            <div class="col-xs-12">
                <div class="form-material form-material-success">
                    {{ company.towns }}
                    <label for="towns">Towns</label>
                </div>
            </div>
        </div>
        <div class="form-group" v-show="company.web_address">
            <div class="col-xs-12">
                <div class="form-material form-material-success">
                    {{ company.web_address }}
                    <label for="web_address">Web address</label>
                </div>
            </div>
        </div>
       
        
    </div>
</template>

<script>
    import FormError from './FormError.vue';

    export default {
        data () {
            return {

                associate_private_code : "",
                partner:{},
                company:{},
                loader:false,
                errors:[]

            }
          
        },
         components:{
	        FormError
	       
	    },
        methods:{
            keydown: _.debounce(
                function ()  {
                     if(this.associate_private_code)
                        this.searchPartner(this.associate_private_code)
                    },
                500),
            searchPartner(private_code) {
                this.loader = true;
                axios.get(`/companies/${private_code}/check/`,{
                        params: {
                            associate_private_code: private_code
                        }
                    })
                    .then(response => {
                        
                        this.company = response.data
                        this.loader = false;
                        this.errors = [];
                    })
                    .catch(e => {
                        console.log(e)
                        this.errors = e.response.data.errors;
                        this.loader = false;
                        this.company = {};
                    })
                                
                 

		    }
        },
        mounted() {
            console.log('Component CheckPartnerPrivateCode.')
        }
    }
</script>
