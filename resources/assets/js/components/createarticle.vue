<template>
    <el-row class="warp">
        <el-col :span="24" class="warp-breadcrum" :loading="loading">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item :to="{path: '/home'}"><b>首页</b></el-breadcrumb-item>
                <el-breadcrumb-item >文章管理</el-breadcrumb-item>
                <el-breadcrumb-item>创建文章</el-breadcrumb-item>
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
                <el-form-item label="文章分类：" prop="calssification">
                    <el-select size="small" v-model="articleForm.calssification" placeholder="请选择文章分类">
                        <el-option value="技术"></el-option>
                        <el-option value="散文"></el-option>
                        <el-option value="其它"></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="是否置顶？" prop="istop">
                    <el-radio-group size="small" v-model="articleForm.istop">
                        <el-radio-button label="true">是</el-radio-button>
                        <el-radio-button label="false">否</el-radio-button>
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
                    <el-switch active-text="发表" inactive-text="下架" v-model="articleForm.release_size" style="width: 100%;"></el-switch>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" size="small" @click="onSubmit('articleForm')">立即{{articleForm.id ? '修改': '创建'}}</el-button>
                    <el-button size="small" @click="reset_article('articleForm')">重置</el-button>
                </el-form-item>
            </el-form>
        </el-col>
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
                articleForm:{
                    id: 0,
                    img:'',
                    slug:'',
                    title:'',
                    content:'',
                    calssification:'技术',
                    release_size:false,
                    abstract:'',
                    author:'',
                    istop:false
                },
                rules:{
                    title:[
                        {required:true ,message:'请输入文章标题' ,trigger:'blur'},
                        {min:1 ,max: 100, message: '标题最多100个字符', trigger: 'blur'}
                    ],
                    content:[
                        {required:true ,message:'请输入文章内容',trigger:'blur'}
                    ],
                    abstract:[
                        {required:true ,message:'请输入文章摘要',trigger:'blur'}
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
                                    if(response.status == 200){
                                        that.$message.success({showClose:true,message:response.data,duration:2000});
                                    }else{
                                        that.$message.error({showClose:true,message:response.data,duration:2000});
                                    }
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
            }
        },
        mounted(){
            if(this.articles != null){
                this.articles = this.articleForm;
            }
            this.LoadUserInfo();
        },
    }
</script>

<style scoped>

</style>