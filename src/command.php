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
        $this->project = new \docup\Project();

        $this->welcome();
        if (!($info = $this->isLogin())) {
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
        echo "current directory is " . getcwd() . ", upload? [Y/N]\n";
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

        $retry = true;
        while ($retry) {
            echo "== Login ==\n";
            echo "username:";
            $username = strtolower(trim(fgets(STDIN)));
            echo "password:";
            $password = strtolower(trim(fgets(STDIN)));
            $password = md5($password);
            $check =json_decode(@file_get_contents("http://doc.staff.ifeng.com/login.php?username={$username}&password={$password}"), true);
            if ($check['code'] == 1) {
                file_put_contents(__DIR__ . '/.sid', $check['sid']);
                echo "login success\n";
                $retry = false;
            } else {
                echo "username or password error\n";
                $retry = true;
            }
        }
        return $check['sid'];
    }

    /**
     * 注册
     */
    public function register()
    {
        $retry = true;
        while ($retry) {
            echo "username:";
            $username = strtolower(trim(fgets(STDIN)));
            echo "password:";
            $password = strtolower(trim(fgets(STDIN)));
            $password = md5($password);
            $check =json_decode(@file_get_contents("http://doc.staff.ifeng.com/register.php?username={$username}&password={$password}"), true);
            if ($check['code'] == 1) {
                echo "register success\n";
                $retry = false;
            } else {
                echo "username error\n";
                $retry = true;
            }
        }
    }

    /**
     * 本地存储的小文件，判断是否登录
     */
    public function isLogin()
    {
        if (!file_exists(__DIR__ . '/.sid')) {
            return false;
        }
        $info = file_get_contents(__DIR__ . '/.sid');
        //验证信息
        $check =json_decode(file_get_contents('http://doc.staff.ifeng.com/login.php?sid='.$info), true);
        if ($check['code'] == 1) {
            return $info;
        }
        return false;
    }

    /**
     * 设置项目
     */
    public function setProject()
    {
        if ($this->project->getProjectName()) {
            return true;
        }
        echo "project name:";
        $projectName = fgets(STDIN);
        $this->project->initLocal($projectName);
    }

    public function welcome()
    {
        echo "document uploader v0.1.0\n";
        echo "========================\n\n";
    }


}