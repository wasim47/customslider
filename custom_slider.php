<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script>
var ul;
var liItems; 
var imageWidth;
var imageNumber;

function init(){

    ul = document.getElementById('image_slider');
    liItems = ul.children;
    imageNumber = liItems.length;
    imageWidth = liItems[0].children[0].offsetWidth;
    // set ul's width as the total width of all images in image slider.
    ul.style.width = parseInt(imageWidth * imageNumber) + 'px';
    slider(ul);
}

/**delta function is to set how the image slide—keep still for a while and move to next picture.
*step function will be called many times until clearInterval() been called
* currentImage * imageWidth is the currentImage position of ul
* delta start from 0 to 1, delta * imageWidth is the pixels that changes
**/
 function slider(ul){ 
    animate({
        delay:17,
        duration: 3000,
        delta:function(p){return Math.max(0, -1 + 2 * p)},
        step:function(delta){
            ul.style.left = '-' + parseInt(currentImage * imageWidth + delta * imageWidth) + 'px';
    },
        callback:function(){
            currentImage++;
        // if it doesn't slied to the last image, keep sliding
            if(currentImage < imageNumber-1){
                slider(ul);
        }
       // if current image it's the last one, it slides back to the first one
            else{
                var leftPosition = (imageNumber - 1) * imageWidth;
               // after 2 seconds, call the goBack function to slide to the first image 
                setTimeout(function(){goBack(leftPosition)},2000); 
                setTimeout(function(){slider(ul)}, 4000);
            }
        }
    });`
}
function goBack(leftPosition){
    currentImage = 0; 
    var id = setInterval(function(){
        if(leftPosition >= 0){
            ul.style.left = '-' + parseInt(leftPosition) + 'px';
            leftPosition -= imageWidth / 10;
        }
        else{
            clearInterval(id);
        } 
    }, 17);
}
//generic animate function
function animate(opts){
    var start = new Date;
    var id = setInterval(function(){
        var timePassed = new Date - start;
        var progress = timePassed / opts.duration
        if(progress > 1){
            progress = 1;
        }
        var delta = opts.delta(progress);
        opts.step(delta);
        if (progress == 1){
            clearInterval(id);
           opts.callback();
         }
    }, opts.dalay || 17);
}
window.onload = init;
</script>
<style>
.container{
    width:800px;
    height:auto;
    padding:0;
    border:1px solid gray;
    -webkit-box-sizing:border-box;
    -moz-box-sizing:border-box;
    box-sizing:border-box;
    background: black; 
}
.image-slider-wrapper{
    overflow: hidden;
}
#image_slider{
    position: relative;
    height: 250px;
    padding:0;
}
#image_slider li{
    max-width: 100%;
    float:left;
    list-style: none;
}
</style>
</head>

<body>

<div class="container">
    <div class="image-slider-wrapper">
        <ul id="image_slider">
            <li><img src="Banner_1481138610.jpg"></li>
            <li><img src="Banner_1481138630.jpg"></li>
            <li><img src="Banner_1500450991.jpg"></li>
            <li><img src="Banner_1481138630.jpg"></li>
            <li><img src="Banner_1500450991.jpg"></li>
        </ul> 
    </div>
</div>


</body>
</html>
