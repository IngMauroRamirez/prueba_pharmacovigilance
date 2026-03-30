<template>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <label><strong>Lot Number (<span style="color:red;">*</span>)</strong></label> 
                    <input type="text" class="form-control" v-model="filters.lot">
                </div>
                <div class="col-md-4">
                    <label><strong>Start Date</strong></label>
                    <input type="date" class="form-control" v-model="filters.start_date">
                </div>
                <div class="col-md-4">
                    <label><strong>End Date</strong></label>
                    <input type="date" class="form-control" v-model="filters.end_date">
                </div>
            </div>
            <button class="btn btn-primary mt-3" @click="search"> Search </button>
        </div>
    </div>
</template>

<script>
    /* 
        This script performs the following:

        Exports the filter data to keep the template in sync.
        Sets the start date and end date selectors to the last 30 days.
        Method to return the filters to parent component
    */
    export default {
        data(){
            return{
                filters:{
                    lot:'',
                    start_date:'',
                    end_date:''
                }
            }
        },
        mounted(){
            const today = new Date()
            const lastMonth = new Date()

            lastMonth.setDate(today.getDate() - 30)

            this.filters.end_date = today.toISOString().substr(0,10)
            this.filters.start_date = lastMonth.toISOString().substr(0,10)
        },
        methods:{
            search(){
                if(!this.filters.lot){
                    this.$emit('error', 'Lot number is required')
                    return
                }

                this.$emit('error', null)
                this.$emit('search', this.filters)
            }
        }
    }
</script>