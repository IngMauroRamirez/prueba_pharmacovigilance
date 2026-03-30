<template>
    <div class="modal fade show d-block" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Alert</h5>
                    <button type="button" class="btn-close" @click="$emit('close')"></button>
                </div>
                <div class="modal-body" v-if="order">
                    <p><strong>Warning:</strong> There is a problem with order with lot number(s) N° <strong>{{ lotList }}</strong> 
                        for the buyer <strong>{{ order.customer.name }}</strong> as medications <strong>{{ medicationsList }}</strong>
                        are unavailable for delivery.
                    </p>
                    <p><strong>Please contact the pharmacy immediately.</strong></p>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" @click="$emit('close')">Cancel</button>

                    <button class="btn btn-warning" @click="sendAlert" :disabled="loading">
                        {{ loading ? 'Sending...' : 'Send Alert' }}
                    </button>
                </div>

            </div>
        </div>
    </div>
</template>

<script>

    /* This script does the following:
        Imports the Axios library to make HTTP requests
        Exports the order information so it can be used in the modal template
        Transforms the medication data and the order number data for better visualization
        Creates a method to send the alert (store it in the database) 
    */
    import axios from 'axios'

    export default {
        props:{
            order:Object
        },
        data(){
            return{
                loading:false
            }
        },
        computed:{
            medicationsList(){
                return this.order.items
                .map(item => item.medication.name)
                .join(', ')
            },
            lotList(){
                return [...new Set(this.order.items.map(item => item.medication.lot_number))].join(', ')
            }

        },
        methods:{
            async sendAlert(){
                this.loading = true

                try{
                    const response = await axios.post('/api/alerts/send',{
                        order_id:this.order.id,
                        customer_id:this.order.customer.id
                    })
                    this.$emit('success', response.data.message)
                    this.$emit('close')

                }catch(error){
                    if (error.response && error.response.status == 500) {
                        this.$emit('error', error.response.data.message)
                        this.$emit('close')
                    }
                }finally{
                    this.loading = false
                }
            }
        }
    }
</script>