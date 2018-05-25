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
                    <el-button size="small" class="fa fa-window-close" type="danger" plain>&nbsp;关闭站点</el-button>
                </el-row>
            </el-col>
        </el-col>

        <!--网站表单-->
        <el-col :span="24" class="warp-main" style="padding-top: 20px;">
            <el-form :model="webSiteForm" :rules="rules" ref="webSiteForm" label-width="100px" class="web_ruleForm">
                <el-form-item label="主题图片" prop="top_image">
                    <el-input class="input_style" size="small" v-model="webSiteForm.top_image"></el-input>
                </el-form-item>
                <el-form-item label="网站标题" prop="web_title">
                    <el-input class="input_style" size="small" v-model="webSiteForm.web_title"></el-input>
                </el-form-item>
                <el-form-item label="网站欢迎语" prop="web_speak">
                    <el-input class="input_style" size="small" v-model="webSiteForm.web_speak"></el-input>
                </el-form-item>
                <el-form-item label="网站描述" prop="web_describe">
                    <el-input class="input_style" type="textarea" size="small" v-model="webSiteForm.web_describe"></el-input>
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
                webSiteForm:{},
                rules:{
                    top_image:[
                        {required:true,message:'请选择网站图片',trigger:'blur'}
                    ],
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
        methods:{
            submitForm(FormName){
                this.$refs[FormName].validate((valid) =>{
                    if(valid){
                        alert('submit');
                    }else{
                        return false;
                    }
                });
            }
        }
    }
</script>

<style scoped>
.input_style{
    width: 500px;
}
</style>