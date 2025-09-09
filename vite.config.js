import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/auth/sing_up.css",
                "resources/css/auth/login.css",
                "resources/css/pages/dashboard/dashboard.css",
                "resources/css/pages/clients/clients.css",
                "resources/css/pages/clients/add_client.css",
                "resources/css/pages/items/items.css",
                "resources/css/pages/items/category.css",
                "resources/css/pages/items/sub_category.css",
                "resources/css/pages/items/edit_category.css",
                "resources/css/pages/items/add_item.css",
                "resources/css/pages/reports/reports.css",
                "resources/css/pages/invoices/create.css",
                "resources/css/pages/invoices/detail.css",
                "resources/css/pages/invoices/list.css",
                "resources/css/cart/cartitems.css",
                "resources/css/cart/favouret.css",
                "resources/css/cart/show_in_cart.css",
                "resources/css/cart/single_item_show.css",
                "resources/css/cart/profile.css",
                "resources/css/cart/check_out.css",
                "resources/css/cart/thanks.css",
                "resources/css/enduser/login_page.css",
                "resources/css/enduser/singup_page.css",
                "resources/js/cart/show_in_cart.js",
                "resources/js/cart/check_out.js",
                "resources/js/cart/favouret.js",
                "resources/js/cart/single_remove_favouret.js",
                "resources/js/items/add_item.js",
                "resources/js/items/edit_item.js",
                "resources/js/items/add_category.js",
                "resources/js/items/sub_category.js",
                "resources/js/auth/sing_up.js",
                "resources/js/app.js",
                "resources/js/dashboard.js",
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
