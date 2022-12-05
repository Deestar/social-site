<?php
include_once "lasweetmodel.php";
class commentcontrol extends lasweetmodel
{
    private $id;
    private $comment;
    private $fileerror;
    private $filesize;
    private $filetype;
    private $date;
    private $file_temp;
    private $username;
    public function __construct($userId, $comment, $fileerror, $filesize, $filetype, $file_temp, $username)
    {
        $this->id = $userId;
        $this->comment = $comment;
        $this->fileerror = $fileerror;
        $this->filesize = $filesize;
        $this->filetype = $filetype;
        $this->file_temp = $file_temp;
        $this->date = time() + 172800;
        $this->username = $username;

    }
    private function checkFile()
    {
        if ($this->fileerror > 0) {
            $final = false;
        } else if ($this->filesize > 600000) {
            $final = false;
        } else {
            $final = true;
        }
        return $final;
    }
    public function iComment()
    {
        if (strlen($this->filetype) == 0) {
            if (!$this->profStat($this->id)) {
                $prof = "lasuprofiles/default.jpg";
            } else {
                $prof = $this->profStat($this->id);
            }
            $this->insertComment($this->id, $this->comment, "", $prof, $this->date, $this->username);
        } else {
            $this->insertCommentImg();
        }
    }

    private function insertCommentImg()
    {
        if (!$this->checkFile()) {
            header("location:index.php?error=file");
        } else {
            $getExt = explode("/", $this->filetype)[1];
        }

        $setName = uniqid(true) . "." . $getExt;
        $setPath = "lasuimages/" . $setName;
        $fileStat = move_uploaded_file($this->file_temp, $setPath);
        if (!$this->profStat($this->id)) {
            $prof = "lasuprofiles/default.jpg";
        } else {
            $prof = $this->profStat($this->id);
        }
        if ($fileStat) {$this->insertComment($this->id, $this->comment, $setPath, $prof, $this->date, $this->username);
        } else {
            header("location:index.php?error=moveerr");
        }
    }
}
