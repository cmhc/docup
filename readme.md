docup 文档上传工具
==================

一个静态文档托管工具, 方便让其他人查看

及其简单的上传过程

    E:\apidoc\test>docup
    document uploader v0.1.0
    ========================
    current directory is E:\apidoc\test, upload? [Y/N]
    Y
    {"code":1,"msg":"success","project":"role","url":"http:\/\/www.example.com\/huchao\/role"}

## 安装 ##

docup使用composer安装

    composer global require cmhc/docup dev-master


## 使用 ##

为了避免文档上传错误，我们使用手工写入配置文件作为文档上传依据，docup使用docup.json作为项目的配置，一个docup.json的示例文件如下

    {
        "server":"http://www.example.com",
        "name":"test"
    }

其中server为文档托管服务的服务器地址，name为项目的文件。将这个json文件命名为`docup.json`放到文档的根目录即可。

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

登录成功之后将会提示上传的路径

    current directory is E:\apidoc\test, upload? [Y/N]

输入Y即可上传，结果如下

    current directory is E:\apidoc\test, upload? [Y/N]
    Y
    {"code":1,"msg":"success","project":"role","url":"http:\/\/www.example.com\/huchao\/test"}

至此整个上传流程就结束了了，下次上传的时候直接输入docup即可
