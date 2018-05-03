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
        <el-col class="warp-main" :span="20" style="padding: 20px 0 0 40px;">
            <el-form :model="articleForm" label-width="100px" :rules="rules" ref="articleForm" class="ruleForm">
                <el-form-item label="文章标题：" prop="title">
                    <el-input size="small" v-model="articleForm.title" auto-complate="off" placeholder="为你的文章起个标题吧！"></el-input>
                </el-form-item>
                <el-form-item label="照片墙" prop="img">
                    <el-upload
                            action="/admin/uploadfile"
                            list-type="picture-card"
                            :file-list = "files"
                            :on-preview="handlePictureCardPreview"
                            :on-remove="handleRemove"
                            :on-success="handleSuccess"
                            :before-upload="handleBefore"
                            :on-error="uploadError">
                        <i class="el-icon-plus"></i>
                    </el-upload>
                    <el-dialog :visible.sync="dialogVisible">
                        <img width="100%" :src="dialogImageUrl" alt="">
                    </el-dialog>
                    <div class="tipss">图片尺寸：500*500</div>
                </el-form-item>
                <el-form-item label="文章内容：" prop="content">
                    <vue-editor v-model="articleForm.content" placeholder="在此输入文章内容" :editorToolbar="customToolbar"></vue-editor>
                </el-form-item>
                <el-form-item label="文章摘要：" prop="abstract">
                    <el-input type="textarea" v-model="articleForm.abstract" maxlength="240" minlength="10" placeholder="请输入文章摘要,不得少于10个字和大于240个字!。"></el-input>
                </el-form-item>
                <el-form-item label="文章分类：" prop="classification">
                    <el-select size="small" v-model="articleForm.classification" placeholder="请选择文章分类">
                        <el-option value="技术"></el-option>
                        <el-option value="散文"></el-option>
                        <el-option value="其它"></el-option>
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
                    <el-button size="small" @click="reset_article('articleForm')">重置</el-button>
                    <el-button size="small" @click="showPreviewDialog('articleForm')">预览</el-button>
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
                        <div class="main" v-show="articleForm.title">
                            <div class="header">
                                <span style="font-size: 30px;font-weight: bold" v-html="articleForm.title"></span>
                            </div>
                            <div class="articleinfo_cade" >
                                <span style="color: #a4aaae;" class="fa fa-calendar date" v-html="articleForm.created_at"></span>
                                <span style="color: #a4aaae;">&nbsp;·&nbsp;</span>
                                <span v-html="articleForm.classification"></span>
                            </div>
                            <div class="content_item" style="padding:20px 0 30px 30px; border-top: 1px solid #e3e3e3;">
                                <span style="color: #636b6f;" v-html="articleForm.content" alt=""></span>
                            </div>
                            <div class="author_item" style="margin-top: 10px; padding-bottom: 20px; border-bottom: 1px solid #e3e3e3;">
                                <span style="font-weight: bold; font-family: 仿宋;font-size: 2px;">发布：</span>
                                <span class="author" style="color: #a4aaae;font-size: 3px;" v-html="articleForm.author"></span>
                            </div>
                        </div>
                        <div class="err_show_box" v-show="articleForm.title === ''">
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
                    ['code-block'],
                    [{'direction':'rtl'}],
                    ['clean']
                ],
                files: [],
                dialogImageUrl:'',
                dialogVisible: false,
                loading:false,
                articles:{},
                userform:{},
                previewVisible:false,
                articleForm:{
                    id: 0,
                    img:'',
                    slug:'',
                    title:'',
                    content:'',
                    classification:'',
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
                        {required:true ,message:'请输入文章摘要',trigger:'blur'}
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
            }
            this.LoadUserInfo();
        },
        methods:{
            LoadUserInfo(){
                let that = this;
                that.loading = true;
                axios.get('/admin/getUserInfo')
                    .then(function (response) {
                        if (response && response.data){
                            that.userform = response.data;
                            console.log('用户信息'+response.data);
                        }else{
                            that.$message.error({showClose:true,message:'信息获取失败！',duration:2000});
                        }
                    }).catch(function (error) {
                    that.loading = false;
                    console.log(error);
                    that.$message.error({showClose:true,message:'用户信息请求异常',duration:2000});
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
                            that.loading = false;
                            that.$message.error({showClose:true,message:'请保证数据填写完整在提交！',duration:2000});
                    }
                })
                }).catch(()=> {
                    console.log('已取消')
            })
            },
            handlePictureCardPreview(file){//创建预览
                this.dialogImageUrl = file.url;
                this.dialogVisible = true;
            },
            handleRemove(file,fileList){
                console.log(file,fileList);//删除
            },
            handleSuccess(response,file,fileList){//上传成功
                var self = this;
                self.dialogImageUrl = response.url;
                self.articleForm.img = response.url;
                // self.dialogVisible = true;
                console.log('上传成功',response);
            },
            handleBefore(file){//上传限制条件
                return this.files.length === 1? false : true//只让同时上传一张
            },
            uploadError(response,file,fileList){//上传失败
                console.log('上传失败，请重试!')
            },
            reset_article(FormName){
                console.log(FormName)
            },
            showPreviewDialog(FormName){
                this.previewVisible = true;
                let row = this.articleForm;
                // window.open('http://yue_blog.com/admin/index#/articleview')
                // this.$router.push({name:'articleview',params:{row}});
            }
        },
        mounted(){
            // if(this.articles != null){
            //     this.articles = this.articleForm;
            // }
            this.dialogImageUrl = this.articleForm.img;
            this.LoadUserInfo();

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
</style>