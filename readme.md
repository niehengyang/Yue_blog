## 安装指南

1. 服务器安装Git工具
2. 克隆项目，在服务器Web目录中运行 `git clone http://git.miniap.cn/Dmer/SmartMonitor_Web.git`
3. 如果要部署的代码不在默认master分支，则需要切换到响应的分支，现场测试的代码在test分支，`git checkout test`
4. 进入项目目录 `cd SmartMonitor_Web`
5. 执行 `composer install` 安装PHP框架依赖包
6. 执行 `npm install`安装前端Javascript框架依赖包
7. 执行 `mv .env.example .env` 创建环境变量文件
8. 执行 `php artisan key:generate` 创建项目唯一的加密Key
9. 执行 `mysql -u 数据库用户名 -p 数据库密码` 以命令行模式登录Mysql数据库，然后执行 `create database eb_smart character set utf8mb4 collate utf8mb4_general_ci;`创建项目数据库
10. 执行 `vi .env` 编辑环境变量配置文件，把APP_URL和DB_HOST等数据库连接信息更改为实际的
11. 执行 `php artisan migrate` 生成数据库表结构
12. 执行 `php artisan db:seed` 生成数据库必要的数据
13. 执行`crontab -e`编辑操作系统的定时任务，加入一条指令 `* * * * * php /path-to-your-project/artisan schedule:run >> /dev/null 2>&1`，然后启动或重启系统的cron服务
14. 执行 `npm run prod` 编译前端Javascript文件
15. 安装 influxdb 时序数据库
16. 启动influxdb数据库 `sudo service influxdb start`
17. 新建数据库test `create database test`
18. 切换数据库到test `use test`
19. 写入统计每30分钟对于数据流上报条数的统计CQ `create continuous query "dataflow_upload_count" on "test" begin select count("value") into "dataflow_count" from "dataflow" group by time(30m),"dataflowId" end`
20. 写入统计每30分钟对于设备上报条数的统计CQ `create continuous query "device_upload_count" on "test" begin select count("value") into "device_count" from "dataflow" group by time(30m),"deviceId" end`
21. 写入统计数据流每2小时的平均值的CQ `create continuous query "dataflow_upload_average" on "test" begin select mean("value") into "dataflow_average" from "dataflow" group by time(2h),"dataflowId" end`
19. 在浏览器中输入http://（域名）/admin/permission/upgrade  
20. 访问项目IP地址或域名
