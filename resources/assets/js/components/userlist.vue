<template>
    <el-row class="warp">
        <!--面包屑-->
        <el-col :sapn="24" class="warp-breadcrum">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item :to="{path: '/home'}"><b>首页</b></el-breadcrumb-item>
                <el-breadcrumb-item>用户列表</el-breadcrumb-item>
            </el-breadcrumb>
        </el-col>

        <el-col :span="24" class="warp-main" v-loading="loading" element-loading-text="拼命加载中">
           <!--工具条-->
            <el-col :span="24" class="toolbar" style="padding-bottom: 0px; padding-top: 10px">
                <el-form :inline="true" :model="filters">
                <el-form-item>
                    <el-input v-model="filters.name" placeholder="用户名/姓名/昵称" size="small" style="min-width: 240px;" @keyup.enter.native="handleSearch" @change="flashpage"></el-input>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" size="small" @click="handleSearch">查询</el-button>
                </el-form-item>
                </el-form>
            </el-col>

            <!--列表-->
            <el-table :data="users" highlight-current-row v-loading="loading" style="width: 100%;">
                <el-table-column type="index" width="60"></el-table-column>
                <el-table-column prop="name" width="200" label="昵称"></el-table-column>
                <el-table-column prop="email" width="200" label="登录邮箱"></el-table-column>
                <el-table-column prop="password" width="200" label="密码"></el-table-column>
                <el-table-column prop="admin_lastlogintime" width="200" label="最后登录时间"></el-table-column>
                <el-table-column prop="admin_lastloginip" width="200" label="最后登录ip"></el-table-column>
                <el-table-column fixed="right" width="100" label="操作">
                    <template slot-scope="scope">
                        <el-button @click="handleEdit(scope.row)" type="text" size="small">编辑</el-button>
                        <el-button @click="handleDel(scope.row)" type="text" size="small">删除</el-button>
                    </template>
                </el-table-column>
            </el-table>
        </el-col>
        <!--分页-->
        <el-col :span="24" class="pagination">
            <el-pagination background
                           @size-change="handleSizeChange"
                           @current-change = "handleCurrentChange"
                           :current-page="currentPage"
                           layout="prev,pager,next,jumper"
                           :total="total"
                           :page-size="pagesize"
            ></el-pagination>
        </el-col>
    </el-row>
</template>

<script>
    export default {
        name: "userlist",
        data(){
            return{
                filters:{
                    name:''
                },
                users:[{
                    id:'1',
                    name:'aaa',
                    email:'NHY@163.com',
                    password:'123',
                    admin_lastlogintime:'2018-5-11',
                    admin_lastloginip:'152.155.102.0',
                    admin_status:'1',
                }],
                loading: false,
                total:0,
                currentPage:1,
                pagesize:7,
                limit:10
            }
        },
        methods:{
            handleSearch(){
                this.searchUserList();
            },
            //获取用户列表
            searchUserList:function(){
              let that = this;
              let params = {
                  page:that.currentPage,
                  limit:7,
                  name:that.filters.name
              };
              that.loading = true;
              axios.get('/admin/getUserList',{params:params})
                  .then(function (response) {
                    that.loading = false;
                    if(response.data && response.data['data']){
                        console.log(response);
                        that.total = response.data['total'];
                        that.users = response.data['data'];
                        // that.page = response.data['current_page'];
                    }
                },function (err) {
                      that.loading = false;
                      that.$message({showClose:true,message:err.response.data,duration:2000});
                  })
                  .catch(function (error) {
                      that.loading = false;
                      if(error == 'Unauthenticated.'){
                          window.location.href('/login');
                      }
                      that.$message.error({showClose:true,message:'请求出现异常',duration:2000});
                  })
            },
            //编辑账户
            handleEdit(row){
                console.log(row);
            },
            //删除账户
            handleDel(row){
                var that = this;
                that.$confirm('是否删除该账户？','提示',{
                    confirmButtonText:'确定',
                    cancelButtonText:'取消',
                    type:'warning'
                }).then(()=> {
                    that.loading =true;
                    axios.post('/admin/deleteUser',row)
                    .then(function(response){
                        that.loading = false;
                        that.$message({
                            type:'success',
                            message:response.data,
                            center:true
                        })
                    },function (err) {
                        that.loading = false;
                        that.$message.error({showClose:true,message:err.response.data,duration:2000});
                    })
                    .catch(function (error) {
                        that.loading = false;
                        that.$message.error({showClose:true,message:'提交出现错误！',duration:2000});
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
                this.handleSearch()
            },
            //刷新页面
            flashpage(){
                this.handleSearch()
            }
        },
        //进入页面加载
        mounted(){
            this.handleSearch()
        }
    }
</script>

<style scoped>
    .pagination{
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>