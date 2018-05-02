<template>
    <el-row class="warp">
        <el-col :span="24" class="warp-breadcrum" :loading="loading">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item :to="{path: '/home'}"><b>首页</b></el-breadcrumb-item>
                <el-breadcrumb-item >文章管理</el-breadcrumb-item>
                <el-breadcrumb-item>文章列表</el-breadcrumb-item>
            </el-breadcrumb>
        </el-col>

        <el-col :span="24" class="warp-main" v-loading="loading" element-loading-text="拼命加载中" style="padding-top: 20px;">
            <!--头部工具条-->
            <el-col :span="24" class="toolbar" style="padding-bottom: 0px;">
                <el-form :inline="true" :model="filters">
                    <el-form-item>
                        <el-input size="small" v-model="filters.title" placeholder="文章标题" @keyup.enter.native="handleSearch" @change="flashpage"></el-input>
                    </el-form-item>
                    <el-form-item>
                        <el-button size="small" type="primary" v-on:click="handleSearch"><i class="fa fa-search"></i>&nbsp;查询</el-button>
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
                <el-table-column prop="classification" label="分类" width="100" sortable></el-table-column>
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
                articles:[],
                currentPage:1,
                total:0,
                pagesize:7,
                limit:7,
                sels:[]//列表选中列
            }
        },
        methods:{
            //查询
            handleSearch(){
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
                        if (response.status == 200){
                            that.total = response.data['total'];
                            that.articles = response.data['data'];
                        }else{
                            that.$message.error({showClose:true,message:response.data,duration:2000});
                        }
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
                console.log(index,row)
            },
            //编辑
            editArticle(index,row){
                this.$router.push({name:'createarticle',params:{row}});
                console.log(index,row.id)
            },
            //删除
            delArticle(index,row){
                let that = this;
                this.$confirm('确认删除该记录吗？','提示',{
                    type:'warning'
                }).then(() => {
                    that.loading = true;
                axios.post('/admin/batchDelArticle',{id:row.id})
                    .then(function (response) {
                        that.loading = false;
                        if(response && response.status == 200){
                            that.$message.success({showClose:true,message:response.data,duration:2000});
                            that.search();
                        }else{
                            that.$message.error({showClose:true,message:response.data,duration:2000});
                        }
                    })
                    .catch(function (error) {
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
                let that = this;
                this.$confirm('确认删除选中记录吗？','提示',{
                    type:'warning'
                }).then(() => {
                    that.loading = true;
                    axios.post('/admin/batchDelArticle',{id:ids})
                        .then(function (response) {
                            that.loading = false;
                            if(response && response.status == 200){
                                that.$message.success({showClose:true,message:response.data,duration:2000});
                                that.search();
                            }else{
                                that.$message.error({showClose:true,message:response.data,duration:2000});
                            }
                        })
                        .catch(function (error) {
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
                this.handleSearch()
            },
            //分页操作
            handleSizeChange:function (val) {
                this.pagesize = val;
            },
            handleCurrentChange:function (currentPage) {
                this.currentPage = currentPage;
                this.search()
            }
        },
        mounted(){
            this.handleSearch()
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