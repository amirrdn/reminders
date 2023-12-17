<template>
    <form @submit.prevent="SubmtiForm">
        <div class="card-body pb-0">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" v-model="vform.title" class="form-control" id="title" placeholder="Enter title">
                    </div>
                    <div class="form-group">
                        <label for="remind_at">Remind</label>
                        <Calendar v-model="vform.remind_at" style="width: 100%;" showIcon inputId="buttondisplay" />
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" v-model="vform.description" rows="3" placeholder="Enter ..."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="event_at">Event</label>
                        <Calendar v-model="vform.event_at" style="width: 100%;" showIcon inputId="buttondisplays" />
                    </div>
                    <div class="form-group">
                        <button class="btn btn-sm btn-primary float-right">{{ action == 'create' ? 'Submit' : "Update" }}</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>
<script>
    import axios from 'axios';
    import Calendar from 'primevue/calendar';
    import { ref, defineProps, useAttrs } from 'vue';
    import authHeader from '../../services/auth-header';
    import { useRouter } from "vue-router";

    export default{
        props: {
            action: String,
            details: Object
        },
        components:{
            Calendar
        },
        setup(props){
            const vform = ref({
                title: '',
                description: '',
                remind_at: '',
                event_at: ''
            });
            const sitebody = document.body;
            const router = useRouter();
            const setForm = () => {
                vform.value = props.details;
            }
            const SubmtiForm = async() => {
                if(props.action === 'create'){
                    await axios.post('http://localhost/api/reminders', vform.value, {
                        headers: authHeader()
                    })
                    .then((response) =>{
                        router.push({
                            name: 'reminder_index'
                        });
                    }).catch((error) => {
                        if(error.response.status == 401){
                            sitebody.classList.add("login-page");
                            router.push("/login");
                        }
                    });
                }else{
                    await axios.put('http://localhost/api/reminders/'+vform.value.id, vform.value, {
                        headers: authHeader()
                    })
                    .then((response) =>{
                        router.push({
                            name: 'reminder_index'
                        });
                    }).catch((error) => {
                        if(error.response.status == 401){
                            sitebody.classList.add("login-page");
                            router.push("/login");
                        }
                    });
                }
                
            }
            return{
                vform,
                SubmtiForm,
                setForm
            }
        }
    }
</script>