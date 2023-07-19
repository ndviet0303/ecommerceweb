import { createRouter, createWebHistory } from "vue-router";
import admin from './admin/admin.js';
import user from './users/index.js';
import products from "./users/product/all";
import product_details from "./users/product/detail";
import notFound from "./Func/404";
import register from "./users/auth/register";
import login from "./users/auth/login";
import deposit from './Func/deposit';

const routes = [...admin,
...user,
...product_details,
...notFound,
...products,
...register,
...login,
...deposit];

const router = createRouter({
    history: createWebHistory(),
    routes
});
export default router;