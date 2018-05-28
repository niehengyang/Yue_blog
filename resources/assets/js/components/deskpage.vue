<template>
    <el-row class="warp">
        <el-col :span="24" class="warp-breadcrum" :loading="loading">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item :to="{path: '/home'}"><b>首页</b></el-breadcrumb-item>
                <el-breadcrumb-item >页面设计</el-breadcrumb-item>
                <el-breadcrumb-item>前台页面</el-breadcrumb-item>
            </el-breadcrumb>
        </el-col>

        <el-col :span="24" v-loading="loading" class="warp-tool" element-loading-text="拼命加载中" style="padding: 20px 0 0 20px;">
            <!--头部工具条-->
            <el-col :span="24" class="toolbar" style="padding-bottom: 0px;">
                <el-row>
                    <el-button v-if="webSiteForm.web_release_size" size="small" class="fa fa-window-close" type="danger" @click="isdownwebsite()" plain>&nbsp;关闭站点</el-button>
                    <el-button v-else size="small" class="fa fa-window-close" type="success" @click="isdownwebsite()" plain>&nbsp;开启站点</el-button>
                </el-row>
            </el-col>
        </el-col>

        <!--网站表单-->
        <el-col :span="24" class="warp-main" style="padding-top: 20px;">
            <el-form :model="webSiteForm" :rules="rules" ref="webSiteForm" label-width="100px" class="web_ruleForm">
                <!--<el-form-item label="主题图片" prop="top_image">-->
                    <!--<el-input class="input_style" size="small" v-model="webSiteForm.top_image"></el-input>-->
                <!--</el-form-item>-->
                <!--<el-form-item label="顶部图片：" prop="top_image">-->
                    <!--<el-upload-->
                            <!--class="avatar-uploader"-->
                            <!--action="/admin/uploadfile"-->
                            <!--:show-file-list = "false"-->
                            <!--:on-success="handleSuccess"-->
                            <!--:before-upload="handleBefore"-->
                            <!--:on-error="uploadError">-->
                        <!--<img v-if="imageUrl" :src="imageUrl" class="avatar" title="点击图片更换" alt="点击图片更换">-->
                        <!--<i v-else class="el-icon-plus avatar-uploader-icon"></i>-->
                    <!--</el-upload>-->
                    <!--&lt;!&ndash;<el-button v-if="imageUrl" class="delete_picture" @click="delete_picture" title="删除图片" style="margin-top: 30px;">删除图片</el-button>&ndash;&gt;-->
                <!--</el-form-item>-->
                <el-form-item label="网站标题" prop="web_title">
                    <el-input type="" class="input_style" size="small" v-model="webSiteForm.web_title" onkeyup="this.value=this.value.replace(/\s/g,'&nbsp')"></el-input>
                </el-form-item>
                <el-form-item label="网站欢迎语" prop="web_speak">
                    <el-input class="input_style" size="small" v-model="webSiteForm.web_speak" onkeyup="this.value=this.value.replace(/\s/g,'&nbsp')"></el-input>
                </el-form-item>
                <el-form-item label="网站描述" prop="web_describe">
                    <el-input class="input_style" type="textarea" size="small" v-model="webSiteForm.web_describe" onkeyup="this.value=this.value.replace(/\s/g,'&nbsp')"></el-input>
                </el-form-item>
                <el-form-item>
                    <el-button size="small" type="primary" @click="submitForm('webSiteForm')">提交</el-button>
                </el-form-item>
            </el-form>
        </el-col>
    </el-row>
</template>

