import { createRouter,createWebHistory  } from "vue-router";
import admin from './admin/admin.js';
import user from './users/index.js';
import product_details from "./users/product/detail";
import notFound from "./Func/404";

const routes = [...admin,...user,...product_details,...notFound];

const router = createRouter({
    history: createWebHistory(),
    routes
}); 
export default router;