const user = [
    {
        path: "/",
        component: () => import("../../layouts/default.vue"),
        children: [
            {
                path: "/search/:name",
                name: "search",
                component: () => import("../../pages/users/search.vue"),
            }
        ]
    }
]

export default user;
