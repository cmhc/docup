<?php
/**
 * 一个简单的文档托管平台
 * 
 * 首选需要注册一个用户，注册完成之后就拥有了上传文档的权限，同时服务器会生成一个用户文件夹，用户数据结构
 * {
 *     username: 用户名称
 *     password: 用户密码
 * }
 * 
 * 上传文档之前需要注册一个项目，项目在用户的文档之下生成一个项目文件夹，项目数据结构如下
 * {
 *     name: 名称,需要是英文名名称
 *     description: 描述
 * }
 * 
 * 所有的数据存储到sqlite中，注册之后就拥有了对这个文件夹的读写权限
 */
namespace docup;

class Protocol
{

    /**
     * 上传压缩包，以二进制的方式上传
     * @param  string $user 用户信息hash
     * @param  string $dir  本地路径
     */
    public function upload($user)
    {
        $dir = getcwd();
        $zip = new \docup\Zip;
        $zipFile = $zip->create($dir);
        if (!file_exists($zipFile)) {
            return  "Zip file create failed\n";
        }
        if (filesize($zipFile) > 1024*1024*8) {
            return "Zip file is too large\n";
        }
        $bin = file_get_contents($zipFile);
        $len = strlen($bin);
        $context = stream_context_create(array(
            'http' => array(
                'method' => 'POST',
                'header' => "Content-Type: application/octet-stream\r\nContent-Length:{$len}",
                'content' => $bin,
                )
            ));
        $project = new \docup\Project();
        $api = sprintf(trim($project->getServer(), '/') . '/docup.php?sid=%s&project=%s', $user, $project->getProjectName());
        $res =  file_get_contents($api, null, $context);
        //清理文件
        @unlink($zipFile);
        return $res;
    }
}