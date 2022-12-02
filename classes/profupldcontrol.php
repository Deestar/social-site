<?php
include_once 'lasweetmodel.php';
class profupldcontrol extends lasweetmodel
{
    private $id;
    private $fileerror;
    private $filesize;
    private $filetype;
    private $file_temp;
    private $username;
    public function __construct($id, $username, $fileerror, $filesize, $filetype, $file_temp)
    {
        $this->id = $id;
        $this->fileerror = $fileerror;
        $this->filesize = $filesize;
        $this->filetype = $filetype;
        $this->file_temp = $file_temp;
        $this->username = $username;
    }
    public function checkFile()
    {
        if ($this->fileerror > 0) {
            $final = false;
        } else if ($this->filesize > 300000) {
            $final = false;
        } else {
            $final = true;
        }
        return $final;
    }
    public function moveFile()
    {
        if (!$this->checkFile()) {
            header("location:lasuiteprofile.php?err=upldfile");
        } else {
            $getExt = explode("/", $this->filetype)[1];
        }
        $setName = "profile" . $this->id . "." . $getExt;
        $setPath = "lasuprofiles/" . $setName;
        $fileStat = move_uploaded_file($this->file_temp, $setPath);
        if (!$fileStat) {
            header("location:lasuiteprofile.php?err=uplderr");
        } else {
            $this->updprofreply($this->id, $setPath);
            $this->updprof($this->id, $setPath);
            $this->insertUserImg($this->id, $setPath);
            header("location:lasuiteprofile.php?uname=$this->username#success");
        }
    }

}
