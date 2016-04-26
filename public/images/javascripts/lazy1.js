/*===============================
           预加载模块
功能：传入要加载的对象，实现延时加载
作者：郭方超
时间：2014-07-23
对外接口：
===============================*/


//预加载
//@pagram list:加载列表
//@pagram progress:每次加载调用方法
//@pagram complete:完成之后的回调
function lazy(list, progress, complete) {
	var list = list || [];
	var progress = progress || function() {};
	var complete = complete || function() {};
	var res = [];
	var count = list.length;
	var index = 0;

	if (list.length == 0) {
		complete && complete(res);
	}

	for (var i = 0; i < count; i++) {
		res[i] = new Image();
		res[i].index = i;

		if (list[i].src) {
			res[i].onload = function() {
				//console.log(this.index + ".加载图片成功！src：" + this.src);
				index++;
				progress(index / count * 100);
				index >= count && complete(res);
			}
			res[i].onerror = function() {
				console.log(this.index + ".加载图片失败！src：" + this.src);
				index++;
				index >= count && complete(res);
			}
			res[i].src = list[i].src;
		} else {
			index++;
		}
	}

}