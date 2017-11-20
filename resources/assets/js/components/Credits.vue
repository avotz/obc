 <template>
 <div>
 <!-- Search Section -->
    <div class="content">
        
            <div class="input-group input-group-lg">
                <input class="form-control" name="q" type="text" placeholder="Search user by Transaction ID.." v-model="search" @keyup="onSearch">
                <div class="input-group-btn">
                    <button class="btn btn-default"><i class="fa fa-search"></i></button>
                </div>
            </div>
      
    </div>
    <!-- END Search Section -->

    <!-- Page Content -->
    <div class="content">
        <div class="block">
            <ul class="nav nav-tabs" data-toggle="tabs">
               
                <li class="active" @click="currentView('credit-requests')">
                    <a href="#search-credit-requests">Credit Requests</a>
                </li>
                <li >
                    <a href="#search-credits" @click="currentView('credits')">Credits</a>
                </li>
               
               
            </ul>
            <div class="block-content tab-content bg-white">
                
                <!-- Users -->
                <div class="tab-pane fade fade-up in active" id="search-credit-requests">
                    <div class="border-b push-30">
                        <h2 class="push-10">{{ creditRequests.total }} <span class="h5 font-w400 text-muted">Credit Requests Found</span></h2>
                    </div>
                    <table class="table table-striped table-vcenter">
                        <thead>
                            <tr>
                                <th class="text-center" >ID</th>
                                <th class="text-center" ><i class="si si-user"></i></th>
                                <th class="text-center">Credit Time</th>
                                <th class="hidden-xs" >Request Date</th>
                                <th class="hidden-xs" >Make a credit</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <tr v-for="requests in creditRequests.data">
                                <td class="text-center font-w600">{{ requests.transaction_id }}</td>
                                <td class="text-center">
                                    
                                    {{ requests.quotation.user.company.public_code }}
                                </td>
                                <td class="font-w600">{{ requests.credit_time  }} Days</td>
                                <td class="hidden-xs">{{ parseDate(requests.date) }}</td>
                                <td class="text-center">
                                     <a :href="urlCreditRequests +'/'+ requests.id +'/credits/create'" class="btn btn-xs btn-success" data-toggle="tooltip" title="Make Offer">Make a credit</a>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                       <a :href="urlCreditRequests +'/'+ requests.id +'/edit'" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit credit"><i class="fa fa-pencil"></i></a>
                                      
                                        <button v-show="!requests.credits.length" class="btn btn-xs btn-danger" type="submit" data-toggle="tooltip" title="Remove credit request" form="form-delete" :formaction="'/credit-requests/'+ requests.id" ><i class="fa fa-times"></i></button>
                                        
                                    </div>
                                </td>
                            </tr>
                          
                            
                        </tbody>
                    </table>
                    <laravel-pagination :data="creditRequests" v-on:pagination-change-page="getCreditRequests"></laravel-pagination >
                   
                   
                </div>
                <!-- END Users -->
                <div class="tab-pane fade fade-up in " id="search-credits">
                    <div class="border-b push-30">
                        <h2 class="push-10">{{ credits.total }} <span class="h5 font-w400 text-muted">Credits Found</span></h2>
                    </div>
                    <table class="table table-striped table-vcenter">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Request</th>
                                <th class="text-center"><i class="si si-user"></i></th>
                                <th class="text-center">Credit Time</th>
                                <th class="hidden-xs" >Request Date</th>
                                <th class="hidden-xs hidden-sm">Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                            <tr v-for="credit in credits.data">
                                <td class="text-center font-w600">{{ credit.transaction_id }}</td>
                                 <td class="text-center font-w600">{{ credit.credit_request.transaction_id }}</td>
                                <td class="text-center">
                                    {{ credit.quotation.user.company.public_code }}
                                       
                                </td>
                                <td class="font-w600">{{ credit.credit_time }} days</td>
                                <td class="hidden-xs">{{ parseDate(credit.date) }}</td>
                                <td class="hidden-xs hidden-sm">
                                    <span class="label label-warning" v-show="credit.status == 0">Pending</span>
                                    <span class="label label-success" v-show="credit.status == 1">Granted</span>
                                    <span class="label label-danger" v-show="credit.status == 2">Reject</span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a :href="urlCredits +'/'+ credit.id +'/edit'" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit credit"><i class="fa fa-pencil"></i></a>
                                      
                                        <button v-show="credit.status == 0" class="btn btn-xs btn-danger" type="submit" data-toggle="tooltip" title="Remove credit" form="form-delete" :formaction="urlCredits+'/'+ credit.id" ><i class="fa fa-times"></i></button>
                                        
                                    </div>
                                </td>
                            </tr>
                           
                            
                        </tbody>
                    </table>
                    <laravel-pagination :data="credits" v-on:pagination-change-page="getCredits"></laravel-pagination >
                   
                </div>
                <!-- END Users -->

               
            </div>
        </div>
    </div>
    <!-- END Page Content -->
</div>
</template>

<script>
 import LaravelPagination from 'laravel-vue-pagination'
    export default {
         components: {
		    LaravelPagination: LaravelPagination,
		  
		  },
         props: {
		    urlCredits:{
                type:String,
                default:'/credits'
            },
            urlCreditRequests:{
                type:String,
                default:'/credit-requests'
            }
          
        },
        
        data () {
            return {

                
                loader:false,
                errors:[],
                credits:{},
                creditRequests:{},
                search:'',
                activeView:'credit-requests'

                

            }
          
        },

        methods:{
            parseDate(date){
                return moment(date).format('YYYY-MM-DD')
            },
            currentView(page) {
                
                this.activeView = page
            },
            onSearch:_.debounce(function(search) {
	           
                if(this.activeView == 'credit-requests')
                    this.getCreditRequests();
                else
                   this.getCredits();
					

		    }, 500),
            getCredits(page) {
				if (typeof page === 'undefined') {
					page = 1;
				}
				

				// Using vue-resource as an example
				axios.get(`${this.urlCredits}/list?q=${this.search}&page=${page}`).then((response) => {
                     
                      this.credits = response.data;
                    
                      
                    }, (response) => {
                        console.log(response.data)
                               
                    });

				
            },
            getCreditRequests(page) {
				if (typeof page === 'undefined') {
					page = 1;
				}
				

				// Using vue-resource as an example
				axios.get(`${this.urlCreditRequests}/list?q=${this.search}&page=${page}`).then((response) => {
                     
                      this.creditRequests = response.data;
                    
                      
                    }, (response) => {
                        console.log(response.data)
                               
                    });

				
			},
        },
        created() {
           
            this.getCredits()
            this.getCreditRequests()

            console.log('Component credits.')
        }
    }
</script>