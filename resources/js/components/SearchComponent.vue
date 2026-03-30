<template>
    <div class="container mt-4">
        <div class="mt-4"><h2>Welcome, {{ user.name }}</h2></div>
        <br>
        <button class="btn btn-sm btn-secondary" @click="logout">Log out</button>
        <br><br>
        <h4>Medication Search</h4>
        <p><b>Fields marked with asterisks are required.</b></p>
        <!-- Invocation of the filters component. -->
        <search-filters @search="searching" @error="error = $event"/>
        <div v-if="loading" class="mt-3">
            Loading...
        </div>
        <!-- divs for error handling -->
        <div v-if="error" class="alert alert-danger mt-3">
            {{ error }}
        </div>
        <div v-if="success" class="alert alert-success mt-3">
            {{ success }}
        </div>
        <!-- Passing orders data to the model OrdersTable that backs the table component for rendering. 
            The event listener listens for alert-buyer with the order information so it can execute the function that opens the alert modal.
            The event listener listens for view-order with the specific order information so it can execute the function that opens the view order modal.
            The event listener listens for view-order with the specific order information so it can execute the function that opens the view order modal.
        -->
        <orders-table v-if="orders.length" :orders="orders" @alert-buyer="openAlertModal" @view-order="openViewOrderModal" @view-customer="openViewCustomerModal"/>
        <!-- Sending data to the alert modal, along with an event listener that helps close the modal and another event listener for error handling. -->
        <alert-modal v-if="showAlertModal" :order="selectedOrder" @close="showAlertModal=false" @success="success = $event" @error="error = $event"/>
        <view-order v-if="showViewOrderModal" :order="selectedOrder" @close="showViewOrderModal=false"/>
        <detail-customer v-if="showViewCustomerModal" :customer_info="selectedOrder" @close="showViewCustomerModal=false"/>
    </div>
</template>

<script>
    /* 
        This script performs the following:

        Imports the Axios library to execute HTTP requests.
        Imports the filter form component.
        Imports the component responsible for rendering the datatable (if available).
        Import the Alert modal component for the alert buyer button
        Import the view order component to show modal with the specific order informacion
        Import the view customer component to show modal with the specific customer informacion

        Registers the modules to make them usable within this parent component.
        
        Returns the orders data (if any exist).
        Calls the corresponding API endpoint to fetch data based on filter validations.
        Passes the data to the appropriate child component for rendering.
        Handles errors.
        Function to open the alert modal (child component) according to the information of each order.

        Returns the current filters to use the batch number to filter the search in the ViewOrder child component
        Returns the order information (if it exists)
        Search function to fetch the data and display it in the table
        Method to open the alert buyer modal
        Method to retrieve the specific information of an order and display it in its corresponding modal
        Method to retrieve the specific information of a customer and display it in its corresponding modal
        Logout method
    */

    import axios from 'axios'
    import SearchFilters from './SearchFilters.vue'
    import OrdersTable from './OrdersTable.vue'
    import AlertModal from './AlertModal.vue'
    import ViewOrder from './ViewOrderComponent.vue'
    import DetailCustomer from './ViewCustomerComponent.vue'

    export default {
        props: {
            user:Object
        },
        components:{
            SearchFilters,
            OrdersTable,
            AlertModal,
            ViewOrder,
            DetailCustomer
        },
        data(){
            return{
                currentFilters: null,
                orders:[],
                loading:false,
                error:null,
                success: null,
                selectedOrder:null,
                showAlertModal:false,
                showViewOrderModal:false,
                showViewCustomerModal:false,
            }
        },

        methods:{
            async searching(filters){

                this.currentFilters = filters
                this.loading = true
                this.orders = []
                this.error = null

                try{

                    const response = await axios.get('/api/medications/search',{
                        params:{
                            lot: filters.lot,
                            start_date: filters.start_date,
                            end_date: filters.end_date
                        }
                    })

                    this.orders = response.data.data
                    
                    if(response.data.message){
                        this.error = response.data.message
                    }

                }catch(error){
                    this.error = 'Error retrieving data'
                }finally{
                    this.loading = false
                }
            },
            openAlertModal(order){
                this.selectedOrder = order
                this.showAlertModal = true
            },
           async openViewOrderModal(order){
                
                this.id_order = order
                this.error = null

                try {
                    const responseOrder = await axios.get(`/api/orders/${this.id_order}/${this.currentFilters.lot}`)
                    this.selectedOrder = responseOrder.data.order
                    this.showViewOrderModal = true

                } catch (error) {
                    if (responseOrder.data.message) {
                        this.error = responseOrder.data.message
                    }
                }
            },
            async openViewCustomerModal(order){
                this.id_customer = order
                this.error = null
                
                try {
                    const responseCustomer = await axios.get(`/api/customers/${this.id_customer}`)

                    this.selectedOrder = responseCustomer.data.customer
                    this.showViewCustomerModal = true

                } catch (error) {
                    if (responseCustomer.data.message) {
                        this.error = responseCustomer.data.message
                    }
                }
                
            },
            async logout(){
                await axios.post('/logout')
                window.location.assign('/pharmacovigilance/login')
            }
        }
    }
</script>