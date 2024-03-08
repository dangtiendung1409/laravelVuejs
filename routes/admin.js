const admin = [
    {
      path: "/admin",
        component: () => import("../resources/views/layouts/admin.vue"),
        children: [
            {
                path: "users",
                name: "admin-users",
                component: () => import("../resources/views/pages/admin/users/index.vue")
            }
        ]
    }
];
export default admin;
