<template>
    <div class="mt-4">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Purchase Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- The information is iterated with the order data and the corresponding buttons, as required in the specification. -->
                <tr v-for="order in orders" :key="order.id">
                    <td>{{ order.id }}</td>
                    <td>{{ order.customer?.name }}</td>
                    <td>{{ formatDate(order.purchase_date) }}</td>
                    <td>
                        <button class="btn btn-sm btn-info me-1" @click="viewOrder(order.id)">View Order</button>
                        <button class="btn btn-sm btn-warning me-1" @click="alertBuyer(order)">Alert Buyer</button>
                        <button class="btn btn-sm btn-success" @click="viewCustomer(order.customer.id)">View Buyer</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    /* 
        This script performs the following:

        Receives the orders data as a required dynamic array prop to display in the table.
        Formats the date for the `purchase_date` column.
        The alert-buyer event is emitted with the order information to the parent container 
        to open the modal that contains the alert.
        The view-order event is emitted with the id order data to the parent container to
        open the modal which will contain the specific information of the order
        The view-customer event is emitted with the id order data to the parent container to
        open the modal which will contain the specific information of the customer

    */
    export default{
        props:{
            orders:{
                type:Array,
                required:true
            }
        },
        mounted(){
            this.initDataTable()
        },
        watch:{
            orders(){
                this.$nextTick(()=>{
                    this.destroyTable()
                    this.initDataTable()
                })
            }
        },
        methods:{
            formatDate(date){
                return date.substring(0,10)
            },
            viewOrder(order){
                this.$emit('view-order', order)
            },
            alertBuyer(order){
                this.$emit('alert-buyer', order)
            },
            viewCustomer(order){
                this.$emit('view-customer', order)
            },
            initDataTable(){
                this.table = $(this.$el).find('table').DataTable({
                    pageLength:5,
                    lengthChange:false,
                    searching:false,
                    ordering:false
                })
            },
            destroyTable(){
                if(this.table){
                    this.table.destroy()
                }
            }
        }
    }
</script>