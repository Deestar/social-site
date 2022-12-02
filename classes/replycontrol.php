<?php
include_once "lasweetmodel.php";
class replycontrol extends lasweetmodel
{
    private $userid;
    private $commentid;
    private $replyid;
    private $reply;
    private $fileerror;
    private $filesize;
    private $filetype;
    private $file_temp;
    private $username;
    private $replyno;
    public function __construct($userid, $commentid, $username, $reply, $fileerror, $filesize, $filetype, $filetemp)
    {
        $this->userid = $userid;
        $this->replyid = $this->getIds() + 1;
        $this->commentid = $commentid;
        $this->username = $username;
        $this->reply = $reply;
        $this->fileerror = $fileerror;
        $this->filesize = $filesize;
        $this->filetype = $filetype;
        $this->file_temp = $filetemp;
        // $this->replyno = $this->replynum($this->replyid);
    }
    private function checkFile()
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
    public function main()
    {
        if (strlen($this->filetype) == 0) {
            if (!$this->profStat($this->userid)) {
                $prof = "lasuprofiles/default.jpg";
            } else {
                $prof = $this->profStat($this->userid);
            }
            $this->Ireply($this->replyid, $this->userid, $this->commentid, $this->username, $prof, $this->reply, "");
        } else {
            $this->insertImg();
        }
    }
    private function insertImg()
    {
        if (!$this->checkFile()) {
            header("location:index.php?error=file");
        } else {
            $getExt = explode("/", $this->filetype)[1];
            $setName = uniqid(true) . "." . $getExt;
            $setPath = "lasuimages/" . $setName;
            $fileStat = move_uploaded_file($this->file_temp, $setPath);
            if (!$fileStat) {
                header("location:index.php?error=upld");

            } else {
                if (!$this->profStat($this->userid)) {
                    $prof = "lasuprofiles/default.jpg";
                } else {
                    $prof = $this->profStat($this->userid);
                }
                $this->Ireply($this->replyid, $this->userid, $this->commentid, $this->username, $prof, $this->reply, $setPath);
            }
        }
    }

}
