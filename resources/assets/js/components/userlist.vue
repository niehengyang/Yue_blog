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
                    <el-input v-model="filters.nickname" placeholder="昵称查找" size="small" style="min-width: 240px;" @keyup.enter.native="handleSearch" @change="flashpage"></el-input>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" size="small" @click="handleSearch">查询</el-button>
                </el-form-item>
                </el-form>
            </el-col>

            <!--列表-->
            <el-table :data="users" highlight-current-row v-loading="loading" style="width: 100%;">
                <el-table-column type="index" width="60"></el-table-column>
                <el-table-column prop="nickname" width="200" label="昵称"></el-table-column>
                <el-table-column prop="username" width="100" label="账号"></el-table-column>
                <el-table-column prop="email" width="250" label="登录邮箱"></el-table-column>
                <!--<el-table-column prop="password" width="200" label="密码"></el-table-column>-->
                <el-table-column prop="admin_lastlogintime" width="200" label="最后登录时间"></el-table-column>
                <el-table-column prop="admin_lastloginip" width="200" label="最后登录ip"></el-table-column>
                <el-table-column fixed="right" width="200" label="操作">
                    <template slot-scope="scope">
                        <el-button @click="handleview(scope.row)" type="text" size="small">查看</el-button>
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

        <!--查看-->
        <el-dialog title="账户信息" :visible.sync="previewVisible" :close-on-click-model="false" :fullscreen="false">
            <div class="preview_item">
                <el-col class="warp_main" :span="10" :offset="6">
                    <div class="show_box">
                    <div class="username_item">
                        <span><b>用户名：</b></span>
                        <span class="username" v-html="user_info.username"></span>
                    </div>
                    <div class="nickname_item">
                        <span><b>昵称：</b></span>
                        <span class="nickname" v-html="user_info.nickname"></span>
                    </div>
                    <div class="name_item">
                        <span><b>姓名：</b></span>
                        <span class="name" v-html="user_info.name"></span>
                    </div>
                    <div class="email_item">
                        <span><b>邮箱：</b></span>
                        <span class="email" v-html="user_info.email"></span>
                    </div>
                    <div class="latloginip_item">
                        <span><b>最后登录IP：</b></span>
                        <span class="lastloginip" v-html="user_info.admin_lastloginip"></span>
                    </div>
                    <div class="lastlogintime_item">
                        <span><b>最后登录时间：</b></span>
                        <span class="lastlogintime" v-html="user_info.admin_lastlogintime"></span>
                    </div>
                    </div>
                </el-col>
                <div slot="footer" class="dialog-footer" style="padding-top: 10px;">
                    <el-button @click.native="previewVisible = false">关闭</el-button>
                </div>
            </div>
        </el-dialog>
    </el-row>
</template>

<script>
    export default {
        name: "userlist",
        data(){
            return{
                filters:{
                    nickname:''
                },
                users:[],
                previewVisible:false,
                user_info:{},
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
                  nickname:that.filters.nickname
              };
              that.loading = true;
              axios.get('/admin/getUserList',{params:params})
                  .then(function (response) {
                    that.loading = false;
                    if(response && response.data['data']){
                        console.log(response);
                        that.total = response.data['total'];
                        that.users = response.data['data'];
                        // that.current_page = response.data['current_page'];
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
            //查看账户
            handleview(row){
                this.previewVisible = true;
                this.user_info = row;
                // window.open('http://yue_blog.com/admin/index#/articleview')
                // this.$router.push({name:'articleview',params:{row}});
                console.log(row);
            },
            //删除账户
            handleDel(row){
                let that = this;
                let userId = row.id;
                that.$confirm('是否删除该账户？','提示',{
                    confirmButtonText:'确定',
                    cancelButtonText:'取消',
                    type:'warning'
                }).then(() => {
                    that.loading = true;
                    axios.post('/admin/deleteUser', {id:userId})
                    .then(function(response){
                        that.loading = false;
                        that.$message({
                            type:'success',
                            message:response.data,
                            center:true
                        })
                        that.flashpage();
                    },function (err) {
                        that.loading = false;
                        that.$message.error({showClose:true,message:err.response.data,duration:2000});
                        that.flashpage();
                    }).catch(function (error) {
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
                this.total = 0;
                this.currentPage = 1;
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
    .preview_item{
        width: 100%;
        display: flex;
        flex-direction: column;
        align-content: center;
        align-items: center;
        justify-content: center;
        font-family: 宋体;
    }
    .warp_main{
        width: 60%;
        border: 1px dashed #a4aaae;
        display: flex;
        flex-direction: column;
        align-content: center;
        align-items: center;
        justify-content: center;
        margin: 20px 0 0 20px;
        box-shadow: 10px 10px 10px 10px #5e5d5d;
    }
    .show_box{
        display: flex;
        flex-direction: column;
        align-content: center;
        align-items: left;
        justify-content: center;
    }
    .el-col-offset-6 {
        margin-left: unset;
    }
</style>