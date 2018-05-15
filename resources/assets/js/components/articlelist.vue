<template>
    <el-row class="warp">
        <el-col :span="24" class="warp-breadcrum" :loading="loading">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item :to="{path: '/home'}"><b>首页</b></el-breadcrumb-item>
                <el-breadcrumb-item >文章管理</el-breadcrumb-item>
                <el-breadcrumb-item>文章列表</el-breadcrumb-item>
            </el-breadcrumb>
        </el-col>

        <el-col :span="24" v-loading="loading" class="warp-main" element-loading-text="拼命加载中" style="padding-top: 20px;">
            <!--头部工具条-->
            <el-col :span="24" class="toolbar" style="padding-bottom: 0px;">
                <el-form :inline="true" :model="filters">
                    <el-form-item>
                        <el-input size="small" v-model="filters.title" placeholder="文章标题" @keyup.enter.native="searchArticle" @change="flashpage"></el-input>
                    </el-form-item>
                    <el-form-item>
                        <el-button size="small" type="primary" v-on:click="searchArticle"><i class="fa fa-search"></i>&nbsp;查询</el-button>
                    </el-form-item>
                    <el-form-item >
                        <el-button size="small" type="primary" @click="createArticle"><i class="fa fa-plus-circle">&nbsp;</i>新增</el-button>
                    </el-form-item>
                </el-form>
            </el-col>

            <!--列表-->
            <el-table :data="articles" highlight-current-row @selection-change="selsChange" style="width: 100%;">
                <el-table-column type="selection" width="55"></el-table-column>
                <el-table-column type="index" width="60"></el-table-column>
                <el-table-column type="expand">
                    <template slot-scope="scope">
                        <el-form label-position="left" inline class="demo-table-expand">
                            <el-form-item label="[文章简介]">
                                <div class="article_introduction">
                                <span><b>作者：</b>{{scope.row.author}}</span>
                                <span><b>摘要：</b>{{scope.row.abstract}}</span>
                                </div>
                            </el-form-item>
                        </el-form>
                    </template>
                </el-table-column>
                <el-table-column prop="title" label="标题" sortable ></el-table-column>
                <el-table-column prop="release_size" label="状态" width="100" sortable>
                    <template slot-scope='scope'>
                        {{scope.row.release_size? '发表':'下架'}}
                    </template>
                </el-table-column>
                <el-table-column prop="classification_name" label="分类" width="100" sortable></el-table-column>
                <el-table-column prop="created_at" label="发表日期" width="270" sortable></el-table-column>
                <el-table-column label="操作" width="300" style="float: right;">
                    <template slot-scope="scope">
                        <el-button size="mini" @click="viewArticle(scope.$index,scope.row)" class="el-icon-view" title="查看"></el-button>
                        <el-button size="mini" @click="topArticle(scope.$index,scope.row)" class="fa fa-arrow-circle-up" title="置顶"></el-button>
                        <el-button size="mini" @click="editArticle(scope.$index,scope.row)" class="el-icon-edit" title="编辑"></el-button>
                        <el-button size="mini" type="danger" @click="delArticle(scope.$index,scope.row)" class="el-icon-delete" title="删除"></el-button>
                    </template>
                </el-table-column>
            </el-table>

            <!--底部工具条-->
            <el-col :span="24" class="toobar">
                <el-button type="danger" size="small" @click="batchDeleteArticle" :disabled="this.sels.length===0"><i class="fa fa-trash-o"></i>&nbsp;批量删除</el-button>
                <el-button type="primary" size="small" @click="publishedAs" :disabled="this.sels.length===0||this.sels.length>1">发表</el-button>
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
        </el-col>
    </el-row>
</template>

