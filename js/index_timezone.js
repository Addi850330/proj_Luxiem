// --------換國旗圖---------
$(".flag_wrap img").click(function () {
  const nowImgSrc = $(this).attr("src");
  $(".flag_wrap_top .flag_top").attr("src", nowImgSrc);
});

//--------切換時區時鐘-------
// console.log("--電子時鐘(偷懶做法)--");

// const showClock = () => {
//     const now = new Date();
//     const ar = now.toString("zh-TW", { timeZone: "Asia/Taipei" }).split(" ");

//     console.log(ar);
//     TimezoneInfo.innerHTML = ar[1] + "<br>" + ar[2];

//     TimezoneInfoCount.innerHTML = ar[5] + "<br>"+ ar[4];

//     setTimeout(showClock, 1000);
//   };
//   showClock();

// ---------時區切換---------

let nowCountry = "TW";

const showClock = () => {
  if (nowCountry === "TW") {
    const now = new Date();
    const ar = now.toString("zh-TW", { timeZone: "Asia/Taipei" }).split(" ");
    // 轉換成字串 用空白切開

    // console.log(ar);
    //TimezoneInfo.innerHTML = ar[1] + "<br>" + ar[2]; //這是索引
    $(".TimezoneInfo").html(ar[1] + "<br>" + ar[2]);

    //TimezoneInfoCount.innerHTML = "GMT+8" + "<br>" + ar[4];
    $(".TimezoneInfoCount").html("GMT+8" + "<br>" + ar[4]);

    // console.log("showClock", count);
    // count = count + 1; //注意擺放的順序
    setTimeout(showClock, 1000);
  } else {
    console.log("TW other"); //這裡可以不寫不浪費記憶體
  }
};
showClock(); //執行

//-------TW--------

$(".flag_TW").click(function () {
  // let count = 0; 銘記在心的變數
  nowCountry = "TW";

  const showClock = () => {
    if (nowCountry === "TW") {
      const now = new Date();
      const ar = now.toString("zh-TW", { timeZone: "Asia/Taipei" }).split(" ");
      // 轉換成字串 用空白切開

      console.log(ar);
      $(".TimezoneInfo").html(ar[1] + "<br>" + ar[2]);

      $(".TimezoneInfoCount").html("GMT+8" + "<br>" + ar[4]);

      // console.log("showClock", count);
      // count = count + 1; //注意擺放的順序
      setTimeout(showClock, 1000);
    } else {
      console.log("TW other"); //這裡可以不寫不浪費記憶體
    }
  };
  showClock(); //執行
});

//-------JP--------

$(".flag_JP").click(function () {
  nowCountry = "JP";

  const options = {
    day: "numeric", //(e.g., 1)
    month: "short", //(e.g., Oct)
    year: "numeric", //(e.g., 2019)
    hour: "2-digit", //(e.g., 02)
    minute: "2-digit", //(e.g., 02)
    second: "2-digit",
    hour12: false, // 24 小時制
    timeZone: "Asia/Tokyo", // 美國/紐約
  };

  const showClock = () => {
    if (nowCountry === "JP") {
      const now = new Date();
      const ar1 = now.toLocaleString("en-us", options).split(" ");

      console.log(ar1);
      $(".TimezoneInfo").html(ar1[0] + "<br>" + ar1[1]);
      //TimezoneInfo.innerHTML = ar1[0] + "<br>" + ar1[1];
      $(".TimezoneInfoCount").html("GMT+9" + "<br>" + ar1[3]);
      //TimezoneInfoCount.innerHTML = "GMT+9" + "<br>" + ar1[3];

      setTimeout(showClock, 1000);
    } else {
      console.log("JP other");
    }
  };
  showClock();
});

//-------GB--------

