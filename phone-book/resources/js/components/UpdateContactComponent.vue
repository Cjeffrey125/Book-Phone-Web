<template>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Update Contact</h1>
                <button type="button" class="btn-close" @click="closeModal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form @submit.prevent="handleSubmit">
                    <div class="form-group">
                    <label>Name:</label>
                    <input type="text" class="form-control" v-model="updateForm.name" required />
                    <div v-if="errors.name">
                        <span class="text-danger">{{ errors.name[0] }}</span>
                    </div>
                    </div>

                    <div class="form-group">
                    <label>Contact Number:</label>
                    <input type="text" class="form-control" v-model="updateForm.contact_number" required />
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
  import axios from 'axios';
  
  export default {
    props: {
        contactId: {
            type: Number,
            required: true
      }
    },
    data() {
      return {
        updateForm: {
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
    async fetchContactDetails() {
        if (!this.contactId) {
        console.error('ContactId is null or undefined');
        return;
        }
        try {
            const response = await axios.get(`/api/contacts/${this.contactId}`);
            const contact = response.data.data;
  
            this.updateForm.name = contact.name;
            this.updateForm.contact_number = contact.contact_number;
        } catch (error) {
            console.error('Error fetching contact details:', error);
        }
    },
    async handleSubmit() {
        try {
            const response = await axios.put(`/api/contacts/update/${this.contactId}`, this.updateForm);
            console.log('Response:', response.data);
            alert("Contact updated successfully!");
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
        this.fetchContactDetails();
    },
};
  </script>
  
  <style scoped>
  
  </style>
  