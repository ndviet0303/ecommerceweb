const admin = [
    {
        path: "/admin",
        component: () => import(/* webpackChunkName: "admin" */"../../layouts/admin.vue"),
        children: [
            {
                path: "users",
                name: "admin.users",
                component: () => import(/* webpackChunkName: "admin" */"../../pages/admin/users/index.vue"),
            }
        ]
    }
]

export default admin;