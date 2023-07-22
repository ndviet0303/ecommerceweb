const user = [
    {
        path: "/",
        component: () => import("../../layouts/default.vue"),
        children: [
            {
                path: "/gio-hang",
                name: "cart",
                component: () => import("../../pages/users/cart.vue"),
                meta: { requiresAuth: true }
            }
        ]
    }
]

export default user;
