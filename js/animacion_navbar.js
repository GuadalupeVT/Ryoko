$(document).on('click','ul li',function(){
    $(this).addClass('active').siblings().removeClass('active')
});

var sections=document.querySelectorAll('section');

onscroll=function(){
    var scrollPosition=document.documentElement.scrollTop;

    sections.forEach((section)=>{
        if(
            scrollPosition >= section.offsetTop -section.offsetHeight *0.25 &&
            scrollPosition < section.offsetTop+section.offsetHeight-section.offsetHeight*0.25 
        ){
            var currentId = section.attributes.id.value;
            console.log(currentId);
            $(this).addClass('active').siblings().removeClass('active')
            if(currentId=='banner'){
                document.getElementById('h').addClass('active').siblings().removeClass('active')
            }
        }
    });
};



