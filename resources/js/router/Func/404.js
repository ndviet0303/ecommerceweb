const notFound = [
    {
        path: "/:pathMatch(.*)*",
        component: () => import("../../pages/func/404.vue"),
    },
]

export default notFound;