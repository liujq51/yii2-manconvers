/**
 * Created by liujq on 2017/6/15.
 */
// 百度地图API功能
var map = new BMap.Map("allmap");
var point = new BMap.Point(_poi_long, _poi_lat);
map.centerAndZoom(point, 15);

//创建小狐狸
var pt = new BMap.Point(_poi_long,_poi_lat);
//var myIcon = new BMap.Icon("http://developer.baidu.com/map/jsdemo/img/fox.gif", new BMap.Size(300,157));
var marker = new BMap.Marker(pt);  // 创建标注
map.addOverlay(marker);              // 将标注添加到地图中
/*marker.addEventListener("click",getAttr);
function getAttr(){
    var p = marker.getPosition();       //获取marker的位置
    alert("marker2的位置是" + p.lng + "," + p.lat);
}*/
var opts = {
    width : 200,     // 信息窗口宽度
    height: 100,     // 信息窗口高度
    title : "井盖信息" , // 信息窗口标题
}
var infoWindow = new BMap.InfoWindow("地址：北京市东城区王府井大街", opts);  // 创建信息窗口对象
marker.addEventListener("click", function(){
    map.openInfoWindow(infoWindow,pt); //开启信息窗口
});