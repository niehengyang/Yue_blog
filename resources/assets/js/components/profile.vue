<template>
    <el-row class="warp">
        <el-col :span="24" class="warp-breadcrum" :loading="loading">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item :to="{path: '/home'}"><b>首页</b></el-breadcrumb-item>
                <el-breadcrumb-item >设置</el-breadcrumb-item>
                <el-breadcrumb-item>个人信息</el-breadcrumb-item>
            </el-breadcrumb>
        </el-col>

        <el-col :span="24" v-loading="loading" class="warp-main" style="padding-top: 20px;">
            <el-form ref="userform" :model="userform" :rules="rules" label-width="80px">
                <el-form-item label="账号">
                    <el-input size="small" v-model="userform.username" disabled></el-input>
                </el-form-item>
                <el-form-item prop="nickname" label="昵称">
                    <el-input maxlength="50" size="small" v-model="userform.nickname"></el-input>
                </el-form-item>
                <el-form-item prop="name" label="姓名">
                    <el-input  maxlength="50" size="small" v-model="userform.name"></el-input>
                </el-form-item>
                <el-form-item prop="email" label="邮箱">
                    <el-input  maxlength="200" size="small" v-model="userform.email"></el-input>
                </el-form-item>
                <el-form-item>
                    <el-button size="small" type="primary" @click="handleSaveProfile">修改并保存</el-button>
                </el-form-item>
            </el-form>
        </el-col>
    </el-row>
</template>

<script>
    export default {
        data(){
            return{
                loading:false,
                userform:{
                    username:'',
                    nickname:'',
                    name:'',
                    email:''
                },
                rules:{
                    nickname:[
                        {required:true,message:'请输入昵称',trigger:'blur'}
                    ],
                    email:[
                        {required:true,message:'请输入邮箱',trigger:'blur'},
                        {type:'email',message:'请输入正确的邮箱地址',trigger:'blur,change'}
                    ]
                }
            }
        },
        create(){
            console.log('页面建立的时候执行此函数');
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
                            that.userform = response.data;
                            console.log('获取到的'+response.data);
                        }else{
                            that.$message.error({showClose:true,message:'信息获取失败！',duration:2000});
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
            handleSaveProfile(){
                let that =this;
                that.$confirm('是否修改该用户信息？','提示',{
                    confirmButtonText:'确定',
                    cancelButtonText:'取消',
                    type:'warning'
                }).then(()=>{
                    that.$refs.userform.validate((valid)=>{
                    if(valid){
                        that.loading = true;
                        let args = {
                            id:that.userform.id,
                            nickname: that.userform.nickname,
                            name:that.userform.name,
                            email:that.userform.email
                        };
                        axios.post('/admin/updateUserInfo',args)
                            .then(function (response) {
                                that.loading = false;
                                if (response && response.data){
                                    // let user = JSON.parse(window.localStorage.getItem('access-user'));
                                    // user.nickname = that.userform.nickname;
                                    // user.name = that.userform.name;
                                    // user.email = that.userform.email;
                                    // localStorage.setItem('access-user',JSON.stringify(user));
                                    // bus.$emit('setNickName',that.userform.nickname);
                                    that.$message.success({showClose:true,message:response.data,duration:2000});
                                }
                            },function (err) {
                                that.loading = false;
                                that.$message.error({showClose:true,message:err.response.data,duration:2000});
                            }).catch(function (error) {
                            that.loading = false;
                            if(error == 'Unauthenticated.'){
                                window.location.href('/login');
                            }
                            that.$message.error({showClose:true,message:'请求出现异常',duration:2000});
                        });
                    }else{
                        that.loading = false;
                        that.$message.error({showClose:true,message:'请保证数据填写完整在提交！',duration:2000});
                    }
                });
                }).catch(()=> {
                    console.log('已取消')
            })

            }
        },
        mounted(){
           this.LoadUserInfo();
        }
    }
</script>

<style scoped>

</style>