

function imgChoserAndShow( src,show_img){
    show_img.src = URL.createObjectURL(src.files[0]);
}