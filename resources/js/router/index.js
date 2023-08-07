import { createRouter, createWebHistory } from "vue-router";
import admin from './admin/dashboard.js';
import products from "./users/product/all";
import product_details from "./users/product/detail";
import notFound from "./Func/404";
import register from "./users/auth/register";
import login from "./users/auth/login";
import deposit from './Func/deposit';
import infor from './users/infor';
import changepass from './users/changepass';
import cart from './users/cart';
import product from "./admin/product";
import users from './admin/users';
import Home from './users/index.js'
import axios from 'axios';
import { useStore } from 'vuex';

const routes = [
    ...admin,
    ...product_details,
    ...notFound,
    ...products,
    ...register,
    ...login,
    ...deposit,
    ...infor,
    ...changepass,
    ...cart,
    ...product,
    ...users,
    ...Home
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

// Move the checkLogin function inside the router.beforeEach


router.beforeEach(async (to, from, next) => {
    const store = useStore();
    if (to.meta.requiresAuth) {
        const authenticated = await checkLogin();
        if (!authenticated) {
            next({ name: 'login' });
        } else {
            next();
        }
    }
    else if (to.meta.requiresRole) {
        const authenticated = await checkLogin();
        if (!authenticated) {
            next({ name: 'login' });
        } else {
            const user = store.getters['getUserData'];
            if (user.user_role >= 2) {
                next();
            }
            else {
                next({ name: 'NotFound' })
            }
        }
    }
    else if (to.meta.requiresSPRole) {
        const authenticated = await checkLogin();
        if (!authenticated) {
            next({ name: 'login' });
        } else {
            const user = store.getters['getUserData'];
            if (user.user_role >= 3) {
                next();
            }
            else {
                next({ name: 'NotFound' })
            }
        }
    }
    else {
        next();

    }

    async function checkLogin() {
        try {
            const store = useStore();
            const response = await axios.get('/api/check-login', {
                headers: {
                    Authorization: `Bearer ${store.state.token}`
                }
            });
            return response.data.authenticated;
        } catch (error) {
            store.dispatch('clearUser');
            store.dispatch('clearToken');
            router.push('/login');
            return false;
        }
    }
});

export default router;
