docup 文档上传工具
==================

一个静态文档上传工具，将静态的文档托管到doc.staff.ifeng.com, 方便让其他人查看

及其简单的上传过程

    E:\xampp\htdocs\newComment\trunk\02src\apidoc\role>docup
    document uploader v0.1.0
    ========================
    current directory is E:\xampp\htdocs\newComment\trunk\02src\apidoc\role, upload? [Y/N]
    Y
    {"code":1,"msg":"success","project":"role","url":"http:\/\/doc.staff.ifeng.com\/huchao\/role"}


## 使用方法 ##

## 添加环境变量 ##

首先需要将docup目录添加到环境变量中，在windows系统是电脑（计算机）-属性->高级系统设置->高级->环境变量->系统环境变量, 编辑系统变量中的path, 假设docup的目录为 E:\docup, 将这个目录追加到path值后面即可(需要用;分开)。

linux系统需要修改 /etc/profile，打开此文件，在最下一行加入(假设docup的目录为/data/htdocs/docup)

    export PATH=$PATH:/data/htdocs/docup

linux系统还可以使用符号链接

在命令行下进入所需要上传的目录，比如 `E:\xampp\htdocs\newComment\trunk\02src\apidoc\role` 输入`docup` 。
第一次使用的时候会提示是reg or up，此时需要输入reg注册一个用户

    E:\xampp\htdocs\newComment\trunk\02src\apidoc\role>docup
    document uploader v0.1.0
    ========================
    Enter reg or up
    reg
    == Register ==
    username:huchao
    password:123456

如果名字没有被占用的话，就会提示成功。注册成功之后会提示登录

    == Login ==
    username:huchao
    password:******
    login success

登录成功之后会提示你输入项目名称，此时输入的名称将会显示在url上面

    project name:

输入项目名称，比如role

    project name:role
    current directory is E:\xampp\htdocs\newComment\trunk\02src\apidoc\role, upload? [Y/N]

输入Y即可上传，结果如下

    project name:role
    current directory is E:\xampp\htdocs\newComment\trunk\02src\apidoc\role, upload? [Y/N]
    Y
    {"code":1,"msg":"success","project":"role","url":"http:\/\/doc.staff.ifeng.com\/huchao\/role"}

至此整个上传流程就结束了了，下次上传的时候直接输入docup即可