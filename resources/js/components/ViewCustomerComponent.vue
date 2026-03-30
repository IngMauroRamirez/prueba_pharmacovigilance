<template>
    <div class="modal fade show d-block" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Customer Detail</h5>
                    <button type="button" class="btn-close" @click="$emit('close')"></button>
                </div>
                <div class="modal-body">
                    <ul>
                        <li><b>Id:</b> {{ customer_info.id }}</li>
                        <li><b>Name:</b> {{ customer_info.name }}</li>
                        <li><b>Email: </b> {{ customer_info.email }}</li>
                        <li><b>Phone: </b> {{ customer_info.phone }}</li>
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
            customer_info:Object
        }
    }
</script>