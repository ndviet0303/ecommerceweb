const product_details = [
    {
        path: "/product",
        component: () => import("../../../layouts/default.vue"),
        children: [
            {
                path: "detail/:id",
                name: "product.detail",
                component: () => import("../../../pages/users/product/detail.vue"),
            },
        ]
    },
]

export default product_details;