const register = [
    {
        path: "/",
        component: () => import("../../../layouts/default.vue"),
        children: [
            {
                path: "/login",
                name: "login",
                component: () => import("../../../pages/users/auth/login.vue"),
            }
        ]
    },
]

export default register;
