const products = [
    {
        path: "/",
        component: () => import("../../../layouts/default.vue"),
        children: [
            {
                path: "/products",
                name: "products",
                component: () => import("../../../pages/users/product/all.vue"),
            },
        ]
    },
]

export default products;
