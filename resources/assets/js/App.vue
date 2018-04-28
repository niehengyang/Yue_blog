<template>
    <el-row class="container">
        <!--头部-->
        <el-col :span="24" class="topbar-wrap">
            <div class="topbar-title">
                <span style="font-size: 18px;color: #fff;">博客后台管理系统</span>
            </div>
            <div class="topbar-btn">
                <el-dropdown trigger="click">
                    <span class="el-dropdown-link userinfo-inner">
                        <i class="fa fa-user"></i>&nbsp;&nbsp;{{nickname}}&nbsp;&nbsp;<i class="fa fa-caret-down"></i>
                    </span>
                    <el-dropdown-menu slot="dropdown">
                        <el-dropdown-item >
                            <div @click="jumpTo('/user/profile')"><span style="color: #555;font-size: 14px;">个人信息</span></div>
                        </el-dropdown-item>
                        <el-dropdown-item>
                            <div @click="jumpTo('/user/changepwd')"><span style="color: #555;font-size: 14px;">修改密码</span></div>
                        </el-dropdown-item>
                        <el-dropdown-item divided @click.native="logout">退出登录</el-dropdown-item>
                    </el-dropdown-menu>
                </el-dropdown>
            </div>
        </el-col>

        <!--中间-->
        <el-col :span="24" class="main">
            <!--左侧导航-->
            <!--<el-radio-group v-model="isCollapse" style="margin-bottom: 20px;">-->
                <!--<el-radio-button :label="false">展开</el-radio-button>-->
                <!--<el-radio-button :label="true">收起</el-radio-button>-->
            <!--</el-radio-group>-->
            <aside :class="{showSidebar:!isCollapse}">
            <div class="menu-toggle" @click.prevent="changeCollapse" >
                <i class="fa fa-exchange" v-show="!isCollapse"></i>
                <i class="fa fa-exchange" v-show="isCollapse"></i>
            </div>
                <!--导航菜单-->
            <el-menu default-active="defaultActiveIndex" class="el-menu-vertical-demo" @open="handleOpen" @close="handleClose" :collapse="isCollapse" background-color="#333744" text-color="#ffffff">
                <el-menu-item index="1" @click="jumpTo('/home')">
                    <i  class="fa fa-home"></i>
                    <span slot="title">&nbsp;&nbsp;首页</span>
                </el-menu-item>
                <el-menu-item index="2" @click="jumpTo('/userlist')">
                    <i class="fa fa-users"></i>
                    <span slot="title">&nbsp;&nbsp;用户列表</span>
                </el-menu-item>
                <el-submenu index="3">
                    <template slot="title">
                        <i class="fa fa-bars"></i>
                        <span slot="title">&nbsp;&nbsp;文章管理</span>
                    </template>
                    <el-menu-item index="3-1" @click="jumpTo('/articlelist')">文章列表</el-menu-item>
                    <el-menu-item index="3-2">文章分类</el-menu-item>
                </el-submenu>
                <el-submenu index="4">
                    <template slot="title">
                    <i class="fa fa-cog"></i>
                    <span slot="title">&nbsp;&nbsp;设置</span>
                    </template>
                    <el-menu-item index="4-1" @click="jumpTo('/user/profile')">个人信息</el-menu-item>
                    <el-menu-item index="4-2" @click="jumpTo('/user/changepwd')">修改密码</el-menu-item>
                </el-submenu>
            </el-menu>
            </aside>
            <!--右侧内容区-->
            <section class="content-container">
                <div class="grid-content bg-purple-light">
                    <el-col :span="24" class="content-wrapper">
                        <transition name="fade" mode="out-in">
                            <router-view></router-view>
                        </transition>
                    </el-col>
                </div>
            </section>
        </el-col>
    </el-row>
</template>

<script>
    export default{
        create(){
           console.log('页面建立的时候执行此函数');
        },
    data(){
        return{
            defaultActiveIndex:'0',
            userform:{},
            isCollapse: true,
            nickname:'admin'
        }
    },
        create(){
            console.log('页面建立的时候执行此函数');
            this.LoadUserInfo();
        },
        methods: {
            LoadUserInfo(){
                let that = this;
                that.loading = true;
                axios.get('/admin/getUserInfo')
                    .then(function (response) {
                        if (response && response.data){
                            that.userform = response.data;
                            console.log('获取到的'+response.data);
                        }else{
                            that.$message.error({showClose:true,message:'信息获取失败！',duration:2000});
                        }
                    }).catch(function (error) {
                    that.loading = false;
                    console.log(error);
                    that.$message.error({showClose:true,message:'用户信息请求异常',duration:2000});
                })
            },
            changeCollapse(){
                this.isCollapse = !this.isCollapse;
            },
            handleSelect(key,keyPath){
                console.log(key,keyPath);
            },
            handleOpen(key,keyPath){
              console.log(key,keyPath);
            },
            handleClose(key,keyPath){
                console.log(key,keyPath);
            },
            jumpTo(url){
                this.defaultActiveIndex = url;
                this.$router.push(url);//用go刷新
            },
            //退出登录
            logout(){
                let that = this;
                that.$confirm('是否退出系统？','提示',{
                    confirmButtonText:'确定',
                    cancelButtonText:'取消',
                    type:'warning'
                }).then(()=>{
                    axios.post('/admin/logout')
                    .then(function (response) {
                        window.location.assign('/login')
                        that.$message({
                            type:'success',
                            message:response.data,
                            center:true
                        })
                    }).catch(function (error) {
                        that.$message({
                            type:'warning',
                            message:'出问题了！',
                            center:true
                        })
                    })

            }).catch(()=>{
                    console.log('放弃退出');
            })
            },
            //获取当前用户信息
            mounted(){
                this.LoadUserInfo();
            }
        }

    }
</script>

<style scoped lang="scss">
.container{
    position: absolute;
    top:0px;
    bottom: 0px;
    width: 100%;

    .topbar-wrap{
        height: 50px;
        line-height: 50px;
        background: #373D41;
        padding:0px;
        width: 100%;
        .topbar-btn{
            color: #fff;
            padding-right: 20px;
            float: right;
            height: 50px;
        }
    }

    .topbar-title{
        float: left;
        text-align: left;
        width: 200px;
        padding-left: 10px;
        border-left: 1px solid #000;
    }

    .userinfo-inner{
        cursor: pointer;
        color: #fff;
        padding-left: 10px;
    }

    el-menu{
       height: 50px;
    }
    .el-menu-vertical-demo:not(.el-menu--collapse){
        width: 150px;
        min-height: 400px;
    }
    .line{
        width: 100%;
        border: 1px solid #adadad;
    }

    .main{
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        position: absolute;
        top: 50px;
        bottom: 0px;
        overflow: hidden;
    }
    aside{
        min-width: 50px;
        background: #333744;
        &::-webkit-scrollbar{
            display: none;
        }
        &.showSidebar{
            overflow-x: hidden;
            overflow-y: auto;
        }
    }
    .menu-toggle{
        background: #4A5064;
        text-align: center;
        color: white;
        height: 26px;
        line-height: 30px;
    }
    .content-container{
        background: #fff;
        flex: 1;
        overflow-y: auto;
        padding: 10px;
        padding-bottom: 1px;
        .content-wrapper{
            background-color: #fff;
            box-sizing: border-box;
        }
    }
}
</style>