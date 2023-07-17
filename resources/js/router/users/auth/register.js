const register = [
    {
        path: "/",
        component: () => import("../../../layouts/default.vue"),
        children: [
            {
                path: "/register",
                name: "register",
                component: () => import("../../../pages/users/auth/register.vue"),
            }
        ]
    },
]

export default register;
