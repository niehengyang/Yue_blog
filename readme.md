## 安装指南

1. 服务器安装Git工具
2. 克隆项目，在服务器Web目录中运行 `git clone https://github.com/niehengyang/Yue_blog.git`
3. 如果要部署的代码不在默认master分支，则需要切换到响应的分支，现场测试的代码在test分支，`git checkout test`
4. 进入项目目录 `cd Yue_blog`
5. 执行 `composer install` 安装PHP框架依赖包
6. 执行 `npm install`安装前端Javascript框架依赖包
7. 执行 `mv .env.example .env` 创建环境变量文件
8. 执行 `php artisan key:generate` 创建项目唯一的加密Key
9. 执行 `mysql -u 数据库用户名 -p 数据库密码` 以命令行模式登录Mysql数据库，然后执行 `create database yue_blog character set utf8mb4 collate utf8mb4_general_ci;`创建项目数据库
10. 执行 `vi .env` 编辑环境变量配置文件，把APP_URL和DB_HOST等数据库连接信息更改为实际的
11. 执行 `php artisan migrate` 生成数据库表结构
12. 执行 `php artisan db:seed` 生成数据库必要的数据
14. 执行 `npm run prod` 编译前端Javascript文件
20. 访问项目IP地址或域名
