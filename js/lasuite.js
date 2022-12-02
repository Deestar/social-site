class mobile {
  tweet;
  stat = true;
  toggleMenu = () => {
    let getProf = document.querySelector(".main_prof_img");
    let getMenu = document.querySelector(".sidemenu_cont");
    let getMainMenu = document.querySelector(".main_side_menu");
    //opens menu....
    getProf.addEventListener("click", () => {
      getMainMenu.style.width = "100vw";
      getMainMenu.style.height = "100vh";
      getMainMenu.style.visibility = "visible";
      getMainMenu.style.opacity = "1";
      getMenu.style.width = "80%";
      getMenu.style.visibility = "visible";
      getMenu.style.opacity = "1";
      ("1");
      getMenu.style.height = "100%";
    });
    getMenu.addEventListener("click", (e) => {
      e.stopPropagation();
    });
    //closes menu
    getMainMenu.addEventListener("click", () => {
      getMenu.style.width = "0px";
      setTimeout(() => {
        getMainMenu.style.width = "0vw";
        getMainMenu.style.height = "0vh";
        getMainMenu.style.visibility = "hidden";
        getMainMenu.style.opacity = "0px";
        getMenu.style.visibility = "hidden";
        getMenu.style.opacity = "0";
        getMenu.style.height = "0px";
      }, 620);
    });
  };
  textBox = () => {
    let getTweet = document.querySelector(".tweet");
    let getBox = document.querySelector(".textarea_cont");
    let getReturn = document.querySelector(".textarea_cont i");
    let x = window.innerWidth;
    getTweet.addEventListener("click", () => {
      if (x < 550 && this.stat == true) {
        getBox.style.transform = "translate(20%,38%)";

        this.stat = false;
      } else if (this.stat == true) {
        getBox.style.transform = "translate(0%,30%)";

        this.stat = false;
      }
      getReturn.onclick = () => {
        if (x < 550) {
          getBox.style.transform = "translate(200%,50%)";
          this.stat = true;
        } else {
          getBox.style.transform = "translateX(200%)";
          this.stat = true;
        }
      };
    });
  };
  //the form action is removed if the text box is empty
  minText = () => {
    let getBox = document.querySelector("textarea");
    let getForm = document.querySelector("form");
    let getButton = document.querySelector(".post_header button");
    getBox.addEventListener("input", () => {
      let getVal = getBox.value;
      let getMin = getVal.replaceAll(" ", "");
      if (getMin.length > 0) {
        getForm.setAttribute("action", "comment.c.php");
        getButton.style.backgroundColor = "rgb(46, 203, 231)";
      } else {
        getForm.removeAttribute("action");
        getButton.style.backgroundColor = "rgb(68, 101, 107)";
      }
    });
  };
  stopLike = () => {
    let getLiked = document.querySelectorAll(".liked");
    getLiked.forEach((element) => {
      element.addEventListener("click", (e) => {
        e.stopPropagation();
      });
    });
  };
  addLike = () => {
    let likes = document.querySelectorAll(".like");
    likes.forEach((element) => {
      element.addEventListener("click", (e) => {
        e.stopPropagation();
        let parent = element.parentNode;
        let id = parent.parentNode.id;
        location.assign(`countlikes.c.php?id=${id}`);
      });
    });
  };
  //For the reply like
  addReplyLike = () => {
    let likes = document.querySelectorAll(".Rlike");
    likes.forEach((element) => {
      element.addEventListener("click", (e) => {
        e.stopPropagation();
        let parent = element.parentNode;
        let id = parent.id;
        location.assign(`increaselikes.c.php?id=${id}`);
      });
    });
  };
  //for the reply dislike
  addReplyDislike = () => {
    let likes = document.querySelectorAll(".Rdislike");
    likes.forEach((element) => {
      element.addEventListener("click", (e) => {
        e.stopPropagation();
        let parent = element.parentNode;
        let id = parent.id;
        location.assign(`increasedislike.c.php?id=${id}`);
      });
    });
  };
  addDislike = () => {
    let likes = document.querySelectorAll(".dislike");
    likes.forEach((element) => {
      element.addEventListener("click", (e) => {
        e.stopPropagation();
        let parent = element.parentNode;
        let id = parent.parentNode.id;
        console.log("clicked");
        location.assign(`countdislike.c.php?id=${id}`);
      });
    });
  };
  stopDislike = () => {
    let getLiked = document.querySelectorAll(".disliked");
    getLiked.forEach((element) => {
      element.addEventListener("click", (e) => {
        e.stopPropagation();
      });
    });
  };
  showReply = (element) => {
    let id = element.id;
    location.assign(`index.php?replyid=${id}`);
  };

  //When you click a comment
  sendId = () => {
    let main = document.querySelectorAll(".main_laswuit_cont");
    main.forEach((element) => {
      element.addEventListener("click", () => {
        this.showReply(element);
      });
    });
  };
  // both function for the replies in a comment when you click them they should display
  showNestedReply = (element) => {
    let id = element.id;
    location.assign(`index.php?nestid=${id}`);
  };
  sendNestedId = () => {
    let main = document.querySelectorAll(".reply_main_cont");
    main.forEach((element) => {
      element.addEventListener("click", (e) => {
        this.showNestedReply(element);
      });
    });
  };
  getId = () => {
    let par = new URLSearchParams(window.location.search);
    let id = par.get("replyid");
    let reply;
    if (id == null) {
      reply = "";
    } else if (id.length == 0) {
      reply = "";
    } else {
      reply = id;
    }
    return reply;
  };
  getNestedId = () => {
    let par = new URLSearchParams(window.location.search);
    let id = par.get("nestid");
    let nestid;
    if (id == null) {
      nestid = "";
    } else if (id.length == 0) {
      nestid = "";
    } else {
      nestid = id;
    }
    return nestid;
  };
  setMainComment = () => {
    let comment = document.querySelectorAll(".main_laswuit_cont");
    comment.forEach((element) => {
      if (element.id == this.getId()) {
        let MainComment = document.querySelector(".comment_cont");
        MainComment.innerHTML = element.innerHTML;
        let getUname = document.querySelector(".comment_cont .laswuit_info b");
        getUname.style.fontSize = "27px";
        getUname.style.fontFamily = "helvetica";
        getUname.style.textTransform = "capitalize";
        this.addDislike();
        this.addLike();
      }
    });
  };
  prevReply = () => {
    let bckArrow = document.querySelector(".replies_main_cont header div");
    bckArrow.addEventListener("click", () => {
      // history.back();
      // bckArrow.parentElement.parentElement.remove();
      location.assign("index.php");
    });
  };
  replyMinText = () => {
    let form = document.querySelector(".replies_main_cont form");
    let area = document.querySelector(".replies_main_cont textarea");
    let btn = document.querySelector(".replies_main_cont button");
    area.addEventListener("input", () => {
      let getVal = area.value;
      let getMin = getVal.replaceAll(" ", "");
      if (getMin.length > 0) {
        if (this.getNestedId().length == 0) {
          let id = this.getId();
          form.setAttribute("action", `lasulikes.c.php`);
        } else {
          let id = this.getNestedId();
          form.setAttribute("action", `lasulikes.c.php`);
        }
        btn.style.backgroundColor = "rgb(46, 203, 231)";
      } else {
        form.removeAttribute("action");
        btn.style.backgroundColor = "rgb(68, 101, 107)";
      }
    });
  };
  //ONCLICK OF ALL IMAGES LEADS TO PROFILE PAGE
  MainToProfile = () => {
    let getMainImg = document.querySelectorAll(".laswuit_img");
    getMainImg.forEach((element) => {
      element.addEventListener("click", (e) => {
        e.stopPropagation();
        let Mainbox = element.parentNode.parentNode;
        let headerName = Mainbox.childNodes[5].childNodes[1].textContent;
        let Name = headerName.split(".")[0];
        location.assign(`lasuiteprofile.php?uname=${Name}`);
      });
    });
  };
  NestedToProfile = () => {
    let getReplyImg = document.querySelectorAll(".reply_prof");
    getReplyImg.forEach((element) => {
      element.addEventListener("click", (e) => {
        e.stopPropagation();
        let ReplyBox = element.parentNode.parentNode;
        let text = ReplyBox.childNodes[3].childNodes[1].textContent;
        location.assign(`lasuiteprofile.php?uname=${text}`);
      });
    });
  };
  NestedMainCmtToProfile = () => {
    let nestedImg = document.querySelector(".main_cmt_prof");
    nestedImg.addEventListener("click", (e) => {
      e.stopPropagation();
      let name = nestedImg.parentElement.childNodes[3].textContent;
      location.assign(`lasuiteprofile.php?uname=${name}`);
    });
  };
  //transform footer above android keyboard
  typing() {
    let area = document.querySelector(".replies_main_cont footer textarea");
    let btm = document.querySelector(".replies_main_cont footer");
    if (window.innerWidth < 600) {
      area.addEventListener("focus", () => {
        btm.style.transform = "translateY(-50px)";
        btm.style.height = "70px";
        area.style.marginBottom = "40px";
        this.stat = false;
      });
    }
    area.addEventListener("blur", () => {
      btm.style.transform = "translateY(0px)";
      btm.style.height = "100px";
      area.style.marginBottom = "40px";
      this.stat = true;
    });
  }
  //when user leave and enter the site the last mode saved by localstorage
  currentMode = () => {
    let toggler = document.querySelector("#mode");
    if (this.getMode() == "light") {
      this.toLight();
      toggler.classList.replace("fa-sun", "fa-moon");
      toggler.style.color = "rgb(82, 141, 151)";
    } else {
      this.toDark();
      toggler.classList.replace("fa-moon", "fa-sun");
      toggler.style.color = " rgb(204, 161, 21)";
    }
  };
  //If the moon and sun icon are clicked on modes should change as well as the localstorsge mode
  changeMode = () => {
    let toggler = document.querySelector("#mode");
    toggler.addEventListener("click", () => {
      if (this.getMode() == "light") {
        toggler.classList.replace("fa-moon", "fa-sun");
        toggler.style.color = " rgb(204, 161, 21)";
        localStorage.setItem("mode", "dark");
        this.toDark();
      } else {
        toggler.classList.replace("fa-sun", "fa-moon");
        localStorage.setItem("mode", "light");
        toggler.style.color = "rgb(82, 141, 151)";
        this.toLight();
      }
    });
  };
  //changes of element in reply boxes for dark mode
  repliesToDark = () => {
    let cmtText = document.querySelector(".comment_cont .laswuit");
    let cmtUname = document.querySelector(".comment_cont b");
    let main_cont = document.querySelector(".comment_cont");
    let replyBoxes = document.querySelectorAll(".reply_main_cont");
    let unames = document.querySelectorAll(".reply_name");
    let texts = document.querySelectorAll(".reply_text");
    main_cont.style.backgroundColor = "rgb(32, 50, 53)";
    replyBoxes.forEach((element) => {
      element.style.backgroundColor = "rgb(32, 50, 53)";
    });
    texts.forEach((element) => {
      element.style.color = "white";
    });
    unames.forEach((element) => {
      element.style.color = "rgb(112, 82, 62)";
    });
    cmtText.style.color = "rgba(150, 97, 113, 0.897)";
    cmtUname.style.color = "rgb(112, 82, 62)";
  };
  //changes of element in reply boxes for light mode
  repliesToLight = () => {
    let main_cont = document.querySelector(".comment_cont");
    let replyBoxes = document.querySelectorAll(".reply_main_cont");
    let unames = document.querySelectorAll(".reply_name");
    let texts = document.querySelectorAll(".reply_text");
    main_cont.style.backgroundColor = " rgba(255, 255, 255, 0.952)";
    replyBoxes.forEach((element) => {
      element.style.backgroundColor = "rgba(255, 255, 255, 0.952)";
    });
    texts.forEach((element) => {
      element.style.color = "black";
    });
    unames.forEach((element) => {
      element.style.color = "black";
    });
    cmtText.style.color = " black";
    cmtUname.style.color = "black";
  };
  //gets current mode from localstorage
  getMode = () => {
    let mode = localStorage.getItem("mode");
    let type;
    if (mode == null) {
      type = "light";
    } else if (mode == "light") {
      type = "light";
    } else if (mode == "dark") {
      type = "dark";
    } else {
      type = "light";
    }
    return type;
  };
  //gets mode and apply it to the replysection
  replyMode = () => {
    if (this.getMode() == "light") {
      this.repliesToLight();
    } else {
      this.repliesToDark();
    }
  };
  //cahnge of index page element to dark mode
  toDark = () => {
    let text = document.querySelectorAll(".laswuit");
    let head = document.querySelector(".main_cont header");
    let text_cont = document.querySelectorAll(".main_laswuit_cont");
    let main = document.querySelector(".main_cont");
    let bdy = document.querySelector(".gen_laswite_cont");
    let footer = document.querySelector("footer");
    let icons = document.querySelectorAll("footer i");
    let unames = document.querySelectorAll(".laswuit_info");
    //text to white
    unames.forEach((element) => {
      element.style.color = "brown";
    });
    text.forEach((element) => {
      element.style.color = "white";
    });
    head.style.backgroundColor = "rgb(32, 50, 53)";
    text_cont.forEach((element) => {
      element.style.backgroundColor = "rgb(32, 50, 53)";
    });
    bdy.style.backgroundColor = "rgb(32, 50, 53)";
    footer.style.backgroundColor = "rgb(32, 50, 53)";
    icons[0].style.color = "rgb(106, 167, 131)";
    icons[1].style.color = "rgb(170, 57, 110)";
    icons[2].style.color = "white";
    icons[0].style.color = "rgb(71, 143, 119)";
    main.style.backgroundColor = "rgb(32, 50, 53)";
  };
  //cahnge of index page element to light mode
  toLight = () => {
    let text = document.querySelectorAll(".laswuit");
    let head = document.querySelector(".main_cont header");
    let text_cont = document.querySelectorAll(".main_laswuit_cont");
    let main = document.querySelector(".main_cont");
    let bdy = document.querySelector(".gen_laswite_cont");
    let footer = document.querySelector("footer");
    let icons = document.querySelectorAll("footer i");
    //text to white
    text.forEach((element) => {
      element.style.color = "black";
    });
    head.style.backgroundColor = "white";
    text_cont.forEach((element) => {
      element.style.backgroundColor = "var(--darkwhite)";
    });
    bdy.style.backgroundColor = "var(--darkwhite)";
    footer.style.backgroundColor = "white";
    icons[0].style.color = "rgb(106, 167, 131)";
    icons[1].style.color = "rgb(170, 57, 110)";
    icons[2].style.color = "black";
    icons[0].style.color = "rgb(71, 143, 119)";
    main.style.backgroundColor = "white";
  };
}
let object = new mobile();
object.toggleMenu();
object.textBox();
object.minText();
object.stopLike();
object.addLike();
object.addDislike();
object.stopDislike();
object.sendId();
object.sendNestedId();
object.changeMode();
object.currentMode();
try {
  object.replyMode();
} catch (error) {}
try {
  object.setMainComment();
} catch (error) {}
try {
  object.prevReply();
} catch (error) {}
try {
  object.replyMinText();
} catch (error) {}
try {
  object.addReplyLike();
} catch (error) {}
try {
  object.addReplyDislike();
} catch (error) {}
try {
  object.MainToProfile();
} catch (error) {}
try {
  object.NestedToProfile();
} catch (error) {}
try {
  object.NestedMainCmtToProfile();
} catch (error) {}
try {
  object.typing();
} catch (error) {}
