const notFound = [
    {
        path: "/:pathMatch(.*)*",
        name:'NotFound',
        component: () => import(/* webpackChunkName: "func" */"../../pages/func/404.vue"),
    },
]

export default notFound;