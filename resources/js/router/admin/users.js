const users = [
    {
        path: "/admin",
        component: () => import("../../layouts/admin.vue"),
        children: [
            {
                path: "users",
                name: "admin.users",
                component: () => import(/* webpackChunkName: "admin" */"../../pages/admin/users.vue"),
                meta: { requiresSPRole: true }
            }
        ]
    }
]

export default users;