const user = [
    {
        path: "/",
        component: () => import("../../layouts/default.vue"),
        children: [
            {
                path: "/license",
                name: "license",
                component: () => import("../../pages/users/license.vue"),
            }
        ]
    }
]

export default user;
