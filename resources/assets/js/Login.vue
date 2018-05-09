<template>
    <el-form ref="AccountForm" :model="AccountForm" :rules="rules" label-position="left" label-width="0px"
    class="demo-ruleForm login-container">
        <h3 class="title">管理员登录</h3>
        <el-form-item prop="account_number">
            <el-input type="text" v-model="AccountForm.account_number" auto-complete="off" placeholder="账号"></el-input>
        </el-form-item>
        <el-form-item prop="password">
            <el-input type="password" v-model="AccountForm.password" auto-complete="off" placeholder="密码"></el-input>
        </el-form-item>
        <el-checkbox v-model="checked" checked class="remember">记住密码</el-checkbox>
        <el-form-item style="width: 100%;">
            <el-button type="primary" style="width: 100%;" @click.native.prevent="handleLogin('AccountForm')" :loading="loading">登录</el-button>
        </el-form-item>
    </el-form>
</template>

<script>
    export default {
        data(){
            return{
                loading:false,
                AccountForm:{
                    account_number:'admin',
                    password:'123456'
                },
                rules:{
                    account_number:[
                        {required:true,message:'请输入账号',trigger:'blur'}
                    ],
                    password:[
                        {required:true,message:'请输入密码',trigger:'blur'}
                    ]
                },
                checked:true,
            };
        },
        methods:{
            handleLogin(FormName){
                let that = this;
                that.$refs[FormName].validate((valid)=>{
                    if(valid){
                        that.loading = true;
                        // let loginParams = {account_number:that.account.username,password:that.account.password};
                        axios.post('/admin/login',that.AccountForm).then(function (response) {
                            that.loading = false;
                            if(response && response.data){
                                // localStorage.setItem('access-user',JSON.stringify(response.data));
                                that.$message.success({showClose:true,message:response.data,duration:2000});
                                that.$router.push({path:'/home'});
                            }else{
                                that.$message.error({showClose:true,message:'登录失败',duration:2000});
                            }
                        },function (err) {
                            that.loading = false;
                            that.$message.error({showClose:true,message:err.response.data,duration:2000});
                        }).catch(function (error) {
                            that.loading = false;
                            that.$message.error({showClose:true,message:'请求出现异常',duration:2000});
                        });
                    }else{
                        that.$message.error({showClose:true,message:'请确保数据填写完整再提交!',duration:2000});
                    }
                });
            }
        }
    }
</script>
<style>
    body{
        background: #DFE9FB;
    }
</style>
<style lang="scss" scoped>
    .login-container{
        -webkit-border-radius: 5px;
        border-radius: 5px;
        -moz-border-radius: 5px;
        background-clip: padding-box;
        margin: 160px auto;
        width: 350px;
        padding: 35px 35px 15px 35px;
        background: #fff;
        border: 1px solid #eaeaea;
        box-shadow: 0 0 25px #cac6c6;

        background: -ms-linear-gradient(top,#ace,#00C1DE);/*IE 10*/
        background: -moz-linear-gradient(top,#ace,#00C1DE);/*谷歌*/
        background: -webkit-gradient(linear,0% 0%,0% 100%,from(#ace),to(#00C1DE));/*谷歌*/
        background: -moz-linear-gradient(top,#ace,#00C1DE);
        background: -o-linear-gradient(top,#ace,#00C1DE);
        
        .title{
            margin: 0px auto 40px auto;
            text-align: center;
            color: #505458;
        }

        .remember{
            margin: 0px 0px 35px 0px;
        }
    }
</style>