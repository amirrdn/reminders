import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../pages/Dashboard.vue'
import Login from '../pages/Login.vue'
import RemindersList from '../pages/reminders/Index.vue'
import RemindCreate from '../pages/reminders/Create.vue'
import RemindEdit from '../pages/reminders/Edit.vue'

const routes = [
    {
        path: '/login',
        name: 'login',
        component: Login
    },
    {
        path: '/',
        name: 'dashboard',
        component: HomeView
    },
    {
      path: '/reminders',
      name: 'reminder_index',
      component: RemindersList
    },
    {
      path: '/reminders/create',
      name: 'reminder_create',
      component: RemindCreate
    },
    {
      path: '/reminders/:id',
      name: 'reminder_edit',
      component: RemindEdit
    }
  ]
  
  //create router
  const router = createRouter({
    history: createWebHistory(),
    routes  // config routes
  })
  export default router