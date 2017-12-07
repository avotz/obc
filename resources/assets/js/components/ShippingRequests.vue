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
               
                <li class="active" @click="currentView('shipping-requests')">
                    <a href="#search-shippings-request">Shipping Requests</a>
                </li>
                <li >
                    <a href="#search-shippings" @click="currentView('shippings')">Shippings</a>
                </li>
               
               
            </ul>
            <div class="block-content tab-content bg-white">
                
                <!-- Users -->
                <div class="tab-pane fade fade-up in active" id="search-shippings-request">
                    <div class="border-b push-30">
                        <h2 class="push-10">{{ shippingsRequests.total }} <span class="h5 font-w400 text-muted">Shippings Request Found</span></h2>
                    </div>
                    <table class="table table-striped table-vcenter">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center"><i class="si si-user"></i></th>
                                <th class="text-center">Type</th>
                                <th class="text-center">Delivery Time</th>
                                <th class="hidden-xs">Request Date</th>
                                <th class="hidden-xs">Shippings</th>
                                <th class="text-center" >Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <tr v-for="requests in shippingsRequests.data" :key="requests.id">
                                <td class="text-center font-w600">{{ requests.transaction_id }}</td>
                                <td class="text-center">
                                    
                                    {{ requests.quotation.user.company.public_code }}
                                </td>
                                <td class="text-center font-w600">{{ (requests.type) ? 'International' : 'National' }}</td>
                                <td class="text-center font-w600">{{ (requests.delivery_time) ? 'Normal' : 'Express' }}</td>
                                <td class="hidden-xs">{{ requests.date }}</td>
                                <td class="text-center">
                                     <a :href="'/shipping-requests/'+ requests.id +'/shippings'" class="btn btn-xs btn-success" data-toggle="tooltip" title="">{{ requests.shippings.length }} Shipping</a>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                       <a v-show="!requests.shippings.length" :href="'/shipping-requests/'+ requests.id +'/edit'" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit Shipping"><i class="fa fa-pencil"></i></a>
                                      
                                        <button v-show="!requests.shippings.length" class="btn btn-xs btn-danger" type="submit" data-toggle="tooltip" title="Remove Shipping request" form="form-delete" :formaction="'/shipping-requests/'+ requests.id" ><i class="fa fa-times"></i></button>
                                        
                                    </div>
                                </td>
                            </tr>
                          
                            
                        </tbody>
                    </table>
                    <laravel-pagination :data="shippingsRequests" v-on:pagination-change-page="getShippingsRequests"></laravel-pagination >
                   
                   
                </div>
                <!-- END Users -->
                <div class="tab-pane fade fade-up in " id="search-shippings">
                    <div class="border-b push-30">
                        <h2 class="push-10">{{ shippings.total }} <span class="h5 font-w400 text-muted">Shippings Found</span></h2>
                    </div>
                    <table class="table table-striped table-vcenter">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Request</th>
                                <th class="text-center"><i class="si si-user"></i></th>
                                <th class="text-center">Delivery Time</th>
                                <th class="hidden-xs" >Request Date</th>
                                <th class="hidden-xs hidden-sm" >Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                            <tr v-for="shipping in shippings.data" :key="shipping.id">
                                <td class="text-center font-w600">{{ shipping.transaction_id }}</td>
                                 <td class="text-center font-w600">{{ shipping.shipping_request.transaction_id }}</td>
                                <td class="text-center">
                                    {{ shipping.quotation.user.company.public_code }}
                                       
                                </td>
                                <td class="font-w600">{{ (shipping.delivery_time) ? 'Normal' : 'Express' }}</td>
                                <td class="hidden-xs">{{ shipping.date }}</td>
                                <td class="hidden-xs hidden-sm">
                                    <span class="label label-warning" v-show="shipping.status == 0">Pending</span>
                                    <span class="label label-success" v-show="shipping.status == 1">Granted</span>
                                    <span class="label label-danger" v-show="shipping.status == 2">Reject</span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a :href="'/shippings/'+ shipping.id +'/edit'" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit Shipping"><i class="fa fa-eye"></i></a>
                                      
                                        
                                        
                                    </div>
                                </td>
                            </tr>
                           
                            
                        </tbody>
                    </table>
                    <laravel-pagination :data="shippings" v-on:pagination-change-page="getShippings"></laravel-pagination >
                   
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
		    urlShippings:{
                type:String,
                default:'/shippings'
            },
            urlShippingsRequests:{
                type:String,
                default:'/shipping-requests'
            }
          
        },
        
        data () {
            return {

                
                loader:false,
                errors:[],
                shippings:{},
                shippingsRequests:{},
                search:'',
                activeView:'shipping-requests'

                

            }
          
        },

        methods:{
            currentView(page) {
                
                this.activeView = page
            },
            onSearch:_.debounce(function(search) {
	           
                if(this.activeView == 'shipping-requests')
                    this.getShippingsRequests();
                else
                   this.getShippings();
					

		    }, 500),
            getShippings(page) {
				if (typeof page === 'undefined') {
					page = 1;
				}
				

				// Using vue-resource as an example
				axios.get(`${this.urlShippings}/list?q=${this.search}&page=${page}`).then((response) => {
                     
                      this.shippings = response.data;
                    
                      
                    }, (response) => {
                        console.log(response.data)
                               
                    });

				
            },
            getShippingsRequests(page) {
				if (typeof page === 'undefined') {
					page = 1;
				}
				

				// Using vue-resource as an example
				axios.get(`${this.urlShippingsRequests}/list?q=${this.search}&page=${page}`).then((response) => {
                     
                      this.shippingsRequests = response.data;
                    
                      
                    }, (response) => {
                        console.log(response.data)
                               
                    });

				
			},
        },
        created() {
           
            this.getShippings()
            this.getShippingsRequests()

            console.log('Component Shippings.')
        }
    }
</script>