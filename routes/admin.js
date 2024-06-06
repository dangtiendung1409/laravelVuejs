const admin = [
    {
      path: "/admin",
        component: () => import("../resources/views/layouts/admin.vue"),
        children: [
            // quan ly user
            {
                path: "users",
                name: "admin-users",
                component: () => import("../resources/views/pages/admin/users/index.vue")
            },
            {
                path: "users/create",
                name: "admin-users-create",
                component: () => import("../resources/views/pages/admin/users/create.vue")
            },
            // quan ly role
            {
                path: "roles",
                name: "admin-roles",
                component: () => import("../resources/views/pages/admin/roles/index.vue")
            },
            // quan ly admin
            {
                path: "settings",
                name: "admin-settings",
                component: () => import("../resources/views/pages/admin/settings/index.vue")
            }
        ]
    }
];
export default admin;
