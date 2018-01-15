
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('alert', require('./components/Alert.vue'));
Vue.component('check-partner', require('./components/CheckPartnerPrivateCode.vue'));
Vue.component('update-private-code', require('./components/UpdatePrivateCode.vue'));
Vue.component('sector-subsectors', require('./components/SectorSubsectors.vue'));
Vue.component('update-country', require('./components/UpdateCountry.vue'));
Vue.component('delete-avatar-profile', require('./components/DeleteAvatarProfile.vue'));
Vue.component('delete-photo-product', require('./components/DeletePhotoProduct.vue'));
Vue.component('delete-file', require('./components/DeleteFile.vue'));
Vue.component('shippings', require('./components/Shippings.vue'));
Vue.component('shipping-requests', require('./components/ShippingRequests.vue'));
Vue.component('credits', require('./components/Credits.vue'));
Vue.component('credit-requests', require('./components/CreditRequests.vue'));
Vue.component('transactions', require('./components/Transactions.vue'));
window.bus = new Vue();

const app = new Vue({
    el: '#app',
    data: {
        message: {
          show:false,
          text: "",
          type: "info"
        }
     },
     created() {
       bus.$on('alert', this.alertMessage);
       
     },
     methods:{
          alertMessage (message, type = "info") {
           console.log('aler from main app');
           this.message.text = message;
           this.message.show = true;
           this.message.type = type;
           setTimeout(
             () => {
               this.message.show = false,
               this.message.text = ""
             },
             3000
           )
         }
     
     }
});

$(".dropdown-toggle").dropdown();
$("form[data-confirm]").submit(function() {
  if ( ! confirm($(this).attr("data-confirm"))) {
      return false;
  }
});