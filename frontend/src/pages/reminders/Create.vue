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
                    <h3 class="card-title">Quick Example</h3>
                </div>
                <Form v-bind:action="action"/>
            </div>
        </section>
    </div>
</template>
<script>
import Form from './Form.vue';
import { ref } from 'vue';
export default{
    components:{
        Form
    },
    setup(){
        const action = ref('create');

        return{
            action
        }
    }
}
</script>