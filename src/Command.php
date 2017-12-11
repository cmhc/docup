<?php
/**
 * 
 */
namespace docup;

class Command
{
    public function main()
    {
        $this->welcome();
        if (!$this->checkProjectConfig()) {
            return false;
        }

        $this->user = new \docup\User();
        if (!($this->user->isLogin())) {
            $this->login();
        }
        $this->upload();
    }

    /**
     * 上传控制
     * @param  string $info 用户信息
     */
    public function upload()
    {
        echo "Current directory is " . getcwd() . ", upload? [Y/N]\n";
        $check = strtolower(trim(fgets(STDIN)));
        if ($check == 'n') {
            return false;
        }
        $protocol = new \docup\Protocol();
        echo $protocol->upload();
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
        return true;
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
     * 设置文档托管服务器
     */
    public function checkProjectConfig()
    {
        $this->project = new \docup\Project();
        if (!$this->project->initProject()) {
            echo "Please create docup.json file in your document root directory\n";
            return false;
        }
        if (!$this->project->getServer()) {
            echo "server field not found in docup.json file\n";
            return false;
        }
        if (!$this->project->getProject()) {
            echo "name field not found in docup.json file\n";
            return false;
        }
        return true;
    }

    /**
     * welcome message
     */
    public function welcome()
    {
        echo "document uploader v0.1.0\n";
        echo "========================\n\n";
    }


}