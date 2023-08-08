const admin = [
    {
        path: "/admin",
        component: () => import("../../layouts/admin.vue"),
        children: [
            {
                path: "license",
                name: "admin.license",
                component: () => import(/* webpackChunkName: "admin" */"../../pages/admin/license.vue"),
                meta: { requiresRole: true }
            }
        ]
    }
]

export default admin;