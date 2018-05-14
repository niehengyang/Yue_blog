<template>
    <el-row class="warp">
        <el-col :span="24" class="warp-breadcrum" :loading="loading">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item :to="{path: '/home'}"><b>首页</b></el-breadcrumb-item>
                <el-breadcrumb-item >文章管理</el-breadcrumb-item>
                <el-breadcrumb-item :to="{path: '/articlelist'}">文章列表</el-breadcrumb-item>
                <el-breadcrumb-item>{{articleForm.id ? '修改': '创建'}}文章</el-breadcrumb-item>
            </el-breadcrumb>
        </el-col>
        <!--创建文章-->
        <el-col class="warp-main" :span="20" v-loading="loading" style="padding: 20px 0 0 40px;">
            <el-form :model="articleForm" label-width="100px" :rules="rules" ref="articleForm" class="ruleForm">
                <el-form-item label="文章标题：" prop="title">
                    <el-input size="small" v-model="articleForm.title" auto-complate="off" placeholder="为你的文章起个标题吧！"></el-input>
                </el-form-item>
                <el-form-item label="顶部图片：" prop="img">
                    <el-upload
                            class="avatar-uploader"
                            action="/admin/uploadfile"
                            :show-file-list = "false"
                            :on-success="handleSuccess"
                            :before-upload="handleBefore"
                            :on-error="uploadError">
                        <img v-if="imageUrl" :src="imageUrl" class="avatar">
                        <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                    </el-upload>
                    <el-button class="delete_picture" @click="delete_picture" title="删除图片" style="margin-top: 30px;">删除图片</el-button>
                </el-form-item>
                <el-form-item label="文章内容：" prop="content">
                    <vue-editor v-model="articleForm.content" placeholder="在此输入文章内容" :editorToolbar="customToolbar"
                        useCustomImageHandle @imageAdded = "handleImageAdded">
                    </vue-editor>
                </el-form-item>
                <el-form-item label="文章摘要：" prop="abstract">
                    <el-input type="textarea" v-model="articleForm.abstract" maxlength="300" placeholder="文章摘要最多300字符,放空将默认提取!。"></el-input>
                </el-form-item>
                <el-form-item label="文章分类：" prop="classification_id">
                    <el-select size="small" v-model="articleForm.classification_id" placeholder="请选择文章分类">
                        <el-option
                                v-for="item in classifications"
                                :key="item.id"
                                :label="item.name"
                                :value="item.id"
                        ></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="是否置顶？" prop="istop">
                    <el-radio-group size="small" v-model="articleForm.istop">
                        <el-radio-button label=1>是</el-radio-button>
                        <el-radio-button label=0>否</el-radio-button>
                    </el-radio-group>
                </el-form-item>
                <!--<el-form-item label="文章标签：" prop=""labels>-->
                    <!--<el-select disabled size="small" v-model="articleForm.labels" multiple placeholder="请选择文章标签">-->
                        <!--<el-option value="html"></el-option>-->
                        <!--<el-option value="css"></el-option>-->
                        <!--<el-option value="javascript"></el-option>-->
                        <!--<el-option value="jquery"></el-option>-->
                        <!--<el-option value="vue"></el-option>-->
                        <!--<el-option value="php"></el-option>-->
                    <!--</el-select>-->
                <!--</el-form-item>-->
                <el-form-item label="状态：" prop="release_size">
                    <el-switch active-text="发表" inactive-text="下架" active-value=1 inactive-value=0 active-color="#409EFF" inactive-color="#C0CCDA" v-model="articleForm.release_size" style="width: 100%;"></el-switch>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" size="small" @click="onSubmit('articleForm')">立即{{articleForm.id ? '修改': '创建'}}</el-button>
                    <el-button type="success" size="small" @click="showPreviewDialog('articleForm')">预览</el-button>
                    <el-button size="small" @click="reset_article()">返回首页</el-button>
                </el-form-item>
            </el-form>
        </el-col>

        <!---预览-->
            <el-dialog title="预览" :visible.sync="previewVisible" :close-on-click-model="false" :fullscreen="true">
                <div class="previre_item">
                <el-col class="warp_main" :span="18" :offset="6">
                    <div class="img-item" v-show="articleForm.img">
                        <img style="width: 100%;" :src="articleForm.img" alt=""/>
                    </div>
                    <div class="show_box">
                        <div class="main" v-show="articleForm">
                            <div class="header">
                                <span style="font-size: 30px;font-weight: bold" v-html="articleForm.title"></span>
                            </div>
                            <div class="articleinfo_cade" >
                                <span style="color: #a4aaae;" class="fa fa-calendar date" v-html="articleForm.created_at"></span>
                                <span style="color: #a4aaae;">&nbsp;·&nbsp;</span>
                                <span  v-for="item in classifications"
                                       :key="item.id"
                                       v-if="articleForm.classification_id == item.id"
                                       v-html="item.name"></span>
                            </div>
                            <div class="content_item" >
                                <span class="content_style" v-html="articleForm.content" alt=""></span>
                            </div>
                            <div class="author_item" style="margin-top: 10px; padding-bottom: 20px; border-bottom: 1px solid #e3e3e3;">
                                <span style="font-weight: bold; font-family: 仿宋;font-size: 2px;">发布：</span>
                                <span class="author" style="color: #a4aaae;font-size: 3px;" v-html="articleForm.author"></span>
                            </div>
                        </div>
                        <div class="err_show_box" v-show="articleForm == null">
                            <span>无任何信息!</span>
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
        name:'createarticle',
        data(){
            return{
                customToolbar:[
                    [{'font':[]}],
                    [{'header':[false,1,2,3,4,5,6,]}],
                    ['bold','italic','underline','strike'],
                    [{'align':''},{'align':'center'},{'align':'right'},{'align':'justify'}],
                    [{'list':'ordered'},{'list':'bullet'}],
                    [{'script':'sub'},{'script':'super'}],
                    [{'indent':'-1'},{'indent':'+1'}],
                    [{'color':[]},{'background':[]}],
                    ['code-block','image'],
                    [{'direction':'rtl'}],
                    ['clean']
                ],
                imageUrl:'',
                oldImageUrl:'',
                loading:false,
                classifications:[],
                show_classification:'',
                userform:{},
                previewVisible:false,
                articleForm:{
                    id: 0,
                    img:'',
                    slug:'',
                    title:'',
                    content:'',
                    classification_id:1,
                    release_size:0,
                    abstract:'',
                    author:'',
                    istop:0
                },
                rules:{
                    title:[
                        {required:true ,message:'请输入文章标题' ,trigger:'blur'},
                        {min:1 ,max: 100, message: '标题最多100个字符', trigger: 'blur'}
                    ],
                    content:[
                        {required:true ,message:'请输入文章内容',trigger:'blur'}
                    ],
                    classification:[
                        {requured:true ,message:'请选择文章分类' ,trigger:'blur'}
                        ],
                    abstract:[
                        {min:1 ,max: 300, message: '摘要最多300个字符', trigger: 'blur'}
                    ],
                    istop:[
                        {required:true ,message:'请选择是否置顶', trigger:'blur'}
                    ],
                    release_size:[
                        {required:true ,message:'请选择状态', trigger:'blur'}
                    ]
                }
            }
        },
        created:function () {//初始化
            if(this.$route.params.row != null){
                this.articleForm = this.$route.params.row;
                this.imageUrl = this.$route.params.row.img;
            }
            this.LoadUserInfo();
            this.LoadClassification();
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
                            console.log('用户信息'+response.data);
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
            LoadClassification(){
                let that = this;
                that.loading = true;
                axios.get('/admin/classificationList')
                    .then(function (response) {
                        if (response && response.data){
                            that.loading = false;
                            that.classifications = response.data;
                        }
                    },function (err) {
                        that.loading = false;
                        that.$message.error({showClose:true,message:err.repsonse.data,duration:2000});
                    }).catch(function (error) {
                    that.loading = false;
                    that.$message.error({showClose:true,message:'分类信息请求异常',duration:2000});
                })
            },
            onSubmit(FormName){
                let that = this;
                that.$confirm('是否确定提交？','提示',{
                    confirmButtonText:'确定',
                    cancelButtonText:'取消',
                    type:'warning'
                }).then(()=>{
                    that.$refs[FormName].validate((valid)=>{
                        if(valid){
                            that.loading = true;
                            that.articleForm.img = that.imageUrl;
                            that.articleForm.author = that.userform.nickname;
                            axios.post('/admin/initArticle', that.articleForm)
                                .then(function (response) {
                                    that.loading = false;
                                    if(response && response.data){
                                        that.$message.success({showClose:true,message:response.data,duration:2000});
                                        that.$router.push({path:'/articlelist'})
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
                            })
                        }else{
                            that.$message.error({showClose:true,message:'请保证数据填写完整在提交！',duration:2000});
                    }
                })
                }).catch(()=> {
                    console.log('已取消')
            })
            },
            handleSuccess(response,res,file){//上传成功
                let that = this;
                that.imageUrl = response.url;
                that.replace_picture();
                console.log('上传成功返回图片信息',response);
            },
            handleBefore(file){//上传限制条件
                let that = this;
                that.oldImageUrl = that.imageUrl;
                const isJPG = file.type === 'image/jpeg';
                const isLt20M = file.size /1024/1024 < 20;
                if (!isJPG){
                    that.$message.error({showClose:true,message:'上传图片只能是JPG格式!'});
                }
                if (!isLt20M){
                    that.$message.error({showClose:true,message:'删除图片大小不能超过20MB！'});
                }
                return isJPG && isLt20M;

            },
            handleImageAdded:function (file,Editor,cursorLocation,resetUploader) {
               var formData = new FormData();
               let that = this;
               formData.append('image',file);
                that.loading =true;
               axios.post('https://fakeapi.yoursite.com/images',formData)
                   .then(function (result) {
                       that.loading = false;
                       let url = result.data.url;
                       Editor.insertEmbed(cursorLocation,'image',url);
                       resetUploader();
                   },function (err) {
                       that.loading = false;
                       that.$message.error({showClose:true,message:err.data,duration:2000});
                   }).catch(function (error) {
                        that.loading = false;
                       console.log(err);
               })
            },
            replace_picture(){
                let that = this;
                if (that.oldImageUrl){
                    let picture_name = that.oldImageUrl.substring(9);
                    that.loading = true;
                    axios.post('/admin/deletepicture',{name:picture_name})
                        .then(function (response) {
                            that.loading = false;
                            if (response && response.data){
                                that.$message.success({showClose:true,message:'图片已替换!',duration:2000});
                            }
                        },function (err) {
                            that.loading = false;
                            that.$message.error({showCLose:true,message:'替换出错!',duration:2000});
                        }).catch(function (error) {
                        that.loading = false;
                        that.$message.error({showClose:true,message:'请求出现异常!',duration:2000});
                    })
                }
            },
            delete_picture(){
                let that = this;
                let picture_name = that.imageUrl.substring(9);
                that.$confirm('是否删除顶部图片？','提示',{
                    confirmButtonText:'确定',
                    cancelButtonText:'取消',
                    type:'warning'
                }).then(()=>{
                    that.loading = true;
                    axios.post('/admin/deletepicture',{name:picture_name})
                        .then(function (response) {
                            that.loading = false;
                            if (response && response.data){
                                that.$message.success({showClose:true,message:response.data,duration:2000});
                            }
                            that.imageUrl = null;
                        },function (err) {
                            that.loading = false;
                            that.$message.error({showCLose:true,message:err.response.data,duration:2000});
                        }).catch(function (error) {
                            that.loading = false;
                            that.$message.error({showClose:true,message:'请求出现异常',duration:2000});
                    })
                }).catch(()=> {
                    console.log('已取消');
            })
                console.log('删除图片');
            },
            uploadError(response,file,fileList){//上传失败
                console.log('上传失败，请重试!')
            },
            reset_article(FormName){
                console.log('返回首页')
            },
            showPreviewDialog(FormName){
                this.previewVisible = true;
                let row = FormName;
                // window.open('http://yue_blog.com/admin/index#/articleview')
                // this.$router.push({name:'articleview',params:{row}});
            }
        },
        mounted(){
            // if(this.articles != null){
            //     this.articles = this.articleForm;
            // }
            this.dialogImageUrl = this.articleForm.img;
            // this.show_classification = this.classifications.find(e => e.id === this.articleForm.classification_id).name;

        },
    }
</script>

<style scoped>
    .previre_item{
        width: 100%;
        display: flex;
        flex-direction: column;
        align-content: center;
        align-items: center;
        justify-content: center;
    }
    .img-item{
        width: 100%;
        height: 400px;
        display: flex;
        justify-content: center;
    }
    .show_box{
        width: 80%;
        display:flex;
        flex-direction: column;
        justify-content: center;
        font-family: 宋体;
        margin-top: 40px;
        margin-bottom: 40px;
    }
    .header{
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        align-content: center;
    }
    .warp_main{
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        margin: 20px 0 0 20px;
        box-shadow: 10px 10px 10px 10px #5e5d5d;
    }
    .articleinfo_cade{
        padding-top: 10px;
        padding-bottom: 10px;
        display: flex;
        justify-content: center;
        font-size: 2px;
    }
    .err_show_box{
        width: 100%;
        display: flex;
        justify-content: center;
        color: #adadad;
    }

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
    /*文章内图片样式*/
    .content_item{
        padding:20px 0 30px 30px;
        border-top: 1px solid #e3e3e3;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }
    .content_style {
        width: 100%;
        color: #636b6f;

    }
</style>