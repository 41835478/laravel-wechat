/*===============================
 app页面载入动画
 功能：初始化loading事件
 作者：郭方超
 时间：2014-07-23
 对外接口：
 ===============================*/

//页面载入动画
//初始化元素，载入数据，变换数值，最后完成并回调
var Load = function() {
	var loading = document.getElementById("loading");
	var odiv = document.createElement("div");
	var obar = document.createElement("div");
	var timer = null;
	odiv.style.position = "absolute";
	odiv.style.top = "49%";
	odiv.style.left = "10%";
	odiv.style.width = "80%";
	odiv.style.height = "40px";
	odiv.style.color = "#fff";
	obar.style.height = "40px";
	obar.className = "liner";
	obar.style.textAlign = "center";
	obar.style.lineHeight = "39px";
	obar.style.fontSize = "22px";
	obar.innerText = "0%";

	loading.appendChild(odiv);
	odiv.appendChild(obar);
	//设置百分比
	function setnum(number, callback) {
		timer && clearInterval(timer);
		var t = parseInt(obar.innerText);
		if (number > t) {
			var dur = (700 / (number - t)) >> 0;
			timer = setInterval(function() {
				var t = parseInt(obar.innerText);
				if (t < number) {
					t++;
					obar.innerText = t + "%";
				} else {
					clearInterval(timer);
					callback && callback();
				}
			}, dur);
		}
	}

	//调用接口
	//@pagram num:载入的数值
	this.load = function(num) {
		var num = num || 100;
		setnum(num);
	}
	this.end = function(fn) {
		setnum(100, function() {
			setTimeout(function() {
				loading.style.display = "none";
				fn && fn();
			}, 100);
		});
	}
}
var load = new Load();
//对外提供对象接口