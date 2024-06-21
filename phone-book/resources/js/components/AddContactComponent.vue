<template>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Add New Contact</h1>
                <button type="button" class="btn-close" @click="closeModal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form @submit.prevent="handleSubmit">
                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" class="form-control" v-model="form.name" required />
                        <div v-if="errors.name">
                            <span class="text-danger">{{ errors.name[0] }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Contact Number:</label>
                        <input type="text" class="form-control" v-model="form.contact_number" required />

                        <div v-if="errors.contact_number">
                            <span class="text-danger">{{ errors.contact_number[0] }}</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="closeModal">Close</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import '@fortawesome/fontawesome-free/css/all.css';
import axios from 'axios';

export default {
    data() {
        return {
            form: {
                name: '',
                contact_number: '',
            },
            errors: {},
        };
    },
    methods: {
        closeModal() {
            this.$emit('close');
        },
        async handleSubmit() {
            try {
                const vm = this;
                const response = await axios.post('http://localhost:8000/api/new_contact', this.form);
                console.log('Response:', response.data);
                alert("Contact added successfully!");
                location.reload();

            } catch (error) {
                if (error.response && error.response.data && error.response.data.errors) {
                    this.errors = error.response.data.errors;
                } else {
                    console.error('Error:', error);
                }
            }
        },
    },
    mounted() {
        console.log('Component mounted.');
    },
};
</script>
