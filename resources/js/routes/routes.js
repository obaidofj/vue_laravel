import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import Posts from  '../components/Posts.vue';
import Test from  '../components/Test.vue';
import PostDetails from '../components/PostDetails.vue';
import CategoryPosts from '../components/CategoryPosts.vue';
import AdminIndex from '../components/admin/AdminIndex.vue';

const routes = [
    { path: '/', component: Posts, name: 'Posts' },
    { path: '/login', component: Posts, name: 'login' },
    { path: '/post/:slug', component: PostDetails, name: 'PostDetails' },
    { path: '/category/:slug/posts', component: Posts, name: 'CatPosts'  },
    // { path: '/category/:slug/posts', component: CategoryPosts, name: 'CategoryPosts'  },
    { path: '/admin', component: AdminIndex, name: 'AdminIndex' },
    { path: '/test', component: Test, name: 'test' }
];

const router = new VueRouter({
    mode: 'history',
    routes
})

export default router;