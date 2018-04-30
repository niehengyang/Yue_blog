<template>
    <el-row class="warp">
        <el-col :span="24" class="warp-breadcrum" :loading="loading">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item :to="{path: '/home'}"><b>首页</b></el-breadcrumb-item>
                <el-breadcrumb-item >文章管理</el-breadcrumb-item>
                <el-breadcrumb-item :to="{path: '/articlelist'}">文章列表</el-breadcrumb-item>
                <el-breadcrumb-item>{{articleForm.id ? '查看': '预览'}}文章</el-breadcrumb-item>
            </el-breadcrumb>
        </el-col>

        <!---文章页面-->
        <el-col class="warp_main">
            <div class="img-circle">
                <img :src="articleForm.img"/>
            </div>
        <div class="main">
            <div class="header">
                <span style="font-size: 30px;"><h1>{{articleForm.title}}</h1></span>
            </div>
            <div class="articleinfo_cade">
                <span class="fa fa-calendar date">{{articleForm.created_at}}</span>
            </div>
        </div>
        </el-col>
    </el-row>
</template>

<script>
    export default {
        data(){
            return{
                articleForm:{
                    title:'Caminar',
                    created_at:'2017-08-25',
                    views:1564,
                    img:'/storage/bg.jpg'
                },
                loading:false
            }
        },
        methods:{

        }
    }
</script>

<style>
    .header{
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        align-content: center;
    }
</style>