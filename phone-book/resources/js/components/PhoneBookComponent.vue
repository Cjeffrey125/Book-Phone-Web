<template>
    <div class="container">
        <Teleport to="body">
            <div v-if="openAddModal" class="modal fade show" tabindex="-1" style="display: block;">
                <AddContactComponent @close="openAddModal = false"/>
            </div>
            <div v-if="openUpdateModal" class="modal fade show" tabindex="-1" style="display: block;">
                <UpdateContactComponent :contactId="updatingContactId" @close="openUpdateModal = false"/>
            </div>
            <div v-if="openDeleteModal" class="modal fade show" tabindex="-1" style="display: block;">
                <DeleteContactComponent :contactId="deletingContactId" @close="openDeleteModal = false"/>
            </div>
        </Teleport>

        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Contacts</div>
                    <div class="card-body">
                        <div class="table-container">
                            <div class="add-container d-flex justify-content-end">
                                <button class="btn btn-success btn-sm" @click="showAddModal"><i class="fa fa-plus"></i></button>
                            </div>
            
                            <table class="table table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Name</th>
                                        <th>Contact Number</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(contacts, index) in contactList" :key="index">
                                        <td>{{ contacts.name }}</td>
                                        <td>{{ contacts.contact_number }}</td>
                                        <td>
                                       
                                            <button class="btn btn-primary btn-sm" @click="showUpdateModal(contacts.id)"> <i class="fa fa-edit"></i> </button>     

                                            <button class="btn btn-danger btn-sm" @click="showDeleteModal(contacts.id)"> <i class="fa fa-trash"></i> </button>
                                  
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import '@fortawesome/fontawesome-free/css/all.css';
import AddContactComponent from './AddContactComponent.vue';
import UpdateContactComponent from './UpdateContactComponent.vue';
import DeleteContactComponent from './DeleteContactComponent.vue';

const host = import.meta.env.VITE_PUSHER_HOST;
const port = import.meta.env.VITE_PUSHER_PORT;
const api = import.meta.env.VITE_PUSHER_API_PREFIX;


export default {
    props: {
        contacts: {
            type: Array,
            required: true
        }
    },
    components: {
        AddContactComponent,
        UpdateContactComponent,
        DeleteContactComponent,
    },
    data() {
        return {
            openAddModal: false,
            openUpdateModal: false,
            openDeleteModal: false,
            contactList: [],
            deletingContactId: null,
            updatingContactId: null,
        }
    },
    methods: {
        showAddModal() {
            this.openAddModal = true;
        },
        showUpdateModal(contactId) {
            this.updatingContactId = contactId;
            this.openUpdateModal = true;
        },
        showDeleteModal(contactId) {
            
            this.deletingContactId = contactId;
            this.openDeleteModal = true;
        },
        fetchContacts() {
            axios.get('/api/contacts')
                .then(response => {
                    let status = response.data.status;

                    if (status === 200) {
                        this.contactList = response.data.data;  
                    } else {
                        console.error('Failed to fetch contacts:', response.data.message);
                    }
                })
                .catch(error => {
                    console.error('Error fetching contacts:', error);
                });
        },
    },
    mounted() {
        this.fetchContacts();
    },

    created() {
        this.fetchContacts();
    },
}
</script>
