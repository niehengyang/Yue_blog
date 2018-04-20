<template>
    <el-row class="container">
        <!--头部-->
        <el-col :span="24" class="topbar-wrap">
            <div class="topbar-title">
                <span style="font-size: 18px;color: #fff;">博客后台管理系统</span>
            </div>
            <div class="topbar-account topbar-btn">
                <el-dropdown trigger="click">
                    <span class="el-dropdown-link userinfo-inner">{{nickname}}</span>
                    <el-dropdown-menu slot="dropdown">
                        <el-dropdown-item>
                            <div @click="jumpTo('')"><span style="color: #555; font-size: 14px;">个人信息</span></div>
                        </el-dropdown-item>
                        <el-dropdown-item>
                            <div @click="jumpTo('')"><span style="color: #555; font-size: 14px;">修改密码</span></div>
                        </el-dropdown-item>
                        <el-dropdown-item divided @click.native="logout">退出登录</el-dropdown-item>
                    </el-dropdown-menu>
                </el-dropdown>
            </div>
        </el-col>

        <!--中间-->
        <el-col :span="24" class="main">
            <!--左侧导航-->
            <el-radio-group v-model="isCollapse" style="margin-bottom: 20px;">
                <el-radio-button :label="false">展开</el-radio-button>
                <el-radio-button :label="true">收起</el-radio-button>
            </el-radio-group>
            <el-menu default-active="" class="el-menu-vertical-demo" @open="handleOpen" @close="handleClose" :collapse="isCollapse">
                <el-submenu index="1">
                    <template slot="title">
                        <i class="el-icon-home"></i>
                        <span slot="title">首页</span>
                    </template>
                </el-submenu>
                <el-submenu index="2">
                    <i></i>
                    <span slot="title">用户列表</span>
                </el-submenu>
            </el-menu>
            <!--右侧内容区-->
            <section class="content-container">
                <div class="grid-content bg-purple-light">
                    <el-col :span="24" class="content-wrapper">
                        <transition name="fade" mode="out-in">
                            <router-link></router-link>
                        </transition>
                    </el-col>
                </div>
            </section>
        </el-col>
    </el-row>

</template>

<script>
    export default{
        name: 'home',
        create(){
           console.log('页面建立的时候执行此函数');
        },
    data(){
        return{
            defaultActiveIndex: '0',
            nickname: '',
            collapsed: false,
        }
    },
        methods: {
            handleSelect(index){
                this.defaultActiveIndex = index;
            },
            collapse:function(){
                this.collapsed = !this.collapsed
            },
            jumpTo(url){
                this.defaultActiveIndex = url;
                this.$router.push(url);//用go刷新
            },
            logout(){
                let self =this;
                console.log('退出登录');
            },
            mounted(){
                let user = localStorage.getItem('access-user');
                if (user){
                    user = JSON.parse(user);
                    this.nickname = user.nickname || '';
                }
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
    }
    .topbar-btn{
        color: #fff;
    }

    .topbar-title{
        float: left;
        text-align: left;
        width: 200px;
        padding-left: 10px;
        border-left: 1px solid #000;
    }

    .topbar-account{
        float: right;
        padding-right: 12px;
    }

    .userinfo-inner{
        cursor: pointer;
        color: #fff;
        padding-left: 10px;
    }
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
            display:none;
        }

        &::showSidebar{
            overflow-x: hidden;
            overflow-y: auto;
        }

        .el-menu{
            height: 100%;
            height: -moz-calc(100% - 80px);
            height: -webkit-calc(100% - 80px);
            height: calc(100% - 80px);
            border-radius: 0px;
            background-color: #333744;
            border-right: 0px;
        }
        .el-submenu .el-menu-item{
            min-width: 60px;
        }
        .el-menu{
            width: 180px;
        }
        .el-menu-collapse{
            width: 60px;
        }

        .el-menu .el-menu-item .el-submenu .el-submenu__title{
            height: 46px;
            line-height: 46px;
        }

        .el-menu-item:hover, .el-submenu .el-menu-item:hover, .el-submenu__title:hover{
            background-color: #7ed2df;
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
            box-sizing:border-box;
        }
    }

</style>