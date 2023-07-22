import { createRouter, createWebHistory } from "vue-router";
import admin from './admin/admin.js';
import user from './users/index.js';
import products from "./users/product/all";
import product_details from "./users/product/detail";
import notFound from "./Func/404";
import register from "./users/auth/register";
import login from "./users/auth/login";
import deposit from './Func/deposit';
import infor from './users/infor';
import changepass from './users/changepass';
import cart from './users/cart';
const routes = [...admin,
...user,
...product_details,
...notFound,
...products,
...register,
...login,
...deposit,
...infor,
...changepass,
...cart];

const router = createRouter({
    history: createWebHistory(),
    routes
});
async function checkLogin() {
    try {
        const token = localStorage.getItem('token');
        const response = await axios.get('/api/check-login', {
            headers: {
                Authorization: `Bearer ${token}`
            }
        });
        return response.data.authenticated;
    } catch (error) {
        return false;
    }
}
router.beforeEach(async (to, from, next) => {
    if (to.meta.requiresAuth) {
        const authenticated = await checkLogin();
        if (!authenticated) {
            next({ name: 'login' });

        }
        else {
            next();
        }
    } else {
        next();
    }
});
export default router;