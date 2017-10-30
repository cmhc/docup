<?php
/**
 * 命令行
 * 双击进入控制台，读取同文件夹下面的用户信息，如果没有会提示输入
 * username:
 * password:
 * 执行登录操作，生成信息
 * 
 * 
 */
namespace docup;

class Command
{
    public function main()
    {
        $this->welcome();
        $this->project = new \docup\Project();
        $this->setServer();
        $this->user = new \docup\User();
        if (!($info = $this->user->isLogin())) {
            $info = $this->login();
        }
        $this->upload($info);
    }

    /**
     * 上传控制
     * @param  string $info 用户信息
     */
    public function upload($info)
    {
        $this->setProject();
        echo "Current directory is " . getcwd() . ", upload? [Y/N]\n";
        $check = strtolower(trim(fgets(STDIN)));
        if ($check == 'n') {
            return false;
        }
        $protocol = new \docup\Protocol();
        echo $protocol->upload($info);
        echo "\n";
        fgets(STDIN);
    }

    /**
     * 登录
     */
    public function login()
    {

        echo "Enter reg or up\n";
        $cmd = strtolower(trim(fgets(STDIN)));
        if ($cmd == 'reg') {
            echo "== Register ==\n";
            $this->register();
        }

        $success = false;
        while (!$success) {
            echo "== Login ==\n";
            echo "username:";
            $username = strtolower(trim(fgets(STDIN)));
            echo "password:";
            $password = strtolower(trim(fgets(STDIN)));
            $success = $this->user->login($username, $password);

            if ($success) {
                echo "login success\n";
            } else {
                echo "username or password error\n";
            }
        }
        return $check['sid'];
    }

    /**
     * 注册
     */
    public function register()
    {
        $success = false;
        while (!$success) {
            echo "username:";
            $username = strtolower(trim(fgets(STDIN)));
            echo "password:";
            $password = strtolower(trim(fgets(STDIN)));
            $success = $this->user->register($username, $password);           
            if ($success) {
                echo "register success\n";
            } else {
                echo "username error\n";
            }
        }
    }

    /**
     * 设置项目
     */
    public function setProject()
    {
        if ($this->project->getProjectName()) {
            return true;
        }
        $success = false;
        while (!$success) {
            echo "Project name: ";
            $projectName = fgets(STDIN);
            $success = $this->project->initLocal($projectName);
        }
    }

    /**
     * 设置文档托管服务器
     */
    public function setServer()
    {
        if ($this->project->getServer()) {
            return true;
        }
        echo "Server address: ";
        $serverAddress = fgets(STDIN);
        $this->project->setServer($serverAddress);
    }

    public function welcome()
    {
        echo "document uploader v0.1.0\n";
        echo "========================\n\n";
    }


}