<template>
    <div class="page">
    <el-row class="warp" style="width: 100%;">
        <el-col :span="24" class="warp-breadcrum" :loading="loading">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item :to="{path: '/home'}"><b>首页</b></el-breadcrumb-item>
                <el-breadcrumb-item >文章管理</el-breadcrumb-item>
                <el-breadcrumb-item :to="{path: '/articlelist'}">文章列表</el-breadcrumb-item>
                <el-breadcrumb-item>{{articleForm.id ? '查看': '预览'}}文章</el-breadcrumb-item>
            </el-breadcrumb>
        </el-col>
    </el-row>
        <!---文章页面-->
        <el-row class="warp_mid" type="flex" justify="center" style="">
            <el-col class="warp_main" :span="18" :offset="6">
                <div class="img-item" v-show="articleForm.img">
                    <img style="width: 100%;" :src="articleForm.img" alt=""/>
                </div>
                <div class="show_box">
                        <div class="main" v-show="articleForm.title">
                            <div class="header">
                                <span style="font-size: 30px;font-weight: bold" v-html="articleForm.title"></span>
                            </div>
                            <div class="articleinfo_cade" >
                                <span style="color: #a4aaae;" class="fa fa-calendar date" v-html="articleForm.created_at"></span>
                                <span style="color: #a4aaae;">&nbsp;·&nbsp;</span>
                                <span v-html="articleForm.classification"></span>
                            </div>
                            <div class="content_item" style="padding:20px 0 30px 30px; border-top: 1px solid #e3e3e3;">
                                <span style="color: #636b6f;" v-html="articleForm.content" alt=""></span>
                            </div>
                            <div class="author_item" style="margin-top: 10px; padding-bottom: 20px; border-bottom: 1px solid #e3e3e3;">
                                <span style="font-weight: bold; font-family: 仿宋;font-size: 2px;">发布：</span>
                                <span class="author" style="color: #a4aaae;font-size: 3px;" v-html="articleForm.author"></span>
                            </div>
                        </div>
                        <div class="err_show_box" v-show="articleForm.title === ''">
                            <span>无任何信息!</span>
                        </div>
                        <div class="footer_btn">
                            <el-button class="callback_btn" size="small" style="margin-top: 10px;" onClick="history.go(-1);">返回</el-button>
                        </div>
                </div>
            </el-col>
        </el-row>
    </div>
</template>

<script>
    export default {
        name:'articleview',
        data(){
            return{
                loading:false,
                articleForm:{
                    id: 0,
                    img:'',
                    slug:'',
                    title:'',
                    content:'',
                    classification:'',
                    release_size:false,
                    abstract:'',
                    author:'',
                    istop:false
                },
            }
        },
        created:function () {//初始化
            this.loading = true;
            if(this.$route.params.row != null){
                this.articleForm = this.$route.params.row;
            }
            console.log('接收到的:'+this.articleForm)
            this.loading = false;
        },
        methods:{

        },
        mounted(){
            // if(this.$route.params.row != null){
            //     this.articleForm = this.$route.params.row;
            // }
        }
    }
</script>

<style>
    .page{
        width: 100%;
        /*background-image: url("/storage/bg.jpg");*/
        /*background-repeat: no-repeat;*/
        /*-webkit-background-size: 100% 100%;*/
        /*background-size: 100% 100%;*/
    }
    .img-item{
        width: 100%;
        height: 400px;
        display: flex;
        justify-content: center;
    }
    .show_box{
        width: 80%;
        display:flex;
        flex-direction: column;
        justify-content: center;
        font-family: 宋体;
        margin-top: 40px;
        margin-bottom: 40px;
    }
    .header{
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        align-content: center;
    }
    .warp_main{
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        margin: 20px 0 0 20px;
        box-shadow: 10px 10px 10px 10px #5e5d5d;
        background-color: white;
    }
    .articleinfo_cade{
        padding-top: 10px;
        padding-bottom: 10px;
        display: flex;
        justify-content: center;
        font-size: 2px;
    }
    .err_show_box{
        width: 100%;
        display: flex;
        justify-content: center;
        color: #adadad;
    }
</style>