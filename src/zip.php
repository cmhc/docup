<?php
namespace docup;

class Zip
{
    /**
     * 在这个目录的上一层目录下面生成一个zip文件夹
     */
    public function create($archiveFolder)
    {
        $zip = new \ZipArchive();
        $parent = dirname($archiveFolder);
        $archiveName = $parent . '/tmp.zip';
        if ($zip->open($archiveName, \ZipArchive::OVERWRITE) === false) {
            return false;
        }
        $dir = preg_replace('/[\/]{2,}/', '/', $archiveFolder ."/"); 
        $dirs = array($dir);

        $forbidden = array('.php');

        while (count($dirs)) {
            $dir = current($dirs);
            $root = trim(str_replace($archiveFolder, '', $dir), '/');

            if (!empty($root)) {
                $zip->addEmptyDir($root);
            }
            
            $dh = opendir($dir); 
            while($file = readdir($dh)) {
                if ($file != '.' && $file != '..') {
                    if (is_file($dir . $file)) {
                        foreach ($forbidden as $suffix) {
                            if (strpos($file, $suffix) !== false) {
                                continue;
                            }
                            echo $dir.$file;
                            echo "\n";
                            echo str_replace($archiveFolder, '', $dir.$file);
                            echo "\n";
                            $zip->addFile($dir.$file, str_replace($archiveFolder, '', $dir.$file)); 
                        }
                    } elseif (is_dir($dir . $file)) {
                        $dirs[] = $dir . $file . '/'; 
                    }
                } 
            } 
            closedir($dh); 
            array_shift($dirs); 
        } 
        
        $zip->close();
        return $archiveName;
    }
}