<template>
    <div class="modal fade show d-block" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Order Detail</h5>
                    <button type="button" class="btn-close" @click="$emit('close')"></button>
                </div>
                <div class="modal-body">
                    <ul>
                        <li><b>Order Id:</b> {{ order.id }}</li>
                        <li><b>Customer Name:</b> {{ order.customer.name }}</li>
                        <li><b>Purchase Date: </b> {{ formatDate(order.purchase_date) }}</li>
                        <li><b>Lot Number: </b> {{ lotList }}</li>
                        <li><b>Medications: </b> {{ medicationsList }}</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" @click="$emit('close')">Close</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props:{
            order:Object
        },
        computed:{
            medicationsList(){
                return this.order.items
                .map(item => item.medication.name)
                .join(', ')
            },
            lotList(){
                // return this.order.items
                // .map(item => item.medication.lot_number)
                // .join(', ')
                return [...new Set(this.order.items.map(item => item.medication.lot_number))].join(', ')
            }
        },
        methods:{
            formatDate(date){
                return date.substring(0,10)
            },
        }
    }
</script>