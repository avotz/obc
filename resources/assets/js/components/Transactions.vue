 <template>
 <div>
 <!-- Search Section -->
    <div class="content">
        <div class="form-group">
            <div class="row">
               
                <div class="col-xs-12 col-md-3">
                    <select v-model="country_id" class="form-control" :disabled="disabled" @change="onSearch">
                        <option v-for="option in country_list" v-bind:value="option.id">
                            {{ option.name }}
                        </option>
                    </select>
                </div>
                <div class="col-xs-12 col-md-3">
                    <input class="js-datepicker form-control" type="text" id="date_start" name="date_start" v-model="date_start" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" @blur="onBlurDateStart">
                </div>
                <div class="col-xs-12 col-md-3">
                    <input class="js-datepicker form-control" type="text" id="date_end" name="date_end" v-model="date_end" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" @blur="onBlurDateEnd">
                </div>
                <div class="col-xs-12 col-md-3">
                    <div class="input-group">
                        <input class="form-control" name="q" type="text" placeholder="Search by ID.." v-model="search" >
                        <div class="input-group-btn">
                            <button class="btn btn-default" @click="onSearch"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      
    </div>
    <!-- END Search Section -->

    <!-- Page Content -->
    <div class="content">
        <div class="block">
            <ul class="nav nav-tabs" data-toggle="tabs">
               
                <li class="active" @click="currentView('quotation-requests')">
                    <a href="#search-quotation-requests" title="Solicitudes de cotización">Quotation Requests</a>
                </li>
                <li >
                    <a href="#search-quotations" @click="currentView('quotations')" title="Cotizaciones">Quotation</a>
                </li>
                <li >
                    <a href="#search-shipping-requests" @click="currentView('shipping-requests')" title="Solicitudes de envio">Shipping Requests</a>
                </li>
                <li >
                    <a href="#search-shippings" @click="currentView('shippings')" title="Envios">Shippings</a>
                </li>
                <li >
                    <a href="#search-credit-requests" @click="currentView('credit-requests')" title="Solicitudes de crédito">Credit Requests</a>
                </li>
                 <li >
                    <a href="#search-credits" @click="currentView('credits')" title="Créditos">Credits</a>
                </li>
                 <li >
                    <a href="#search-purchase-orders" @click="currentView('purchase-orders')" title="Ordenes de compra">Purchase Orders</a>
                </li>
                 <li >
                    <a href="#search-saving-obc" @click="currentView('saving-obc')" title="Historial de ahorro OBC">Saving History OBC</a>
                </li>
               
               
            </ul>
            <div class="block-content tab-content bg-white">
                <!-- quotation-requests -->
                <div class="tab-pane fade fade-up in active" id="search-quotation-requests">
                    <div class="border-b push-30">
                        <h2 class="push-10" title="{{ quotationRequests.total }} Solicitudes de cotización encontradas">{{ quotationRequests.total }} <span class="h5 font-w400 text-muted" >Quotation Requests Found</span></h2>
                    </div>
                    <table class="table table-striped table-vcenter">
                        <thead>
                            <tr>
                                <th class="text-center" title="ID">ID</th>
                                <th class="text-center"><i class="si si-user"></i></th>
                                <th class="text-center" title="ID usuario">User Id</th>
                                
                                <th class="hidden-xs" title="Fecha de solicitud">Request Date</th>
                                <th class="hidden-xs" title="Cotizaciones">Quotations</th>
                                <th class="text-center" title="Ver">See</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <tr v-for="requests in quotationRequests.data" :key="requests.id">
                                <td class="text-center font-w600">{{ requests.transaction_id }}</td>
                                <td class="text-center">
                                    
                                    {{ requests.user.company.public_code }} | {{ requests.user.company.company_name }}
                                </td>
                                <td class="text-center font-w600">{{ requests.user.public_code }} / {{  requests.user.profile.fullname }} / {{ requests.user.profile.position_held }}</td>
                               
                                <td class="hidden-xs">{{ requests.created_at }}</td>
                                <td class="text-center">
                                     <a :href="'/requests/'+ requests.id +'/quotations'" class="btn btn-xs btn-success" data-toggle="tooltip" title="{{ requests.quotations.length }} Cotizacion(es)">{{ requests.quotations.length }} Quotations</a>
                                </td>
                                <td class="text-center">
                                   <a :href="'/requests/'+ requests.id +'/edit'" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Detalle"><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                          
                            
                        </tbody>
                    </table>
                    <laravel-pagination :data="quotationRequests" v-on:pagination-change-page="getQuotationRequests"></laravel-pagination >
                   
                   
                </div>
                <!-- END quotation-requests -->
                <div class="tab-pane fade fade-up in " id="search-quotations">
                    <div class="border-b push-30">
                        <h2 class="push-10" title="{{ quotations.total }} Cotizaciones encontradas">{{ quotations.total }} <span class="h5 font-w400 text-muted" >Quotations Found</span></h2>
                    </div>
                    <table class="table table-striped table-vcenter">
                        <thead>
                            <tr>
                                <th class="text-center" title="ID">ID</th>
                                 <th class="text-center" title="Solicitud">Request</th>
                                <th class="text-center" ><i class="si si-user"></i></th>
                                <th class="text-center" title="ID Usuario">User Id</th>
                                <th class="hidden-xs" title="Fecha cotización">Quotation Date</th>
                                <th class="hidden-xs hidden-sm" title="Ver">See</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                           
                            <tr v-for="quotation in quotations.data" :key="quotation.id">
                                <td class="text-center font-w600">{{ quotation.transaction_id }}</td>
                                 <td class="text-center font-w600">{{ quotation.request.transaction_id }}</td>
                                <td class="text-center">
                                    {{ quotation.user.company.public_code }}
                                       
                                </td>
                               <td class="text-center font-w600">{{ quotation.user.public_code }} / {{  quotation.user.profile.fullname }} / {{ quotation.user.profile.position_held }}</td>
                                <td class="hidden-xs">{{ quotation.created_at }}</td>
                                <td class="hidden-xs hidden-sm">
                                   <a :href="'/quotations/'+ quotation.id +'/edit'" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Detalle"><i class="fa fa-eye"></i></a>
                                </td>
                                
                            </tr>
                           
                            
                        </tbody>
                    </table>
                    <laravel-pagination :data="quotations" v-on:pagination-change-page="getQuotations"></laravel-pagination >
                   
                </div>
                <!-- END quotations -->
                <!-- shipping-requests -->
                <div class="tab-pane fade fade-up in " id="search-shipping-requests">
                    <div class="border-b push-30">
                        <h2 class="push-10" title="{{ shippingsRequests.total }} Solicitudes de envio encontradas">{{ shippingsRequests.total }} <span class="h5 font-w400 text-muted" >Shippings Request Found</span></h2>
                    </div>
                    <table class="table table-striped table-vcenter">
                        <thead>
                            <tr>
                                <th class="text-center" title="ID">ID</th>
                                <th class="text-center"><i class="si si-user"></i></th>
                                <th class="text-center" title="Tipo">Type</th>
                                <th class="text-center" title="Tiempo de entrega">Delivery Time</th>
                                <th class="hidden-xs" title="Fecha de solicitud">Request Date</th>
                                <th class="hidden-xs" title="Envios">Shippings</th>
                                <th class="text-center" title="Acciones">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <tr v-for="requests in shippingsRequests.data" :key="requests.id">
                                <td class="text-center font-w600">{{ requests.transaction_id }}</td>
                                <td class="text-center">
                                    
                                    {{ requests.user.company.public_code }}
                                </td>
                                <td class="text-center font-w600">{{ (requests.type) ? 'International' : 'National' }}</td>
                                <td class="text-center font-w600">{{ (requests.delivery_time) ? 'Normal' : 'Express' }}</td>
                                <td class="hidden-xs">{{ requests.date }}</td>
                                <td class="text-center">
                                     <a :href="'/shipping-requests/'+ requests.id +'/shippings'" class="btn btn-xs btn-success" data-toggle="tooltip" title="{{ requests.shippings.length }} Envios">{{ requests.shippings.length }} Shipping</a>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                       <a :href="'/shipping-requests/'+ requests.id +'/edit'" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit Shipping"><i class="fa fa-eye"></i></a>
                                      
                                        
                                        
                                    </div>
                                </td>
                            </tr>
                          
                            
                        </tbody>
                    </table>
                    <laravel-pagination :data="shippingsRequests" v-on:pagination-change-page="getShippingsRequests"></laravel-pagination >
                   
                   
                </div>
                <!-- END shipping-requests -->
                <div class="tab-pane fade fade-up in " id="search-shippings">
                    <div class="border-b push-30">
                        <h2 class="push-10" title="{{ shippings.total }} Envios encontrados">{{ shippings.total }} <span class="h5 font-w400 text-muted">Shippings Found</span></h2>
                    </div>
                    <table class="table table-striped table-vcenter">
                        <thead>
                            <tr>
                                <th class="text-center" title="ID">ID</th>
                                <th class="text-center" title="Solicitud">Request</th>
                                <th class="text-center"><i class="si si-user"></i></th>
                                <th class="text-center" title="Tiempo de entrega">Delivery Time</th>
                                <th class="hidden-xs" title="Fecha de solicitud">Request Date</th>
                                <th class="hidden-xs hidden-sm" title="Estado">Status</th>
                                <th class="text-center" title="Acciones">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                            <tr v-for="shipping in shippings.data" :key="shipping.id">
                                <td class="text-center font-w600">{{ shipping.transaction_id }}</td>
                                 <td class="text-center font-w600">{{ shipping.shipping_request.transaction_id }}</td>
                                <td class="text-center">
                                    {{ shipping.user.company.public_code }}
                                       
                                </td>
                                <td class="font-w600">{{ (shipping.delivery_time) ? 'Normal' : 'Express' }}</td>
                                <td class="hidden-xs">{{ shipping.date }}</td>
                                <td class="hidden-xs hidden-sm">
                                    <span class="label label-warning" v-show="shipping.status == 0" title="Pendiente">Pending</span>
                                    <span class="label label-success" v-show="shipping.status == 1" title="Concedido">Granted</span>
                                    <span class="label label-danger" v-show="shipping.status == 2" title="Rechazado">Reject</span>
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
                <!-- END Shippings -->
                <div class="tab-pane fade fade-up in" id="search-credit-requests">
                    <div class="border-b push-30">
                        <h2 class="push-10" title="{{ creditRequests.total }} Solicitudes de crédito encontradas ">{{ creditRequests.total }} <span class="h5 font-w400 text-muted">Credits Request Found</span></h2>
                    </div>
                    <table class="table table-striped table-vcenter">
                        <thead>
                            <tr>
                                <th class="text-center" title="ID">ID</th>
                                <th class="text-center" ><i class="si si-user"></i></th>
                                <th class="text-center" title="Tiempo de crédito">Credit Time</th>
                                <th class="hidden-xs" title="Fecha de solicitud">Request Date</th>
                                <th class="hidden-xs" title="Créditos">Credits</th>
                                <th class="text-center" title="Acciones">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <tr v-for="requests in creditRequests.data" :key="requests.id">
                                <td class="text-center font-w600">{{ requests.transaction_id }}</td>
                                <td class="text-center">
                                    
                                    {{ requests.user.company.public_code }}
                                </td>
                                <td class="text-center font-w600">{{ requests.credit_time }} days</td>
                                <td class="hidden-xs">{{ parseDate(requests.date) }}</td>
                                <td class="text-center">
                                     <a :href="'/credit-requests/'+ requests.id +'/credits'" class="btn btn-xs btn-success" data-toggle="tooltip" title="{{ requests.credits.length }} créditos">{{ requests.credits.length }} Credits</a>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                       <a :href="'/credit-requests/'+ requests.id +'/edit'" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit Credit"><i class="fa fa-eye"></i></a>
                                      
                                        
                                        
                                    </div>
                                </td>
                            </tr>
                          
                            
                        </tbody>
                    </table>
                    <laravel-pagination :data="creditRequests" v-on:pagination-change-page="getCreditRequests"></laravel-pagination >
                   
                   
                </div>
                <!-- END credit-requests -->
                <div class="tab-pane fade fade-up in " id="search-credits">
                    <div class="border-b push-30">
                        <h2 class="push-10" title="{{ credits.total }} Créditos encontrados">{{ credits.total }} <span class="h5 font-w400 text-muted">Credits Found</span></h2>
                    </div>
                    <table class="table table-striped table-vcenter">
                        <thead>
                            <tr>
                                <th class="text-center" title="ID">ID</th>
                                <th class="text-center" title="Solicitud">Request</th>
                                <th class="text-center"><i class="si si-user"></i></th>
                                <th class="text-center" title="Tiempo de crédito">Credit Time</th>
                                <th class="hidden-xs" title="Fecha de solicitud" >Request Date</th>
                                <th class="hidden-xs hidden-sm" title="Estado">Status</th>
                                <th class="text-center" title="Acciones">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                            <tr v-for="credit in credits.data" :key="credit.id">
                                <td class="text-center font-w600">{{ credit.transaction_id }}</td>
                                 <td class="text-center font-w600">{{ credit.credit_request.transaction_id }}</td>
                                <td class="text-center">
                                    {{ credit.user.company.public_code }}
                                       
                                </td>
                                <td class="font-w600">{{ credit.credit_time }} days</td>
                                <td class="hidden-xs">{{ parseDate(credit.date) }}</td>
                                <td class="hidden-xs hidden-sm">
                                    <span class="label label-warning" v-show="credit.status == 0" title="Pendiente">Pending</span>
                                    <span class="label label-success" v-show="credit.status == 1" title="Concedido">Granted</span>
                                    <span class="label label-danger" v-show="credit.status == 2" title="Rechazado">Reject</span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a :href="'/credits/'+ credit.id +'/edit'" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit credit"><i class="fa fa-eye"></i></a>
                                      
                                        
                                        
                                    </div>
                                </td>
                            </tr>
                           
                            
                        </tbody>
                    </table>
                    <laravel-pagination :data="credits" v-on:pagination-change-page="getCredits"></laravel-pagination >
                   
                </div>
                <!-- END credits -->
                 <div class="tab-pane fade fade-up in " id="search-purchase-orders">
                    <div class="border-b push-30">
                        <h2 class="push-10" title="{{ purchaseOrders.total }} Ordenes de compra encontradas">{{ purchaseOrders.total }} <span class="h5 font-w400 text-muted">Purchase Orders Found</span></h2>
                    </div>
                    <table class="table table-striped table-vcenter">
                        <thead>
                            <tr>
                                <th class="text-center" title="ID">ID</th>
                                <th class="text-center" title="Cotización">Quotation</th>
                                <th class="text-center"><i class="si si-user"></i></th>
                                <th class="text-center" title="Monto">Amount</th>
                                <th class="hidden-xs" title="Fecha de compra">Purchase Date</th>
                                <th class="hidden-xs hidden-sm" title="Estado">Status</th>
                                <th class="text-center" title="Acciones">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                            <tr v-for="purchase in purchaseOrders.data" :key="purchase.id">
                                <td class="text-center font-w600">{{ purchase.transaction_id }}</td>
                                 <td class="text-center font-w600">{{ purchase.quotation.transaction_id }}</td>
                                <td class="text-center">
                                    {{ purchase.user.company.public_code }}
                                       
                                </td>
                                <td class="font-w600">{{ purchase.amount }} {{ purchase.currency }}</td>
                                <td class="hidden-xs">{{ parseDate(purchase.created_at) }}</td>
                                <td class="hidden-xs hidden-sm">
                                    <span class="label label-warning" v-show="purchase.status == 0" title="Pendiente">Pending</span>
                                    <span class="label label-success" v-show="purchase.status == 1" title="Concedido">Granted</span>
                                    <span class="label label-danger" v-show="purchase.status == 2" title="Rechazado">Reject</span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a :href="'/purchases/'+ purchase.id +'/edit'" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit credit"><i class="fa fa-eye"></i></a>
                                      
                                        
                                        
                                    </div>
                                </td>
                            </tr>
                           
                            
                        </tbody>
                    </table>
                    <laravel-pagination :data="purchaseOrders" v-on:pagination-change-page="getPurchaseOrders"></laravel-pagination >
                   
                </div>
                <!-- END purchase-orders -->

                <div class="tab-pane fade fade-up in " id="search-saving-obc">
                    <div class="border-b push-30">
                        <h2 class="push-10" title="{{ purchaseOrdersApproved.total }} Ahorros de OBC encontrados">{{ purchaseOrdersApproved.total }} <span class="h5 font-w400 text-muted">Saving OBC Found</span></h2>
                    </div>
                    <table class="table table-striped table-vcenter">
                        <thead>
                            <tr>
                    
                                <th class="text-center" title="Orden de compra">Purchase Order</th>
                                <th class="text-center" ><i class="si si-user"></i></th>
                                <th class="text-center" title="Monto original">Original Amount</th>
                                <th class="text-center" title="Monto final">Final Amount</th>
                                <th class="text-center" title="Ahorro OBC">Saving OBC</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                           
                            <tr v-for="purchase in purchaseOrdersApproved.data" :key="purchase.id">
                               
                                <td class="text-center font-w600">{{ purchase.transaction_id }}</td>
                                <td class="text-center">
                                    {{ purchase.user.company.public_code }}
                                       
                                </td>
                                <td class="font-w600 text-center">{{ purchase.amount }} {{ purchase.currency }}</td>
                                 <td class="font-w600 text-center">{{ purchase.total }} {{ purchase.currency }}</td>

                                <td class="text-center">{{ calculatePercentAmount(purchase.discount, purchase.amount) }} {{ purchase.currency }}</td>
                                
                                
                            </tr>
                           
                            
                        </tbody>
                    </table>
                    <laravel-pagination :data="purchaseOrdersApproved" v-on:pagination-change-page="getPurchaseOrdersApproved"></laravel-pagination >
                   
                </div>
                <!-- END ahorro obc -->


               
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
                default:'/admin/shippings'
            },
            urlShippingsRequests:{
                type:String,
                default:'/admin/shipping-requests'
            },
            urlCredits:{
                type:String,
                default:'/admin/credits'
            },
            urlCreditRequests:{
                type:String,
                default:'/admin/credit-requests'
            },
            urlQuotations:{
                type:String,
                default:'/admin/quotations'
            },
            urlQuotationRequests:{
                type:String,
                default:'/admin/quotation-requests'
            },
             urlPurchaseOrders:{
                type:String,
                default:'/admin/purchase-orders'
            },
            countries:{
                type:Array,
                

            },
             country:{
                type:Object,

            },
              
          
        },
        
        data () {
            return {

                
                loader:false,
                errors:[],
                quotations:{},
                quotationRequests:{},
                shippings:{},
                shippingsRequests:{},
                credits:{},
                creditRequests:{},
                purchaseOrders:{},
                purchaseOrdersApproved:{},
                search:'',
                country_id:'',
                country_list:[],
                date_start:moment().startOf('month').format('YYYY-MM-DD'),
                date_end: moment().endOf('month').format('YYYY-MM-DD'),
                activeView:'quotation-requests',
                disabled: true,
                savingObcTotal: 0

                

            }
          
        },

        methods:{
            calculatePercentAmount(percent, amount)
            {
                return (percent / 100) * amount;
            },
             onBlurDateStart(e){
                const value = e.target.value;

                this.date_start = value;
                
            },
             onBlurDateEnd(e){
                const value = e.target.value;
               
                this.date_end = value;
                
            },
            parseDate(date){
                return moment(date).format('YYYY-MM-DD')
            },
            currentView(page) {
                
                this.activeView = page;

                if(this.activeView == 'shipping-requests')
                    this.getShippingsRequests();

                if(this.activeView == 'shippings')
                    this.getShippings();

                if(this.activeView == 'quotation-requests')
                    this.getQuotationRequests();

                if(this.activeView == 'quotations')
                    this.getQuotations();
                
                if(this.activeView == 'credit-requests')
                    this.getCreditRequests();
                
                if(this.activeView == 'credits')
                    this.getCredits();
                
                if(this.activeView == 'purchase-orders')
                    this.getPurchaseOrders();
                    
                 if(this.activeView == 'saving-obc')
                    this.getPurchaseOrdersApproved();
            },
            onSearch:_.debounce(function(search) {
	           
                if(this.activeView == 'shipping-requests')
                    this.getShippingsRequests();

                if(this.activeView == 'shippings')
                    this.getShippings();

                if(this.activeView == 'quotation-requests')
                    this.getQuotationRequests();

                if(this.activeView == 'quotations')
                    this.getQuotations();
                
                if(this.activeView == 'credit-requests')
                    this.getCreditRequests();
                
                if(this.activeView == 'credits')
                    this.getCredits();
                
                if(this.activeView == 'purchase-orders')
                    this.getPurchaseOrders();

                 if(this.activeView == 'saving-obc')
                    this.getPurchaseOrdersApproved();
					

		    }, 0),
              getQuotations(page) {
				if (typeof page === 'undefined') {
					page = 1;
				}
                let url = '';

                /*if(this.country_id)
                    url = `${this.urlQuotations}/list?q=${this.search}&country=${this.country_id}&date_start=${this.date_start}&date_end=${this.date_end}&page=${page}`;
                else*/

				

				// Using vue-resource as an example
				axios.get(`${this.urlQuotations}/list?q=${this.search}&country=${this.country_id}&date_start=${this.date_start}&date_end=${this.date_end}&page=${page}`).then((response) => {
                     
                      this.quotations = response.data;
                    
                      
                    }, (response) => {
                        console.log(response.data)
                               
                    });

				
            },
            getQuotationRequests(page) {
				if (typeof page === 'undefined') {
					page = 1;
				}
				

				// Using vue-resource as an example
				axios.get(`${this.urlQuotationRequests}/list?q=${this.search}&country=${this.country_id}&date_start=${this.date_start}&date_end=${this.date_end}&page=${page}`).then((response) => {
                     
                      this.quotationRequests = response.data;
                    
                      
                    }, (response) => {
                        console.log(response.data)
                               
                    });

				
			},
            getShippings(page) {
				if (typeof page === 'undefined') {
					page = 1;
				}
				

				// Using vue-resource as an example
				axios.get(`${this.urlShippings}/list?q=${this.search}&country=${this.country_id}&date_start=${this.date_start}&date_end=${this.date_end}&page=${page}`).then((response) => {
                     
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
				axios.get(`${this.urlShippingsRequests}/list?q=${this.search}&country=${this.country_id}&date_start=${this.date_start}&date_end=${this.date_end}&page=${page}`).then((response) => {
                     
                      this.shippingsRequests = response.data;
                    
                      
                    }, (response) => {
                        console.log(response.data)
                               
                    });

				
			},
            getCredits(page) {
				if (typeof page === 'undefined') {
					page = 1;
				}
				

				// Using vue-resource as an example
				axios.get(`${this.urlCredits}/list?q=${this.search}&country=${this.country_id}&date_start=${this.date_start}&date_end=${this.date_end}&page=${page}`).then((response) => {
                     
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
				axios.get(`${this.urlCreditRequests}/list?q=${this.search}&country=${this.country_id}&date_start=${this.date_start}&date_end=${this.date_end}&page=${page}`).then((response) => {
                     
                      this.creditRequests = response.data;
                    
                      
                    }, (response) => {
                        console.log(response.data)
                               
                    });

				
			},
            getPurchaseOrders(page) {
				if (typeof page === 'undefined') {
					page = 1;
				}
				

				// Using vue-resource as an example
				axios.get(`${this.urlPurchaseOrders}/list?q=${this.search}&country=${this.country_id}&date_start=${this.date_start}&date_end=${this.date_end}&page=${page}`).then((response) => {
                     
                      this.purchaseOrders = response.data.paginateData;
                    
                      
                    }, (response) => {
                        console.log(response.data)
                               
                    });

				
			},
            getPurchaseOrdersApproved(page) {
				if (typeof page === 'undefined') {
					page = 1;
				}
				

				// Using vue-resource as an example
				axios.get(`${this.urlPurchaseOrders}/list?q=${this.search}&country=${this.country_id}&date_start=${this.date_start}&date_end=${this.date_end}&status=1&page=${page}`).then((response) => {
                    
                      this.purchaseOrdersApproved = response.data.paginateData;
                      this.savingObcTotal = response.data.total;
                      
                    }, (response) => {
                        console.log(response.data)
                               
                    });

				
			},
        },
        created() {

            if(this.countries){
                this.country_list = this.countries;
                this.country_id = this.countries[0].id
                this.disabled = false; 
            }else{
                this.country_list.push(this.country);
                this.country_id = this.country.id
                 this.disabled = true; 
            }

            //this.getQuotations()
            this.getQuotationRequests()
            //this.getShippings()
            //this.getShippingsRequests()
            //this.getCredits()
            //this.getCreditRequests()
            //this.getPurchaseOrders()

            console.log('Component Transactions.')
        }
    }
</script>