<script>
    export default {
        data(){
            return{
                loading:false,
                filters:{
                    title:''
                },
                classifications:[],
                articles:[],
                currentPage:1,
                total:0,
                pagesize:7,
                limit:7,
                sels:[]//列表选中列
            }
        },
        created:function () {//初始化
            // if(this.$route.params.row != null){
            //     this.articleForm = this.$route.params.row;
            // }
            this.searchArticle()
            this.LoadClassification()
        },
        methods:{
            //获取分类信息
            LoadClassification(){
                let that = this;
                that.loading = true;
                axios.get('/admin/classificationList')
                    .then(function (response) {
                        if (response && response.data){
                            that.loading = false;
                            that.classifications = response.data;
                        }
                    },function (err) {
                        that.loading = false;
                        that.$message.error({showClose:true,message:err.repsonse.data,duration:2000});
                    }).catch(function (error) {
                    that.loading = false;
                    that.$message.error({showClose:true,message:'分类信息请求异常',duration:2000});
                })
            },
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
                    limit: 7,
                    title: that.filters.title
                }
                that.loading = true;
                axios.get('/admin/getList',{params:params})
                    .then(function (response) {
                        that.loading = false;
                        if (response.data && response.data['data']){
                            that.total = response.data['total'];
                            that.articles = response.data['data'];
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
            // //添加
            createArticle(){
                this.$router.push({path:'/createarticle'})
                console.log('添加')
            },
            //多选
            selsChange(sels){
                this.sels = sels;
            },
            //查看
            viewArticle(index,row){
                this.$router.push({name:'articleview',params:{row}});
                console.log(index,row)
            },
            //文章置顶
            topArticle(index,row){
                let that = this;
                if(row.istop){
                    that.$message.error({showClose:true,message:'此文章已经置顶',duration:2000});
                }else{
                    row.istop = true;
                    that.$confirm('是否置顶？','提示',{
                        confirmButtonText:'确定',
                        cancelButtonText:'取消',
                        type:'warning'
                    }).then(()=>{
                        that.loading = true;
                        axios.post('/admin/initArticle', row)
                            .then(function (response) {
                            that.loading = false;
                            if(response && response.data){
                                that.$message.success({showClose:true,message:response.data,duration:2000});
                                that.searchArticle();
                            }
                        },function (err) {
                            that.loading = false;
                            that.$message.error({showClose:true,message:err.response.data,duration:2000});
                            row.istop = false;
                        }).catch(function (error) {
                        that.loading = false;
                        if(error == 'Unauthenticated.'){
                            window.location.href('/login');
                        }
                        that.$message.error({showClose:true,message:'请求出现异常',duration:2000});
                        row.istop = false;
                    })
                    }).catch(()=> {
                        console.log('已取消')
                    row.istop = false;
                })
                }
                console.log(index,row)
            },
            //编辑
            editArticle(index,row){
                this.$router.push({name:'createarticle',params:{row}});
            },
            //删除
            delArticle(index,row){
                let s_img = '';
                if (row['img'] != null){
                    s_img = row['img'].substring(9);
                }
                let args = {
                    id : row.id,
                    img : s_img
                }
                let that = this;
                this.$confirm('确认删除该记录吗？','提示',{
                    confirmButtonText:'确定',
                    cancelButtonText:'取消',
                    type:'warning'
                }).then(() => {
                    that.loading = true;
                axios.post('/admin/batchDelArticle',args)
                    .then(function (response) {
                        that.loading = false;
                        if(response && response.data){
                            that.$message.success({showClose:true,message:response.data,duration:2000});
                        }
                        that.searchArticle();
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
            }).catch(() => {
                    console.log('取消删除')
            })
                // console.log(index,row)
            },
            //批量删除
            batchDeleteArticle(){
                let ids = this.sels.map(item => item.id).toString();
                let imgs = this.sels.map(item => item.img).toString();
                let array_id = ids.split(",");
                let array_img = imgs.split(",");
                array_img.forEach(function (val,index,arr) {
                    arr[index] = val.substring(9);
                });
                array_img = array_img.filter(item => item);
                let args = {
                    id : array_id,
                    img : array_img
                }
                let that = this;
                this.$confirm('确认删除选中记录吗？','提示',{
                    confirmButtonText:'确定',
                    cancelButtonText:'取消',
                    type:'warning'
                }).then(() => {
                    that.loading = true;
                    axios.post('/admin/batchDelArticle',args)
                        .then(function (response) {
                            that.loading = false;
                            if(response && response.data){
                                that.$message.success({showClose:true,message:response.data,duration:2000});
                                that.searchArticle();
                            }
                        },function (err) {
                            that.loading =  false;
                            that.$message.error({showClose:true,message:err.response.data,duration:2000});
                        }).catch(function (error) {
                            that.loading = false;
                            console.log(error);
                            if(error == 'Unauthenticated.'){
                                window.location.href('/login');
                            }
                            that.$message.error({showClose:true,message:'请求出现异常',duration:2000});
                        })
                }).catch(() => {
                    console.log('取消删除')
                })
                console.log('批量删除')
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
            //发布
            publishedAs(){
                let id = this.sels.map(item => item.id).toString();
                let that = this;
                that.$confirm('是否发布？','提示',{
                    confirmButtonText:'确定',
                    cancelButtonText:'取消',
                    type:'warning'
                }).then(() => {
                    that.loading = true;
                    axios.post('/admin/publishedarticle',{id:id})
                        .then(function (response) {
                            that.loading = false;
                            if(response && response.data){
                                that.$message.success({showClose:true,message:response.data,duration:2000});
                                that.searchArticle();
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
                }).catch(() => {
                    console.log('取消发布')
                })
            }
        },
        mounted(){

        }
    }
</script>

<style scoped>
    .demo-table-expand label{
        font-weight: bold;
        padding-right: 20px;
    }
    .article_introduction{
        padding-left: 10px;
        display: flex;
        flex-direction: column;
    }
</style>