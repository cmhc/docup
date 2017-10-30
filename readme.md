docup 文档上传工具
==================

一个静态文档托管工具, 方便让其他人查看

及其简单的上传过程

    E:\apidoc\test>docup
    document uploader v0.1.0
    ========================
    current directory is E:\apidoc\test, upload? [Y/N]
    Y
    {"code":1,"msg":"success","project":"role","url":"http:\/\/www.example
    .com\/huchao\/role"}

## 安装 ##

docup使用composer安装

    composer global require cmhc/docup dev-master


## 使用方法 ##

在命令行下进入所需要上传的目录，比如 `E:\apidoc\test` 输入`docup` 。
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
    current directory is E:\apidoc\test, upload? [Y/N]

输入Y即可上传，结果如下

    project name:role
    current directory is E:\apidoc\test, upload? [Y/N]
    Y
    {"code":1,"msg":"success","project":"role","url":"http:\/\/www.example.com\/huchao\/test"}

至此整个上传流程就结束了了，下次上传的时候直接输入docup即可