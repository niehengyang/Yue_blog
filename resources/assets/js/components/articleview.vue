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
        <el-col class="warp-main" :span="24" style="padding-top: 20px;">
            <!-- Header -->

        </el-col>
    </el-row>
</template>

<script>
    export default {
        name: "articleview",
        data(){
            return{
                articleForm:{},
                loading:false
            }
        }
    }
</script>

<style>
</style>