<script>
    export default {
        name: "sitemanagement",
        data(){
            return{
                loading:false,
                // imageUrl:'',
                // oldImageUrl:'',
                webSiteForm:{},
                rules:{
                    // top_image:[
                    //     {required:true,message:'请选择网站图片',trigger:'blur'}
                    // ],
                    web_title:[
                        {required:true,message:'请输入网站标题',trigger:'blur'},
                        {max:30,message:'长度最多30个字符',trigger:'blur'}
                    ],
                    web_speak:[
                        {required:true,message:'请输入网站欢迎语',trigger:'blur'},
                        {max:60,message:'长度最多60个字符',trigger:'blur'}
                    ],
                    web_describe:[
                        {required:true,message:'请输入网站描述',trigger:'blur'},
                        {max:120,message:'长度最多120个字符',trigger:'blur'}
                    ]
                }
            }
        },
        created:function () {//初始化
            this.LoadPageInfo();
        },
        methods:{
            LoadPageInfo(){
                let that = this;
                that.loading = true;
                axios.get('/admin/getdeskpageinfo')
                    .then(function (response) {
                        that.loading = false;
                        if (response && response.data){
                            that.webSiteForm = response.data;
                            that.imageUrl = response.data.top_image;
                            console.log('获取到的'+response.data);
                        }else{
                            that.$message.error({showClose:true,message:'操作异常!',duration:2000});
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
            submitForm(FormName){
                let that = this;
                that.$refs[FormName].validate((valid) =>{
                    if(valid){
                        that.loading = true;
                        axios.post('/admin/deskpageupdate',that.webSiteForm)
                            .then(function (response) {
                                that.loading = false;
                                if (response && response.data){
                                    that.$message.success({showClose:true,message:response.data,duration:2000});
                                }else{
                                    that.$message.error({showClose:true,message:'操作异常!',duration:2000});
                                }
                            },function (err) {
                                that.loading = false;
                                that.$message.error({showClose:true,message:err.response.data,duration:2000});
                            }).catch(function (error) {
                            that.loading = false;
                            console.log(error);
                            that.$message.error({showClose:true,message:'用户信息请求异常',duration:2000});
                        })
                    }else{
                        return false;
                    }
                });
            },
            // handleSuccess(response,res,file){//上传成功
            //     let that = this;
            //     that.imageUrl = response.url;
            //     that.replace_picture();
            //     console.log('上传成功返回图片信息',response);
            // },
            // handleBefore(file){//上传限制条件
            //     let that = this;
            //     that.oldImageUrl = that.imageUrl;
            //     const isJPG = file.type === 'image/jpeg';
            //     const isLt20M = file.size /1024/1024 < 20;
            //     if (!isJPG){
            //         that.$message.error({showClose:true,message:'上传图片只能是JPG格式!'});
            //     }
            //     if (!isLt20M){
            //         that.$message.error({showClose:true,message:'删除图片大小不能超过20MB！'});
            //     }
            //     return isJPG && isLt20M;
            //
            // },
            // replace_picture(){
            //     let that = this;
            //     if (that.oldImageUrl){
            //         let picture_name = that.oldImageUrl.substring(9);
            //         that.loading = true;
            //         axios.post('/admin/deletepicture',{name:picture_name})
            //             .then(function (response) {
            //                 that.loading = false;
            //                 if (response && response.data){
            //                     that.$message.success({showClose:true,message:'图片已替换!',duration:2000});
            //                 }
            //             },function (err) {
            //                 that.loading = false;
            //                 that.$message.error({showCLose:true,message:'替换出错!',duration:2000});
            //             }).catch(function (error) {
            //             that.loading = false;
            //             that.$message.error({showClose:true,message:'请求出现异常!',duration:2000});
            //         })
            //     }
            // },
            // uploadError(response,file,fileList){//上传失败
            //     console.log('上传失败，请重试!')
            // },
            isdownwebsite(){
                let that = this;
                if(that.webSiteForm.web_release_size){
                    that.$confirm('确定关闭用户网站？','提示',{
                        confirmButtonText:'确定',
                        cancelButtonText:'取消',
                        type:'warning'
                    }).then(()=>{
                        that.loading = true;
                        that.webSiteForm.web_release_size = 0;
                        axios.post('/admin/isdownwebsite',that.webSiteForm)
                            .then(function (response) {
                                that.loading = false;
                                if (response && response.data){
                                    that.$message.success({showClose:true,message:response.data,duration:2000});
                                }else{
                                    that.$message.error({showClose:true,message:'操作异常!',duration:2000});
                                }
                            },function (err) {
                                that.loading = false;
                                that.webSiteForm.web_release_size = 1;
                                that.$message.error({showClose:true,message:err.response.data,duration:2000});
                            }).catch(function (error) {
                            that.loading = false;
                            that.webSiteForm.web_release_size = 1;
                            console.log(error);
                            that.$message.error({showClose:true,message:'用户信息请求异常',duration:2000});
                        })
                            }).catch(()=> {
                        console.log('已取消')
                })
            }else{
                    that.$confirm('确定开启用户网站？','提示',{
                        confirmButtonText:'确定',
                        cancelButtonText:'取消',
                        type:'warning'
                    }).then(()=>{
                        that.loading = true;
                    that.webSiteForm.web_release_size = 1;
                    axios.post('/admin/isdownwebsite',that.webSiteForm)
                        .then(function (response) {
                            that.loading = false;
                            if (response && response.data){
                                that.$message.success({showClose:true,message:response.data,duration:2000});
                            }else{
                                that.$message.error({showClose:true,message:'操作异常!',duration:2000});
                            }
                        },function (err) {
                            that.loading = false;
                            that.webSiteForm.web_release_size = 0;
                            that.$message.error({showClose:true,message:err.response.data,duration:2000});
                        }).catch(function (error) {
                        that.loading = false;
                        that.webSiteForm.web_release_size = 0;
                        console.log(error);
                        that.$message.error({showClose:true,message:'用户信息请求异常',duration:2000});
                    })
                }).catch(()=> {
                        console.log('已取消')
                })
                }
            }
        }
    }
</script>

<style scoped>
    /*图片框样式*/
    .avatar-uploader .el-upload{
        border:1px dashed #d9d9d9;
        border-radius: 6px;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .avatar-uploader .el-upload:hover{
        border-color: #409EFF;
    }

    .avatar-uploader-icon{
        font-size: 28px;
        color: #8c939d;
        width: 178px;
        height: 178px;
        line-height: 178px;
        text-align: center;
        border: 1px dashed #d4d4d4;
        border-radius: 6px;
    }

    .avatar{
        width: 500px;
        height: 330px;
        display: block;
    }
    /*输入框样式*/
    .input_style{
        width: 500px;
    }
</style>