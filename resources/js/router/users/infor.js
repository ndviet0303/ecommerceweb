const user = [
    {
        path: "/",
        component: () => import("../../layouts/default.vue"),
        children: [
            {
                path: "/thong-tin",
                name: "information",
                component: () => import("../../pages/users/info.vue"),
            }
        ]
    }
]

export default user;
