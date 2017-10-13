<?php
namespace docup;
class Project
{
    public function initLocal($name)
    {
        return file_put_contents(getcwd() . '/.project', trim($name));
    }

    public function initRemote($name)
    {
        
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
}