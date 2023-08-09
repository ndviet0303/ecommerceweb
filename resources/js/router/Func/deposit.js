const user = [
    {
        path: "/",
        component: () => import("../../layouts/default.vue"),
        children: [
            {
                path: "/naptien",
                name: "deposit",
                component: () => import("../../pages/func/deposit.vue"),
                meta: { requiresAuth: true }
            }
        ]
    }
]

export default user;
