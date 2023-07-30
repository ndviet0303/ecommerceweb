const product = [
    {
        path: "/admin",
        component: () => import("../../layouts/admin.vue"),
        children: [
            {
                path: "product",
                name: "admin.product",
                component: () => import(/* webpackChunkName: "admin" */"../../pages/admin/product.vue"),
                meta: { requiresRole: true }
            }
        ]
    }
]

export default product;