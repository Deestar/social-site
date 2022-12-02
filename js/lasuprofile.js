class mobile {
  //function to chnge background colors of switch link
  switchButton = () => {
    let links = document.querySelectorAll(".switch a");
    let getBox = document.querySelector(".gen_tweet_cont");
    getBox.addEventListener("scroll", () => {
      let xOffset = getBox.scrollLeft;
      if (xOffset < 250) {
        links[0].style.backgroundColor = " rgb(80, 149, 170)";
        links[1].style.backgroundColor = "  rgb(20, 161, 204)";
      } else {
        links[0].style.backgroundColor = "  rgb(20, 161, 204)";
        links[1].style.backgroundColor = " rgb(80, 149, 170)";
      }
    });
  };
  bckarrow = () => {
    let btn = document.querySelector("header div");
    btn.addEventListener("click", () => {
      history.back();
    });
  };
  getComment = () => {
    let cmts = document.querySelectorAll(".tweet_cont");
    cmts.forEach((element) => {
      element.addEventListener("click", () => {
        let id = element.id;
        location.assign(`index.php?#${id}`);
      });
    });
  };
  getReply = () => {
    let reply = document.querySelectorAll(".reply");
    reply.forEach((element) => {
      element.addEventListener("click", (e) => {
        e.stopPropagation();
        let id = element.id;
        location.assign(`index.php?nestid=${id}`);
      });
    });
  };
  addLike = () => {
    let likes = document.querySelectorAll(".like");
    likes.forEach((element) => {
      element.addEventListener("click", (e) => {
        e.stopPropagation();
        let parent = element.parentNode.parentElement;
        let id = parent.parentNode.id;
        location.assign(`countlikes.c.php?id=${id}`);
      });
    });
  };
  stopLike = () => {
    let getLiked = document.querySelectorAll(".liked");
    getLiked.forEach((element) => {
      element.addEventListener("click", (e) => {
        e.stopPropagation();
        console.log("clicked");
      });
    });
  };
  addDislike = () => {
    let likes = document.querySelectorAll(".dislike");
    likes.forEach((element) => {
      element.addEventListener("click", (e) => {
        e.stopPropagation();
        let parent = element.parentNode.parentElement;
        let id = parent.parentNode.id;
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
  addReplyLike = () => {
    let likes = document.querySelectorAll(".Rlike");
    likes.forEach((element) => {
      element.addEventListener("click", (e) => {
        e.stopPropagation();
        let parent = element.parentNode.parentElement.parentElement;
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
        let parent = element.parentNode.parentElement.parentElement;
        let id = parent.id;
        location.assign(`increasedislike.c.php?id=${id}`);
      });
    });
  };
  bckBtn = () => {
    let btn = document.querySelector("header div");
    btn.addEventListener("click", () => {
      location.assign("index.php");
    });
  };
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
  toDark = () => {
    let profile = document.querySelector(".prof_info");
    let main = document.querySelector(".main_cont");
    let uname = document.querySelector(".user_name");
    main.style.backgroundColor = "rgb(32, 50, 53)";
    main.style.color = "white";
    profile.style.color = "rgba(150, 97, 113, 0.897)";
    uname.style.color = "rgb(112, 82, 62)";
  };
  toLight = () => {
    let profile = document.querySelector(".prof_info");
    let main = document.querySelector(".main_cont");
    let uname = document.querySelector(".user_name");
    main.style.backgroundColor = "white";
    main.style.color = "black";
    profile.style.color = "black";
    uname.style.color = "black";
  };
  //Get mode from localstorage and set
  currentMode = () => {
    if (this.getMode() == "light") {
      this.toLight();
    } else {
      this.toDark();
    }
  };
}

mobile = new mobile();
mobile.switchButton();
mobile.bckarrow();
mobile.getComment();
mobile.getReply();
mobile.addLike();
mobile.stopLike();
mobile.addDislike();
mobile.stopDislike();
mobile.addReplyLike();
mobile.addReplyDislike();
mobile.bckBtn();
mobile.currentMode();
