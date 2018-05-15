<template>
    <el-row class="warp">
        <el-col :span="24" class="warp-breadcrum" :loading="loading">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item :to="{path: '/home'}"><b>首页</b></el-breadcrumb-item>
                <el-breadcrumb-item >页面设计</el-breadcrumb-item>
                <el-breadcrumb-item>图片列表</el-breadcrumb-item>
            </el-breadcrumb>
        </el-col>

        <el-col :span="24" v-loading="loading" class="warp-main" element-loading-text="拼命加载中" style="padding-top: 20px;">
            <!--头部工具条-->
            <el-col :span="24" class="toolbar" style="padding-bottom: 0px;">
                <el-row>
                    <el-button size="small" class="fa fa-plus-circle" type="success" plain>&nbsp;添加</el-button>
                    <el-button size="small" class="fa fa-pencil-square" type="primary" plain>&nbsp;修改</el-button>
                    <el-button size="small" class="fa fa-trash-o" type="danger" plain>&nbsp;删除</el-button>
                    <el-form :inline="true" :model="filters" style="float: right;">
                        <el-form-item>
                            <el-input size="small" v-model="filters.title" placeholder="文章标题" @keyup.enter.native="searchArticle" @change="flashpage"></el-input>
                        </el-form-item>
                        <el-form-item>
                            <el-button size="small" type="primary" v-on:click="searchArticle"><i class="fa fa-search"></i>&nbsp;查询</el-button>
                        </el-form-item>
                    </el-form>
                </el-row>
            </el-col>
        </el-col>

        <!--列表-->
        <el-col :span="24" class="imagelist">
            <el-row :gutter="20">
                <el-col class="show_card" :span="6" v-for="item in imageForm" :key="item.id">
                    <div class="show_box">
                        <div class="image_span" >
                            <a :href="item.img"  v-if="item.img != null"><img :src="item.img" alt="点击查看大图" title="点击查看大图"></a>
                            <span class="null_image" v-else>暂无图片</span>
                        </div>
                        <h2>
                            <a href="##" v-html="item.title"></a>
                        </h2>
                        <p>
                            <a href="#" >修改</a>
                            <a href="#" >删除</a>
                        </p>
                    </div>
                </el-col>

            </el-row>
        </el-col>

        <!--底部工具栏-->
        <el-col :span="24" class="toobar">
        <el-pagination background
                       @size-change="handleSizeChange"
                       @current-change = "handleCurrentChange"
                       :current-page="currentPage"
                       layout="prev,pager,next,jumper"
                       :total="total"
                       :page-size="pagesize"
                       style="float: right;"
        ></el-pagination>
        </el-col>
    </el-row>
</template>

<script>
    export default {
        data(){
            return{
                loading:false,
                filters:{},
                imageForm:[],
                currentPage:1,
                total:0,
                pagesize:8,
                limit:8,
            }
        },
        created(){
            console.log('页面加载前触发');
            this.searchArticle();
        },
        methods:{
            //查询
            searchArticle(){
                this.total = 0;
                this.currentPage = 1;
                this.search();
                console.log('查询')
            },
            //查询方法
            search(){
                let that =this;
                let params = {
                    page:that.currentPage,
                    limit: 8,
                    title:that.filters.title
                }
                that.loading = true;
                axios.get('/admin/getList',{params:params})
                    .then(function (response) {
                        that.loading = false;
                        if (response.data && response.data['data']){
                            that.total = response.data['total'];
                            that.imageForm = response.data['data'];
                        }
                    },function (err) {
                        that.loading = false;
                        that.$message.error({showClose:true,message:err.response.data,duration:2000});
                    }).catch(function (error) {
                    that.loading = false;
                    console.log(error);
                    if(error == 'Unauthenticated.'){
                        window.location.href('/login');
                    }
                    that.$message.error({showClose:true,message:'请求出现异常',duration:2000});
                })
            },
            //搜索框脱焦刷新
            flashpage(){
                this.searchArticle()
            },
            //分页操作
            handleSizeChange:function (val) {
                this.pagesize = val;
            },
            handleCurrentChange:function (currentPage) {
                this.currentPage = currentPage;
                this.search()
            },
        }
    }
</script>

<style scoped>
    .imagelist{
        clear: both;
        overflow: hidden;
        margin-top: 20px;
        margin-bottom: 20px;
        margin-left: 5px;
    }
    .show_card{
        width: 300px;
        height: 250px;
        border: 1px solid  #fff;
        float: left;
        cursor: pointer;
        display: flex;
        justify-content: center;
    }
    .image_span{
        width: 250px;
        height: 150px;
        margin: 8px;
        text-align: center;
        display: flex;
        justify-content: center;
    }
    .show_box img{
        width: 100%;
        height: 100%;
        border-radius: 20px;
    }
    .show_box h2{
        text-align: center;
        line-height: 5px;
        font-weight: normal;
        font-size: 9px;
    }
    p{
        text-align: center;
        margin-bottom: 0px;
        bottom:0px;
    }
    p a{
        text-align: center;
        text-decoration: none;
        color: #000;
        outline: none;
        font-size: 9px;
    }
    .null_image{
        width: 250px;
        height: 150px;
        border: 1px dashed #5e5e5e;
        text-align:center;
        border-radius: 20px;
    }

</style>