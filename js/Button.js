var count = 0;
document.getElementById("myButton").onclick = function() {
    count++;
    if (count % 2 == 0) {
        document.getElementById("demo").innerHTML = "Ничего нет";
    }
    else {
        var img = document.createElement("img");
        document.getElementById("demo").innerHTML = "";
        img.src = "D:/github/My_first_webtask/image/Button.JPG";
        document.getElementById("demo").appendChild(img);
    }
}