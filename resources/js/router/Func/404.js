const notFound = [
    {
        path: "/:pathMatch(.*)*",
        component: () => import(/* webpackChunkName: "func" */"../../pages/func/404.vue"),
    },
]

export default notFound;