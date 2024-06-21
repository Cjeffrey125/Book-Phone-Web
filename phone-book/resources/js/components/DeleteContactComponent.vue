<template>
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5">Delete Contact</h1>
        </div>
        <div class="modal-body">
            <p>Are you sure you want to delete this contact?</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="closeModal">Close</button>
            <button type="button" class="btn btn-danger" @click="deleteContact">Delete</button>
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
    methods: {
        closeModal() {
        this.$emit('close');
    },
    deleteContact() {
        const contactId = this.contactId;
  
        axios.delete(`/api/contacts/delete/${contactId}`)
        .then((res) => {
            let status = res.data.status;
            if (status === 200) {
                alert("Contact deleted successfully!");
                location.reload();
            } else {
                console.log('Failed to delete contact', '', 'error');
            }
        })
        .catch((error) => {
            console.log('Error deleting contact:', error.response); 
            console.error('Something went wrong', '', 'error');
        });
    }}
    };
    </script>
  
  <style scoped>
  /* Add your component-specific styles here */
  </style>
  