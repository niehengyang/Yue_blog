
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Vue from 'vue'
import VueRouter from 'vue-router'
import axios from 'axios'
import ElementUI from 'element-ui'
import 'font-awesome/css/font-awesome.min.css'//
import 'element-ui/lib/theme-chalk/index.css'
import VueEditor from 'vue2-editor'

import App from './App.vue'//主题框架


import index from './components/index.vue'//主页
import userlist from './components/userlist.vue'//账户列表
import profile from './components/profile.vue'//个人信息
import resetpwd from './components/resetpwd.vue'//重置密码
import articlelist from './components/articlelist.vue'//文章列表
import createarticle from './components/createarticle.vue'//创建文章
import articleview from './components/articleview.vue'//文章预览,查看
import commentslist from './components/commentslist.vue'//评论管理
import classification from './components/classification'//文章分类
import picturelist from './components/picturelist'//图片管理
import deskpage from './components/deskpage'//站点管理

Vue.use(VueRouter)
Vue.use(ElementUI)
Vue.use(VueEditor)


const router = new VueRouter({
    mode:'hash',
    routes:[
        {
            path:'/admin/home',
            component: index
        },
        {
            path:'/userlist',
            component: userlist
        },
        {
            path:'/user/profile',
            component:profile
        },
        {
            path:'/user/changepwd',
            component:resetpwd
        },
        {
            path:'/articlelist',
            component:articlelist
        },
        {
            path:'/createarticle',
            name:'createarticle',
            component:createarticle
        },
        {
            path:'/articleview',
            name:'articleview',
            component:articleview
        },
        {
            path:'/commentslist',
            component:commentslist
        },
        {
            path:'/classification',
            component:classification
        },
        {
            path:'/picturelist',
            component:picturelist
        },
        {
            path:'/deskpage',
            component:deskpage
        }
    ]
})
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

new Vue(Vue.util.extend({router},App)).$mount('#app')


// Vue.component('example', require('./components/Example.vue'));
//
// const app = new Vue({
//     el: '#app'
// });
