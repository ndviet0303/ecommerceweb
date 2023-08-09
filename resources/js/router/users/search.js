const user = [
    {
        path: "/",
        component: () => import("../../layouts/default.vue"),
        children: [
            {
                path: "/search/:id",
                name: "search",
                component: () => import("../../pages/users/search.vue"),
            }
        ]
    }
]

export default user;
