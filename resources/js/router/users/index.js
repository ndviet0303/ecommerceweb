const user = [
    {
        path: "/",
        component: () => import("../../layouts/users/index.vue"),
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
