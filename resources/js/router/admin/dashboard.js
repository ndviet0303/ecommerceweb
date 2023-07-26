const admin = [
    {
        path: "/admin",
        component: () => import("../../layouts/admin.vue"),
        children: [
            {
                path: "dashboard",
                name: "admin.dashboard",
                component: () => import(/* webpackChunkName: "admin" */"../../pages/admin/dashboard.vue"),
                meta: { requiresRole: true }
            }
        ]
    }
]

export default admin;