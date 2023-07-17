const user = [
    {
        path: "/",
        component: () => import("../../layouts/default.vue"),
        children: [
            {
                path: "/",
                name: "Home",
                component: () => import("../../pages/users/index.vue"),
            }
        ]
    }
]

export default user;
