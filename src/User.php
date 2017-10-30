<?php
namespace docup;

class User
{
    public function __construct()
    {
        $this->project = new \docup\Project();
        $this->server = trim($this->project->getServer(), '/');
    }

    /**
     * 登录
     * 会在本地生成一个sid
     */
    public function login($username, $password)
    {
        $password = md5($password);
        $check =json_decode(@file_get_contents($this->server . "/login.php?username={$username}&password={$password}"), true);
        if ($check['code'] == 1) {
            file_put_contents(__DIR__ . '/.sid', $check['sid']);
            return true;
        }
        return false;
    }

    /**
     * 注册
     */
    public function register($username, $password)
    {
        $password = md5($password);
        $check =json_decode(@file_get_contents($this->server . "/register.php?username={$username}&password={$password}"), true);
        if ($check['code'] == 1) {
            return true;
        }
        return false;
    }

    /**
     * 验证是否已经登录
     */
    public function isLogin()
    {
        if (!file_exists(__DIR__ . '/.sid')) {
            return false;
        }
        $info = file_get_contents(__DIR__ . '/.sid');
        //验证信息
        $check =json_decode(@file_get_contents($this->server . '/login.php?sid=' . $info), true);
        if ($check['code'] == 1) {
            return $info;
        }
        return false;
    }
}