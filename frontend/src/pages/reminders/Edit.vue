<template>
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Remind Create</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><router-link :to="{
                name: 'reminder_index'
              }">Remind List</router-link></li>
              <li class="breadcrumb-item active">Remind</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
        <section class="content">
            <div class="card card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Edit</h3>
                </div>
                <Form ref="seformss" v-bind:action="action" v-bind:details="details"/>
            </div>
        </section>
    </div>
</template>
<script>
import axios from 'axios';
import Form from './Form.vue';
import { ref, onMounted, getCurrentInstance } from 'vue';
import { useRouter } from "vue-router";
import authHeader from '../../services/auth-header';

export default{
    components:{
        Form
    },
    setup(){
        const action = ref('edit');
        const router = useRouter();
        const id = router.currentRoute.value.params.id;
        const details = ref();
        const instance = getCurrentInstance()

        onMounted(() => {
            getDetail();
        });

        const getDetail = async() =>{
           
            await axios({
                method: 'get',
                url: "http://localhost/api/reminders/"+id,
                headers: authHeader(),
            }).then((response) => {
                details.value = response.data.data;
                setTimeout(() => {
                    setProps();  
                }, 800);
            })
        }
        const setProps = () => {
            instance.refs.seformss.setForm()
        }

        return{
            action,
            details
        }
    }
}
</script>