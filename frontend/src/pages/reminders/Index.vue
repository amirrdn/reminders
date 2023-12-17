<template>
    <div class="content-wrapper">
        <section class="content">
            <div class="card card-solid">
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-12 d-flex align-items-stretch flex-column">
                            <div class="card bg-light d-flex flex-fill">
                                <div class="card-header text-muted border-bottom-0">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            Reminds
                                        </div>
                                        <div class="col-sm-6">
                                            <router-link :to="{
                                                name: 'reminder_create'
                                            }" class="btn btn-sm btn-primary float-right">Create</router-link>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <DataTable :value="listremind" tableStyle="min-width: 50rem">
                                        <Column field="title" header="Title"></Column>
                                        <Column field="description" header="Description"></Column>
                                        <Column field="remind_at" header="Remind">
                                            <template #body="{ data }">
                                            {{ moment(data.remind_at).format("DD MMM YYYY HH:ss") }}
                                            </template>
                                        </Column>
                                        <Column field="event_at" header="Event">
                                            <template #body="{ data }">
                                            {{ moment(data.event_at).format("DD MMM YYYY HH:ss") }}
                                            </template>
                                        </Column>
                                        <Column field="event_at" header="Event">
                                            <template #body="{ data }">
                                                <router-link :to="`/reminders/${data.id}`" class="btn btn-sm btn-primary">Edit</router-link>&nbsp;
                                                <button class="btn btn-sm btn-danger" @click="deleteData(data.id)">Delete</button>
                                            </template>
                                        </Column>
                                    </DataTable>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
</template>
<script>
    import axios from 'axios';
    import { ref, onMounted } from 'vue';
    import authHeader from '../../services/auth-header';
    import DataTable from 'primevue/datatable';
    import Column from 'primevue/column';
    import moment from 'moment'
    import { useRouter } from "vue-router";
    import Swal from 'sweetalert2'

    export default{
        name:'',
        components:{
            DataTable,
            Column
        },
        setup(){
            const listremind = ref([]);
            const currentpage = ref(1);
            const topage = ref(0);
            const totalpage = ref(0);
            const router = useRouter();
            const sitebody = document.body;

            onMounted(() => {
                getData();
            })

            const getData = async() => {
                axios.get('http://localhost/api/reminders?limit=10&page='+currentpage, {
                    headers: authHeader(),
                    params: {
                        page: currentpage,
                        limit: 10
                    }
                }).then((response) => {
                    listremind.value = response.data.data.data;
                    topage.value = response.data.data.to;
                    totalpage.value = response.data.data.total;
                }).catch((error) => {
                    if(error.response.status == 401){
                        sitebody.classList.add("login-page");
                        router.push("/login");
                    }
                });
            }
            const deleteData = async (id) => {
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete('http://localhost/api/reminders/'+id, {
                        headers: authHeader()
                    }).then((response) => {
                        getData();
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success"
                        });
                    }).catch((error) => {
                        if(error.response.status == 401){
                            sitebody.classList.add("login-page");
                            router.push("/login");
                        }
                    });
                }
                });
            }
            return{
                listremind,
                topage,
                totalpage,
                moment,
                deleteData
            }
        }
    }
</script>