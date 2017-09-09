<template>

    
    
        <div class="row items-push">
                <div class="col-xs-6" v-for="sector in sectors">
                    <label class="css-input css-checkbox css-checkbox-success">
                        <input type="checkbox" name="sectors[]" v-bind:value="sector.id"><span></span> {{ sector.name }}
                    </label>
                    <div>
                        <div class="col-xs-12" v-for="subsector in sector.subsectors">
                            <label class="css-input css-checkbox css-checkbox-success">
                                <input type="checkbox" name="sectors[]" v-bind:value="subsector.id"><span></span> {{ subsector.name }}
                            </label>
                        </div>

                    </div>
                    
                </div>
            
            
        </div>
                   
                
    

</template>

<script>
    

    export default {
        props:['sectors'],
        data () {
            return {

                loader:false,
                shownGroup: null
                //sectors_subsectors:[]

            }
          
        },

        methods:{
           
            toggleGroup(group) {
                if (this.isGroupShown(group)) {
                    this.shownGroup = null;
                } else {
                    this.shownGroup = group;
                }
            },

            isGroupShown(group) {
                return this.shownGroup === group;
            }
                        
        },
        created() {
            // if(this.sectors)
            //     this.sectors_subsectors = this.sectors

            console.log('Component Sectors.')
        }
    }
</script>
