const user = [
    {
        path: "/",
        component: () => import("../../layouts/users/index.vue"),
        children: [
            {
                path: "/",
                name: "users.index",
                component: () => import("../../pages/users/index.vue"),
            }
        ]
    }
]

export default user;