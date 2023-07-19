const user = [
    {
        path: "/",
        component: () => import("../../layouts/default.vue"),
        children: [
            {
                path: "/naptien",
                name: "deposit",
                component: () => import("../../pages/func/deposit.vue"),
            }
        ]
    }
]

export default user;
