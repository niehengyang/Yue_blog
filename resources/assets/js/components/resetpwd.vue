<template>
    <el-row class="warp">
        <el-col :span="24" class="warp-breadcrum" :loading="loading">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item :to="{path: '/home'}"><b>首页</b></el-breadcrumb-item>
                <el-breadcrumb-item >设置</el-breadcrumb-item>
                <el-breadcrumb-item>修改密码</el-breadcrumb-item>
            </el-breadcrumb>
        </el-col>

        <el-col :span="24" v-loading="loading" class="war-main" style="padding-top: 20px;">
            <el-header height="30px">
                <span class="fa fa-key">&nbsp;修改管理员密码</span>
            </el-header>
            <el-form ref="resetPwdForm" :model="resetPwdForm" :element-loading-text="loadingText" :rules="rules" label-width="120px">
                <el-form-item label="账户名:">
                    <span>{{userInfo.account_number}}</span>
                </el-form-item>
                <el-form-item prop="oldpwd" label="原密码:">
                    <el-input class="input" maxlength="120" size="small" v-model="resetPwdForm.oldpwd" placeholder="请输入当前密码"></el-input>
                </el-form-item>
                <el-form-item prop="newpwd" label="新密码:">
                    <el-input class="input" maxlength="120" size="small" v-model="resetPwdForm.newpwd" placeholder="请输入新密码"></el-input>
                </el-form-item>
                <el-form-item prop="confirmpwd" label="确认新密码:">
                    <el-input class="input" maxlength="120" size="small" v-model="resetPwdForm.confirmpwd" placeholder="请再次输入新密码"></el-input>
                </el-form-item>
                <el-form-item>
                    <el-button class="submitbtn" size="small" type="default" @click="handleChangepwd('resetPwdForm')">提交</el-button>
                </el-form-item>
            </el-form>
        </el-col>
    </el-row>
</template>

<script>
    export default {
        data(){
            var passRepeatCheck = (rule,value,callback)=>{
                if(value != this.resetPwdForm.newpwd){
                    callback(new Error('两次输入密码不一致!'));
                }else{
                    callback();
                }
            };
            return{
                loadingText:'正在提交数据，请稍后',
                loading:false,
                resetPwdForm:{
                    oldpwd:'',
                    newpwd:'',
                    confirmpwd:''
                },
                userInfo:{},
                rules:{
                    oldpwd:[
                        {required:true,message:'请输入当前密码',trigger:'blur'},
                        {min: 6, max: 16, message: '密码必须为 6 到 16 位字符', trigger: 'blur'}
                    ],
                    newpwd:[
                        {required:true,message:'请输入新密码',trigger:'blur'},
                        {min: 6, max: 16, message: '密码必须为 6 到 16 位字符', trigger: 'blur'}
                    ],
                    confirmpwd:[
                        {required:true,message:'请再次输入新密码',trigger:'blur'},
                        {validator: passRepeatCheck,message:'两次密码输入不一致',trigger:'blur'}
                    ]
                }
            }
        },
        mounted:function (){
            this.LoadUserInfo();
        },
        methods:{
            LoadUserInfo(){
                let that = this;
                that.loading = true;
                axios.get('/admin/getUserInfo')
                    .then(function (response) {
                        that.loading = false;
                        if (response && response.data){
                            that.userInfo = response.data;
                            console.log('获取到的'+response.data);
                        }
                    },function (err) {
                        that.loading = false;
                        that.$message.error({showClose:true,message:err.response.data,duration:2000});
                    }).catch(function (error) {
                        that.loading = false;
                        console.log(error);
                        that.$message.error({showClose:true,message:'用户信息请求异常',duration:2000});
                })
            },
            handleChangepwd(FormName){
                console.log('修改密码');
                let that = this;
                that.$refs[FormName].validate((valid)=>{
                    if(valid){
                        that.loading = true;
                        let args = {
                            id: that.userInfo.id,
                            admin_newpassword : that.resetPwdForm.confirmpwd,
                            admin_password : that.resetPwdForm.oldpwd
                        }
                        axios.post('/admin/resetpwd',args)
                            .then(function (response) {
                                that.loading = false;
                                if(response && response.data){
                                    that.$message.success({showClose:true,message:response.data,duration:2000});
                                }
                            },function (err) {
                                that.loading = false;
                                that.$message.error({showClose:true,message:err.response.data,duration:2000});
                            }).catch(function (response) {
                                that.loading = false;
                                that.$message.error({showClose:true,message:response.data,duration:2000});
                            })
                    }else{
                        that.loading = false;
                        that.$message.error({showClose:true,message:'请填写完整!',duration:2000});
                    }
                });
            }
        }
    }
</script>

<style scoped>
    .input {
        width: 400px;
    }
</style>