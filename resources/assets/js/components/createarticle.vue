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
        <el-col class="warp-main" :span="24" style="padding-top: 20px">
            <el-form :model="articleForm" label-width="100px" :rules="rules" ref="articleForm">
                <el-form-item label="标题" prop="title">
                    <el-input v-model="articleForm.title" auto-complate="off" placeholder="为你的文章起个标题吧！"></el-input>
                </el-form-item>
                <el-form-item>
                    <span>请为你的文章选择分类：</span>
                    <div>
                        <el-radio-group v-model="articleForm.calssification" size="small">
                            <el-radio label="1" border >分类一</el-radio>
                            <el-radio label="2" border >分类二</el-radio>
                            <el-radio label="3" border >分类三</el-radio>
                            <el-radio label="4" border >分类四</el-radio>
                            <el-radio label="5" border >分类五</el-radio>
                            <el-radio label="6" border >分类六</el-radio>
                        </el-radio-group>
                    </div>
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
                articleForm:{}
            }
        }
    }
</script>

<style scoped>

</style>