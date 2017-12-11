<?php
namespace docup;
class Project
{
    /**
     * project json file contents
     * @var array
     */
    protected $project;

    /**
     * read project info from docup.json file
     * @return boolean return false when docup.json file not exists
     */
    public function initProject()
    {
        if (!file_exists(getcwd() . '/docup.json')) {
            return false;
        }
        $this->project = json_decode(file_get_contents(getcwd() . '/docup.json'), true);
        return true;
    }

    /**
     * return project name
     */
    public function getProject()
    {
        if (!$this->project) {
            $this->initProject();
        }
        if (isset($this->project['name'])) {
            return $this->project['name'];
        }
        return false;
    }

    /**
     * return server address
     */
    public function getServer()
    {
        if (!$this->project) {
            $this->initProject();
        }
        if (isset($this->project['server'])) {
            return $this->project['server'];
        }
        return false;
    }
}