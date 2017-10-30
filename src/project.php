<?php
namespace docup;
class Project
{
    public function initLocal($name)
    {
        $name = trim($name);
        if (!$name) {
            return false;
        }
        return file_put_contents(getcwd() . '/.project', trim($name));
    }

    public function setServer($name)
    {
        return file_put_contents(getcwd() . '/.server', trim($name));
    }

    /**
     * 获取项目名称
     */
    public function getProjectName()
    {
        if (!file_exists(getcwd() . '/.project')) {
            return false;
        }
        return file_get_contents(getcwd() . '/.project');
    }

    /**
     * 获取服务器地址
     */
    public function getServer()
    {
        if (!file_exists(getcwd() . '/.server')) {
            return false;
        }
        return file_get_contents(getcwd() . '/.server');
    }
}