<template>
    <el-row class="warp">
        <el-col :span="24" class="warp-breadcrum">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item :to="{path: '/home'}"><b>首页</b></el-breadcrumb-item>
            </el-breadcrumb>
        </el-col>

        <el-col :span="24" v-loading="loading" class="warp-main" element-loading-text="拼命加载中" style="padding: 20px 0 0 20px;">
            <el-row :gutter="20" class="top_tool">
                <el-col :span="6">
                    <div class="traffic_item">
                        <div class="show_face">
                            <div class="left_main">
                                <span>44人</span>
                                <span>浏览量</span>
                            </div>
                            <div class="right_main">
                                <i class="fa fa-user-plus"></i>
                            </div>
                        </div>
                        <div class="operation_btn">
                            <button>更多信息<i class="fa fa-arrow-circle-right"></i></button>
                        </div>
                    </div>
                </el-col>
                <el-col :span="6">
                    <div class="traffic_item">
                        <div class="show_face">
                            <div class="left_main">
                                <span>44人</span>
                                <span>浏览量</span>
                            </div>
                            <div class="right_main">
                                <i class="fa fa-user-plus"></i>
                            </div>
                        </div>
                        <div class="operation_btn">
                            <button>更多信息<i class="fa fa-arrow-circle-right"></i></button>
                        </div>
                    </div>
                </el-col>
                <el-col :span="6">
                    <div class="traffic_item">
                        <div class="show_face">
                            <div class="left_main">
                                <span class="number">44人</span>
                                <span class="show_type">浏览量</span>
                            </div>
                            <div class="right_main">
                                <i class="fa fa-user-plus"></i>
                            </div>
                        </div>
                        <div class="operation_btn">
                            <button>更多信息<i class="fa fa-arrow-circle-right"></i></button>
                        </div>
                    </div>
                </el-col>
                <el-col :span="6">
                    <div class="traffic_item">
                        <div class="show_face">
                            <div class="left_main">
                                <span>44人</span>
                                <span>浏览量</span>
                            </div>
                            <div class="right_main">
                                <i class="fa fa-user-plus"></i>
                            </div>
                        </div>
                        <div class="operation_btn">
                            <button>更多信息<i class="fa fa-arrow-circle-right"></i></button>
                        </div>
                    </div>
                </el-col>
            </el-row>
        </el-col>
    </el-row>
</template>

<script>
    export default {
        data(){
            return{
                loading:false,
            }
        },
        created(){

        },
        methods:{

        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
<style scoped>
    .traffic_item{
        padding: 10px;
        border-radius: 2px;
        background-color: #00C1DE;
        display: flex;
        flex-direction: column;
    }
    .show_face{
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }
    .left_main{
        display: flex;
        flex-direction: column;
    }
</style>