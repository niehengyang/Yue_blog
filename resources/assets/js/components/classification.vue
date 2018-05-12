<template>
    <el-row class="warp">
        <el-col :span="24" class="warp-breadcrum" :loading="loading">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item :to="{path: '/home'}"><b>首页</b></el-breadcrumb-item>
                <el-breadcrumb-item >文章管理</el-breadcrumb-item>
                <el-breadcrumb-item>文章分类</el-breadcrumb-item>
            </el-breadcrumb>
        </el-col>

        <!--分类表-->
        <el-col :span="24" class="warp-main" v-loading="loading" element-loading-text="拼命加载中" style="padding-top: 20px;">
            <template>
                <el-button class="fa fa-plus-circle" type="success" plain onclick="window.location.href='#add'">&nbsp;添加分类</el-button>
            </template>
            <el-table :data="tableData" style="width: 100%;" :stripe="true">
                <el-table-column prop="id" label="ID" width="200"></el-table-column>
                <el-table-column prop="name" label="分类名称" width="300"></el-table-column>
                <el-table-column prop="describe" label="分类描述" width="300"></el-table-column>
                <el-table-column prop="created_at" label="创建时间" width="300"></el-table-column>
                <el-table-column label="操作" width="200" fixed="right">
                    <template slot-scope="scope">
                        <el-button size="mini" @click="editclassification(scope.row)" class="el-icon-edit" title="编辑"></el-button>
                        <el-button size="mini" type="danger" @click="delclassification(scope.row)" class="el-icon-delete" title="删除"></el-button>
                    </template>
                </el-table-column>
            </el-table>
        </el-col>

        <!--分类创建-->
        <el-col :sapn="24" class="warp-form" style="border: 1px solid #d4d4d4;margin-top: 10px;" id="add">
            <span class="fa fa-edit" style="padding: 20px;">&nbsp;添加分类</span>
            <el-form :model="addnewData" label-width="100px" :rules="rules" ref="addnewData" class="ruleForm" style="padding: 30px;">
                <el-form-item label="分类名称" prop="name">
                    <el-input :maxlength="20" class="type_input" size="small" v-model="addnewData.name" auto-complate="off" placeholder="请填写分类名称"></el-input>
                </el-form-item>
                <el-form-item label="分类描述" prop="describe">
                    <el-input :maxlength="240" class="type_input" type="textarea" v-model="addnewData.describe" placeholder="请填写分类描述"></el-input>
                </el-form-item>
                <el-form-item>
                    <el-button size="small" type="primary" @click="addSubmit('addnewData')" class="fa fa-check-circle">&nbsp;提交</el-button>
                </el-form-item>
            </el-form>
        </el-col>

        <!--编辑-->
        <el-dialog titel="编辑分类" :visible.sync="previewVisible" :close-on-click-model="false" >
            <el-form :model="formData" label-width="100px" :rules="rules" ref="formData" class="ruleForm" style="padding: 30px;">
                <el-form-item label="分类名称" prop="name">
                    <el-input size="small" v-model="formData.name" auto-complate="off" placeholder="请填写分类名称"></el-input>
                </el-form-item>
                <el-form-item label="分类描述" prop="describe">
                    <el-input type="textarea" v-model="formData.describe" placeholder="请填写分类描述"></el-input>
                </el-form-item>
                <el-form-item>
                    <el-button size="small" type="primary" @click="updateSubmit('formData')" class="fa fa-check-circle">&nbsp;提交</el-button>
                </el-form-item>
            </el-form>
            <div slot="footer" class="dialog-footer" style="padding-top: 10px; width: 100%;text-align: center;">
                <el-button @click.native="previewVisible = false">关闭</el-button>
            </div>
        </el-dialog>
    </el-row>
</template>

