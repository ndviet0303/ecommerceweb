const admin = [
    {
        path: "/admin",
        component: () => import("../../layouts/admin.vue"),
        children: [
            {
                path: "users",
                name: "admin.users",
                component: () => import("../../pages/admin/users/index.vue"),
            }
        ]
    }
]

export default admin;