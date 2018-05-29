<template>
    <el-row class="warp">
        <el-col :span="24" class="warp-breadcrum" :loading="loading">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item :to="{path: '/home'}"><b>首页</b></el-breadcrumb-item>
                <el-breadcrumb-item>评论管理</el-breadcrumb-item>
            </el-breadcrumb>
        </el-col>

        <el-col :span="24" class="warp-main" v-loading="loading" element-loading-text="拼命加载中" style="padding-top: 20px;">
            <!--头部工具条-->
            <!--<el-col :span="24" class="toolbar" style="padding-bottom: 0px;">-->
                <!--<el-form :inline="true" :model="filters">-->
                    <!--<el-form-item>-->
                        <!--<el-input size="small" v-model="filters.content" placeholder="评论内容 @keyup.enter.native="searchComments" @change="flashpage"></el-input>-->
                    <!--</el-form-item>-->
                    <!--<el-form-item>-->
                        <!--<el-button size="small" type="primary" v-on:click="searchComments"><i class="fa fa-search"></i>&nbsp;查询</el-button>-->
                    <!--</el-form-item>-->
                <!--</el-form>-->
            <!--</el-col>-->

            <!--列表-->
            <el-table :data="commentsForm" highlight-current-row @selection-change="selsChange" style="width: 100%;">
                <el-table-column type="selection" width="55"></el-table-column>
                <el-table-column prop="article_title" label="文章" width="200"></el-table-column>
                <el-table-column prop="comment_content" label="内容" width="200"></el-table-column>
                <el-table-column prop="nickname" label="昵称" width="150"></el-table-column>
                <el-table-column prop="email" label="邮箱" width="200"></el-table-column>
                <el-table-column prop="release_size" label="状态" width="100">
                    <template slot-scope='scope'>
                        {{scope.row.release_size? '显示':'禁用'}}
                    </template>
                </el-table-column>
                <el-table-column prop="created_at" label="评论时间" width="200"></el-table-column>
                <el-table-column label="操作" width="150" fixed="right">
                    <template slot-scope="scope">
                        <el-button v-if="scope.row.release_size" size="mini" @click="disableComments(scope.row)" class="fa fa-eye-slash" title="禁用"></el-button>
                        <el-button v-else size="mini" @click="disableComments(scope.row)" class="fa fa-eye" title="显示"></el-button>
                        <el-button size="mini" type="danger" @click="delComments(scope.row)" class="el-icon-delete" title="删除"></el-button>
                    </template>
                </el-table-column>
            </el-table>

            <!--底部工具栏-->
            <el-col :span="24" class="toobar">
                <el-button type="danger" size="small" @click="batchDeletecomments" :disabled="this.sels.length===0"><i class="fa fa-trash-o"></i>&nbsp;批量删除</el-button>
                <el-button type="primary" size="small" :disabled="this.sels.length===0"><i class="fa fa-eye-slash"></i>&nbsp;批量禁用</el-button>
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
                    content:''
                },
                commentsForm:[],
                currentPage:1,
                total:0,
                pagesize:7,
                limit:7,
                sels:[]//列表选中列
            }
        },
        created:function(){
            this.searchComments()
        },
        methods:{
            //获取评论列表
            searchComments(){
                this.total = 0;
                this.currentPage = 1;
                this.search();
                console.log('查询')
            },
            //查找
            search(){
                let that = this;
                let params = {
                    page:that.currentPage,
                    limit: 7,
                    comment_content: that.filters.content
                }
                that.loading = true;
                axios.get('/admin/commentslist',{params:params})
                    .then(function (response) {
                        that.loading = false;
                        if(response && response.data){
                            that.total = response.data['total'];
                            that.commentsForm = response.data['data'];
                        }
                    },function (err) {
                        that.loading = false;
                        taht.$message.error({showClose:true,message:err.response.data,duration:2000});
                    }).catch(function (error) {
                        that.loading = false;
                        console.log(error);
                        if(error == 'Unauthenticated.'){
                            window.location.href('/login');
                        }
                        that.$message.error({showClose:true,message:'请求出现异常',duration:2000});
                })
            },
            //多选
            selsChange(sels){
                this.sels = sels;
            },
            //禁用评论
            disableComments(row){
                // console.log(row);
                let that = this;
                if(row.release_size == 0){
                    that.$confirm('是否显示该条评论？','提示',{
                        confirmButtonText:'确定',
                        cancelButtonText:'取消',
                        type:'warning'
                    }).then(() => {
                        row.release_size = 1;
                    that.loading = true;
                    axios.post('/admin/disablecomments',row)
                        .then(function (response) {
                            that.loading = false;
                            if (response && response.data){
                                that.$message.success({showClose:true,message:response.data,duration:2000});
                            }
                            that.searchComments();
                        },function (err) {
                            that.loading = false;
                            that.$message.error({showCLose:true,message:response.data,duration:2000});
                            row.release_size = 1;
                            that.searchComments();
                        }).catch(function (error) {
                        that.loading = false;
                        if(error == 'Unauthenticated.'){
                            window.location.href('/login');
                        }
                        that.$message.error({showClose:true,message:'请求出现异常',duration:2000});
                        row.release_size = 1;
                    })
                }).catch(()=> {
                        console.log('已取消')
                })
                }else{
                that.$confirm('是否禁用该条评论？','提示',{
                    confirmButtonText:'确定',
                    cancelButtonText:'取消',
                    type:'warning'
                }).then(() => {
                    row.release_size = 0;
                    that.loading = true;
                    axios.post('/admin/disablecomments',row)
                        .then(function (response) {
                            that.loading = false;
                            if (response && response.data){
                                that.$message.success({showClose:true,message:response.data,duration:2000});
                            }
                            that.searchComments();
                        },function (err) {
                            that.loading = false;
                            that.$message.error({showCLose:true,message:response.data,duration:2000});
                            row.release_size = 1;
                            that.searchComments();
                        }).catch(function (error) {
                            that.loading = false;
                            if(error == 'Unauthenticated.'){
                                window.location.href('/login');
                            }
                            that.$message.error({showClose:true,message:'请求出现异常',duration:2000});
                            row.release_size = 1;
                    })
                }).catch(()=> {
                    console.log('已取消')
                })
                }
            },
            //删除评论
            delComments(row){
                let that = this;
                that.$confirm('是否删除该评论？','提示',{
                    confirmButtonText:'确定',
                    cancelButtonText:'取消',
                    type:'warning'
                }).then(() => {
                    that.loading = true;
                    axios.post('/admin/delcomments',row)
                        .then(function (response) {
                            if (response && response.data){
                                that.loading = false;
                                that.$message.success({showClose:true,message:response.data,duration:2000});
                            }
                            that.searchComments();
                        },function (err) {
                            that.loading = false;
                            that.$message.error({showClose:true,message:err.response.data,duration:2000});
                            that.searchComments();
                        }).catch(function (error) {
                            that.loading = false;
                            console.log(error);
                            if (error == 'Unauthenticated.'){
                                window.location.href('/login')
                            }
                            that.$message.error({showCLose:true,message:'请求出现异常',duration:2000});
                    })
                }).catch(()=> {
                    console.log('已取消')
            })
            },
            //批量删除
            batchDeletecomments(){
                let that = this;
                let ids = that.sels.map(item => item.id).toString();
                let arr_id = ids.split(",");
                that.$confirm('是否删除所选评论？','提示',{
                    confirmButtonText:'确定',
                    cancelButtonText:'取消',
                    type:'warning'
                }).then(() => {
                    that.loading = true;
                axios.post('/admin/delcomments',{id:arr_id})
                    .then(function (response) {
                        if (response && response.data){
                            that.loading = false;
                            that.$message.success({showClose:true,message:response.data,duration:2000});
                        }
                        that.searchComments();
                    },function (err) {
                        that.loading = false;
                        that.$message.error({showClose:true,message:err.response.data,duration:2000});
                        that.searchComments();
                    }).catch(function (error) {
                    that.loading = false;
                    console.log(error);
                    if (error == 'Unauthenticated.'){
                        window.location.href('/login')
                    }
                    that.$message.error({showCLose:true,message:'请求出现异常',duration:2000});
                })
            }).catch(()=> {
                    console.log('已取消')
            })

            },
            //分页操作
            handleSizeChange:function (val) {
                this.pagesize = val;
            },
            handleCurrentChange:function (currentPage) {
                this.currentPage = currentPage;
                this.search()
            },
        },
        mounted(){

        }
    }
</script>

<style scoped>

</style>