$(".flag_GB").click(function () {
  nowCountry = "GB";

  const options = {
    day: "numeric", //(e.g., 1)
    month: "short", //(e.g., Oct)
    year: "numeric", //(e.g., 2019)
    hour: "2-digit", //(e.g., 02)
    minute: "2-digit", //(e.g., 02)
    second: "2-digit",
    hour12: false, // 24 小時制
    timeZone: "Europe/London",
  };

  const showClock = () => {
    if (nowCountry === "GB") {
      const now = new Date();
      const ar1 = now.toLocaleString("en-us", options).split(" ");

      console.log(ar1);
      $(".TimezoneInfo").html(ar1[0] + "<br>" + ar1[1]);

      $(".TimezoneInfoCount").html("GMT+0" + "<br>" + ar1[3]);

      setTimeout(showClock, 1000);
    } else {
      console.log("GB other");
    }
  };
  showClock();
});

//-------AU--------

$(".flag_AU").click(function () {
  nowCountry = "AU";
  const options = {
    day: "numeric", //(e.g., 1)
    month: "short", //(e.g., Oct)
    year: "numeric", //(e.g., 2019)
    hour: "2-digit", //(e.g., 02)
    minute: "2-digit", //(e.g., 02)
    second: "2-digit",
    hour12: false, // 24 小時制
    timeZone: "Australia/Sydney",
  };

  const showClock = () => {
    if (nowCountry === "AU") {
      const now = new Date();
      const ar1 = now.toLocaleString("en-us", options).split(" ");

      console.log(ar1);
      $(".TimezoneInfo").html(ar1[0] + "<br>" + ar1[1]);

      $(".TimezoneInfoCount").html("GMT+10" + "<br>" + ar1[3]);

      setTimeout(showClock, 1000);
    } else {
      console.log("AU other");
    }
  };
  showClock();
});

//-------US--------

$(".flag_US").click(function () {
  nowCountry = "US";

  const options = {
    day: "numeric", //(e.g., 1)
    month: "short", //(e.g., Oct)
    year: "numeric", //(e.g., 2019)
    hour: "2-digit", //(e.g., 02)
    minute: "2-digit", //(e.g., 02)
    second: "2-digit",
    hour12: false, // 24 小時制
    timeZone: "America/New_York",
  };

  const showClock = () => {
    if (nowCountry === "US") {
      const now = new Date();
      const ar1 = now.toLocaleString("en-us", options).split(" ");

      console.log(ar1);
      $(".TimezoneInfo").html(ar1[0] + "<br>" + ar1[1]);

      $(".TimezoneInfoCount").html("GMT-5" + "<br>" + ar1[3]);

      setTimeout(showClock, 1000);
    } else {
      console.log("US other");
    }
  };
  showClock();
});

//-------SE--------

$(".flag_SE").click(function () {
  nowCountry = "SE";

  const options = {
    day: "numeric", //(e.g., 1)
    month: "short", //(e.g., Oct)
    year: "numeric", //(e.g., 2019)
    hour: "2-digit", //(e.g., 02)
    minute: "2-digit", //(e.g., 02)
    second: "2-digit",
    hour12: false, // 24 小時制
    timeZone: "Europe/Stockholm",
  };

  const showClock = () => {
    if (nowCountry === "SE") {
      const now = new Date();
      const ar1 = now.toLocaleString("en-us", options).split(" ");

      console.log(ar1);
      $(".TimezoneInfo").html(ar1[0] + "<br>" + ar1[1]);

      $(".TimezoneInfoCount").html("GMT+1" + "<br>" + ar1[3]);

      setTimeout(showClock, 1000);
    } else {
      console.log("SE other");
    }
  };
  showClock();
});

//-------CA--------

$(".flag_CA").click(function () {
  nowCountry = "CA";

  const options = {
    day: "numeric", //(e.g., 1)
    month: "short", //(e.g., Oct)
    year: "numeric", //(e.g., 2019)
    hour: "2-digit", //(e.g., 02)
    minute: "2-digit", //(e.g., 02)
    second: "2-digit",
    hour12: false, // 24 小時制
    timeZone: "America/Vancouver",
  };

  const showClock = () => {
    if (nowCountry === "CA") {
      const now = new Date();
      const ar1 = now.toLocaleString("en-us", options).split(" ");

      console.log(ar1);
      $(".TimezoneInfo").html(ar1[0] + "<br>" + ar1[1]);

      $(".TimezoneInfoCount").html("GMT-8" + "<br>" + ar1[3]);

      setTimeout(showClock, 1000);
    } else {
      console.log("CA other");
    }
  };
  showClock();
});
