const user = [
    {
        path: "/",
        component: () => import("../../layouts/default.vue"),
        children: [
            {
                path: "/doi-mat-khau",
                name: "changepass",
                component: () => import("../../pages/users/changepass.vue"),
                meta: { requiresAuth: true }
            }
        ]
    }
]

export default user;
