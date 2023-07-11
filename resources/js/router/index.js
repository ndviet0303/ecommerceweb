import { createRouter,createWebHistory  } from "vue-router";
import admin from './admin/admin.js';
import user from './users/index.js';
const routes = [...admin,...user];

const router = createRouter({
    history: createWebHistory(),
    routes
}); 
export default router;