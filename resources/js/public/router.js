import Vue from "vue";
import VueRouter from "vue-router";
Vue.use(VueRouter);
const Foo = { template: "<div>foooooooooooooooooooooooooooooooo</div>" };
const Bar = { template: "<div>baroooooooooooooooooooooooooooooo</div>" };
import ExampleComponent from "../components/ExampleComponent";
// import Home from "../components/Home";
// import Shop from '../components/public/shop/Shop'

const router = new VueRouter({
    mode: "history", //use for default # symbol remove from  url
    routes: [
        // { path: "/*", component: Home, name: "Home" },
        // { path: '/shop', component: Shop, name: 'Shop' },
        {
            path: "/r",
            component: ExampleComponent,
            name: "ExampleComponent"
        },
        { path: "/foo", component: Foo, name: "Foo" },
        { path: "/bar", component: Bar, name: "Bar" }
    ]
});
export default router;