<script>
    export default {
        name: "classification",
        data(){
            return{
                loading:false,
                previewVisible:false,
                tableData: [],
                formData: {},
                addnewData:{},
                rules: {
                    name: [
                        {required: true, message: '请输入分类名称', trigger: 'blur'},
                        {min: 1, max: 20, message: '长度在1到20个字符', trigger: 'blur'}
                    ],
                    describe: [
                        {required: true, message: '请填写分类描述', trigger: 'blur'},
                        {min: 1, max: 240, message: '长度在1到240个字符', trigger: 'blur'}
                    ]
                }
            }
        },
        created:function () {//初始化
            // if(this.$route.params.row != null){
            //     this.articleForm = this.$route.params.row;
            // }
            this.LoadpageInfo();
        },
        methods:{
            LoadpageInfo(){
                let that = this;
                that.loading = true;
                axios.get('/admin/classificationList')
                    .then(function (response) {
                    if (response && response.data){
                        that.loading = false;
                        that.tableData = response.data;
                    }
                },function (err) {
                        that.loading = false;
                        that.$message.error({showClose:true,message:err.repsonse.data,duration:2000});
                    }).catch(function (error) {
                        that.loading = false;
                        that.$message.error({showClose:true,message:'请求出现异常',duration:2000});
                })
            },
            editclassification(row){
                let that =this;
                that.$confirm('是否编辑该分类?','提示',{
                    confirmButtonText:'确定',
                    cancelButtonText:'取消',
                    type:'warning'
                }).then(() => {
                    that.previewVisible = true;
                    that.formData = row;
                }).catch(()=> {
                    console.log('已取消')
            })
            },
            delclassification(row){
                let that =this;
                that.$confirm('是否删除该分类?','提示',{
                    confirmButtonText:'确定',
                    cancelButtonText:'取消',
                    type:'warning'
                }).then(() => {
                    that.loading = true;
                axios.post('/admin/delclassification',row)
                    .then(function (response) {
                        that.loading = false;
                        that.$message.success({showClose:true,message:response.data,duration:2000});
                        that.LoadpageInfo();
                    },function (err) {
                        that.loading = false;
                        that.$message.error({showCLose:true,message:err.response.data,duration:2000});
                        that.LoadpageInfo();
                    }).catch(function (error) {
                    that.loading = false;
                    that.$message.error({showCLose:true,message:'请求出现异常',duration:2000});
                })
            }).catch(()=> {
                    console.log('已取消')
            })
            },
            updateSubmit(FormName){
                let that = this;
                that.$confirm('是否确定提交?','提示',{
                    confirmButtonText:'确定',
                    cancelButtonText:'取消',
                    type:'warning'
                }).then(()=> {
                    that.$refs[FormName].validate((valid)=> {
                    if(valid) {
                        that.loading = true;
                        axios.post('/admin/initclassification', that.formData)
                            .then(function (response) {
                                that.loading = false;
                                that.$message.success({showClose: true, message: response.data, duration: 2000});
                                that.LoadpageInfo();
                            }, function (err) {
                                that.loading = false;
                                that.$message.error({showCLose: true, message: err.response.data, duration: 2000});
                                that.LoadpageInfo();
                            }).catch(function (error) {
                            that.loading = false;
                            that.$message.error({showCLose: true, message: '请求出现异常', duration: 2000});
                        })
                    }
                })
            }).catch(()=> {
                    console.log('已取消')
            })
            },
            addSubmit(FormName){
                let that = this;
                that.$confirm('是否确定提交?','提示',{
                    confirmButtonText:'确定',
                    cancelButtonText:'取消',
                    type:'warning'
                }).then(()=> {
                    that.$refs[FormName].validate((valid)=>{
                        if(valid){
                    that.loading = true;
                   axios.post('/admin/initclassification',that.addnewData)
                       .then(function (response) {
                           that.loading = false
                           that.$message.success({showClose:true,message:response.data,duration:2000});
                           that.LoadpageInfo();
                       },function (err) {
                           that.loading = false;
                           that.$message.error({showClose:true,message:err.response.data,duration:2000});
                           that.LoadpageInfo();
                       }).catch(function (error) {
                           that.loading = false;
                           that.$message.error({showClose:true,message:'请求出现异常',duration:2000});
                   })
                        }else{
                            that.$message.error({showClose:true,message:'请保证数据填写完整在提交',duration:2000});
                    }
                })
                }).catch(()=> {
                    console.log('已取消')
                })
            }
        }
    }
</script>

<style scoped>
.type_input{
    width:400px;
}
</style>